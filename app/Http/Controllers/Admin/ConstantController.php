<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Constant;
use App\Models\Country;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class ConstantController extends Controller
{
    public function index(Request $request)
    {
        $constants = Constant::IsParent()->get();
        return view('admin.constant.index',compact('constants'));
    }
    public function store(Request $request)
    {
        $rules = $this->rules();
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        if($request->parent_id == -1){
            Country::updateOrCreate(
                ['id'=>$request->cons_id],
                ['name'=> $request->name , 'constant_id'=>$request->parent_id]
            );
        }else{
            Constant::updateOrCreate(
                ['id'=>$request->cons_id],
                ['name'=> $request->name , 'constant_id'=>$request->parent_id]
            );
        }

        return response()->json(['success'=>'تمت عملية الحفظ بنجاح.']);
    }
    public function getConstantDtl($parent_id,Request $request)
    {
        if($parent_id == -1){
            $data = Country::select('*');
        }else{
            $data = Constant::where('constant_id',$parent_id);
        }
        if($request->search){
            $data->where('name','like','%'.$request->search .'%');
        }
        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('parent_name', function($row){
                return $row->parent->name ?? '';
            })
            ->editColumn('status', function($row) use($parent_id){
                $checked = $row->status ? 'checked':'';
                $btn ='<div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" '. $checked.' id="check_status"
                        onchange="changeStatus('.$row->id.','.$parent_id.')"/>
                    <label class="form-check-label" for="check_status">
                    </label>
                </div>';
                return$btn;
            })
            ->addColumn('action', function($row)use($parent_id){
                $btn = '<button href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'"
                data-parent="'.$parent_id.'" data-name="'.$row->name.'" data-original-title="تعديل" class="edit btn btn-primary btn-sm editConstant">تعديل</button>';
                return $btn;
                //return $row->action_buttons;
            })
            ->addColumn('created_at', function($row){
                return $row->created_at ? Carbon::parse($row->created_at)->format('d-m-Y') : null;
            })
            ->rawColumns(['action','created_at','status'])
            ->make(true);
    }

    protected function rules($id = 0)
    {
        return [
            'name' => [
                'required',
            ],
        ];
    }
    public function changeStatus(Request $request)
    {
        if($request->parent_id == -1){
            $country = Country::findOrFail($request->id);
            if ($country) {

                if($country->status){
                    $country->update(['status' => 0]);
                }else{
                    $country->update(['status' => 1]);
                }
                return response()->json(['status' => 'success']);
            }
        }else{
            $constant = Constant::findOrFail($request->id);
            if ($constant) {
                if($constant->status){
                    $constant->update(['status' => 0]);
                }else{
                    $constant->update(['status' => 1]);
                }
                return response()->json(['status' => 'success']);
            }
        }

        return response()->json(['status' => 'fail']);
    }
    // public function changeStatus(Request $request)
    // {

    //     if($request->id){
    //         $category = Category::findOrFail($request->id);
    //         if ($category) {
    //             if($category->status){
    //                 $category->update(['status' => 0]);
    //             }else{
    //                 $category->update(['status' => 1]);
    //             }
    //             return response()->json(['status' => 'success']);
    //         }
    //     }
    //     return response()->json(['status' => 'fail']);
    // }
}
