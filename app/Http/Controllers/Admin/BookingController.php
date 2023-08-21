<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class BookingController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Booking::select('*');
            if($request->search){
                $data->where('name','like','%'.$request->search .'%');
            }
            return DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('status', function($row){
                    if($row->status == '1'){
                        $type = 'warning';
                    }elseif($row->status == '2'){
                        $type = 'secondary';
                    }elseif($row->status == '3'){
                        $type = 'info';
                    }elseif($row->status == '4'){
                        $type = 'primary';
                    }elseif($row->status == '5'){
                        $type = 'success';
                    }
                    $btn = '<div class="badge badge-light-'.$type.'">'.$row->status_name.'</div>';
                    return $btn;
                })
                ->addColumn('worker_name', function($row){
                    return $row->worker->name;
                })
                ->addColumn('action', function($row){
                    return $row->action_buttons;
                })
                ->addColumn('created_at', function($row){
                    return $row->created_at ? Carbon::parse($row->created_at)->format('d-m-Y') : null;
                })
                ->rawColumns(['worker_name','action','created_at','status'])
                ->make(true);
        }
        return view('admin.booking.index');
    }


}
