<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Work;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class WorkController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Work::select('*');
            if($request->search){
                $data->where('name','like','%'.$request->search .'%');
            }
            return DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('status', function($row){
                    $checked = $row->status ? 'checked':'';
                    $btn = '<div class="form-check form-switch form-check-custom form-check-success form-check-solid">
                                <input class="form-check-input" type="checkbox" '. $checked.' onchange="changeStatus('.$row->id.')"/>
                            </div>';
                    return $btn;
                })
                ->addColumn('image_path', function($row){
                    return $row->image_path;
                })
                ->addColumn('action', function($row){
                    return $row->action_buttons;
                })
                ->addColumn('created_at', function($row){
                    return $row->created_at ? Carbon::parse($row->created_at)->format('d-m-Y') : null;
                })
                ->rawColumns(['image_path','action','created_at','status'])
                ->make(true);
        }
        return view('admin.work.index');
    }
    public function create()
    {
        return view('admin.work.create', [
            'work' => new Work(),
        ]);
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

        $data = $request->all();
        $work = Work::create($data);

        return redirect()
            ->route('works.index')
            ->with('success', 'تمت عملية الإضافة بنجاح');
    }
    public function edit($id)
    {

        $work = Work::findOrFail($id);
        if ($work == null) {
            return abort(404);
        }

        return view('admin.work.edit', compact('work'));
    }
    public function update(Request $request, $id)
    {
        $rules = $this->rules($id);
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        $work = Work::findOrFail($id);

        $data = $request->all();

        $work->update($data);

        return redirect()
            ->route('works.index')
            ->with('success','تمت عملية التعديل بنجاح');
    }
    protected function rules($id = 0)
    {
        $rules = [
            'name' => [
                'required',
                'string',
                'max:255',
                'unique:works,name,'.$id,
            ],
            'description' => [
                'nullable',
                'string',
                'max:255',
            ],
           //'|max:50|dimensions:min_width=150,min_height=150,max_width=300,max_height=300', // 50KB
        ];
        return $rules;
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
