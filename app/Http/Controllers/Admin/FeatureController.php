<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Feature;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class FeatureController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Feature::select('*');
            if($request->search){
                $data->where('title','like','%'.$request->search .'%');
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
                    return '<img src="'.$row->image_path.'" width="40px" height="40px">';
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
        return view('admin.feature.index');
    }
    public function create()
    {
        return view('admin.feature.create', [
            'feature' => new Feature(),
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
        $data = $request->except('image');

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $data['icon_url'] = $this->upload_image($file,'image/feature');
        }
        $feature = Feature::create($data);
        return redirect()
            ->route('features.index')
            ->with('success', 'تمت عملية الإضافة بنجاح');
    }
    public function edit($id)
    {

        $feature = Feature::findOrFail($id);
        if ($feature == null) {
            return abort(404);
        }

        return view('admin.feature.edit', compact('feature'));
    }
    public function update(Request $request, $id)
    {
        $rules = $this->rules($id);
        try{
            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
            }
            $feature = Feature::findOrFail($id);
            DB::beginTransaction();
            $data = $request->except('image');
            $old_icon_url = $feature->icon_url;
            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $data['icon_url'] = $this->upload_image($file,'image/feature');
            }
            $feature->update($data);
            if ($old_icon_url && $old_icon_url != $feature->icon_url) {
                Storage::disk('public')->delete($old_icon_url);
            }
            DB::commit();
            return redirect()
                ->route('features.index')
                ->with('success','تمت عملية التعديل بنجاح');
        }catch (\Exception $exception){
            DB::rollBack();
            return redirect()->back()
                ->withErrors($exception->getMessage())
                ->withInput();
        }
    }
    public function destroy($id)
    {
        $feature = Feature::findOrFail($id);
        if ($feature == null) {
            return abort(404);
        }else {
            $feature->delete();
        }

        return redirect()
            ->route('features.index')
            ->with('success', 'تمت عملية الحذف بنجاح');
    }
    protected function rules($id = 0)
    {
        $rules = [
            'title' => [
                'required',
                'string',
                'max:255',
                'unique:features,title,'.$id,
            ],
            'description' => [
                'nullable',
                'string',
                'max:255',
            ],
        ];
        if($id == 0){
            $rules['image'] =['required','image'];
        }else{
            $rules['image'] =['image'];
        }
        return $rules;
    }
}
