<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Constant;
use App\Models\Country;
use App\Models\Work;
use App\Models\Worker;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Yajra\DataTables\Facades\DataTables;

class WorkerController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Worker::latest();
            if($request->search){
                $data->where('name','like','%'.$request->search .'%');
            }
            if($request->s_work_id != 0){
                $data->where('work_id',$request->s_work_id);
            }
            if($request->s_category_id != 0){
                $data->whereHas('Categories', function($q) use($request){

                    $q->where('category_id',$request->s_category_id);
                });
            }

            return DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('status', function($row){
                    if($row->status == '1'){
                        $type = 'success';
                    }elseif($row->status == '2'){
                        $type = 'warning';
                    }else{
                        $type = 'danger';
                    }
                    $btn = '<div class="badge badge-light-'.$type.'">'.$row->status_name.'</div>';
                    return $btn;
                })
                // ->addColumn('image_path', function($row){
                //     return $row->image_path;
                // })
                ->addColumn('work', function($row){
                    return $row->work->name;
                })
                ->addColumn('categories', function($row){
                    $view = '';
                    foreach ($row->Categories as $value) {
                        $view .= '<div class="badge badge-light-primary m-1">'.$value->name.'</div>';
                    }
                    return $view;
                })
                ->addColumn('country', function($row){
                    return $row->country->name;
                })
                ->addColumn('age', function($row){
                    return $row->age;
                })
                ->addColumn('action', function($row){
                    return $row->action_buttons;
                })
                ->addColumn('created_at', function($row){
                    return $row->created_at ? Carbon::parse($row->created_at)->format('d-m-Y') : null;
                })
                ->rawColumns(['action','created_at','status','categories'])
                ->make(true);
        }
        $works = Work::all();
        $categories = Category::active()->get();
        return view('admin.worker.index',compact('works','categories'));
    }
    public function create()
    {
        $languages = Constant::where('constant_id',2)->pluck('name')->toArray();
        $religions = Constant::where('constant_id',1)->get();
        $categories = Category::active()->get();

        return view('admin.worker.create', [
            'worker' => new Worker(),
            'countries' => Country::Active()->get(),
            'works' => Work::all(),
            'languages' => $languages,
            'religions' => $religions,
            'categories'=> $categories
        ]);
    }
    public function store(Request $request)
    {
        $rules = $this->rules();
        try{
            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
            }

            $data = $request->except('avatar','avatar_remove','categories');
            DB::beginTransaction();
            if ($request->hasFile('avatar')) {
                $file = $request->file('avatar');
                $data['icon_url'] = $this->upload_image($file,'image/worker');
            }
            $worker = Worker::create($data);
            $worker->Categories()->attach($request->categories);
            DB::commit();
            return redirect()
                ->route('workers.index')
                ->with('success', 'تمت عملية الإضافة بنجاح');
        }catch (\Exception $exception){
            DB::rollBack();
            dd($exception);
            return redirect()->back()
                ->withErrors($exception->getMessage())
                ->withInput();
        }
    }
    public function edit($id)
    {

        $worker = Worker::findOrFail($id);
        if ($worker == null) {
            return abort(404);
        }
        $languages = Constant::where('constant_id',2)->pluck('name')->toArray();
        $religions = Constant::where('constant_id',1)->get();
        $categories = Category::active()->get();
        $selected_categories = $worker->Categories()->pluck('category_id')->toArray();
        return view('admin.worker.edit',[
            'worker' => $worker,
            'countries' => Country::Active()->get(),
            'works' => Work::all(),
            'languages' => $languages,
            'religions' => $religions,
            'categories'=> $categories,
            'selected_categories'=>$selected_categories
        ]);
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
            $worker = Worker::findOrFail($id);
            DB::beginTransaction();
            $data = $request->except('avatar','avatar_remove','categories');
            $old_icon_url = $worker->icon_url;

            if ($request->hasFile('avatar')) {
                $file = $request->file('avatar');
                $data['icon_url'] = $this->upload_image($file,'image/worker');
            }
            $worker->update($data);
            $worker->Categories()->sync($request->categories);
            if ($old_icon_url && $old_icon_url != $worker->icon_url) {
                Storage::disk('public')->delete($old_icon_url);
            }
            DB::commit();
            return redirect()
                ->route('workers.index')
                ->with('success','تمت عملية التعديل بنجاح');
        }catch (\Exception $exception){
            DB::rollBack();
            return redirect()->back()
                ->withErrors($exception->getMessage())
                ->withInput();
        }
    }
    protected function rules($id = 0)
    {
        $rules = [
            'name' => [
                'required','string','max:255','unique:workers,name,'.$id,
            ],
            'description' => [
                'string','max:255',
            ],
            'status'=> [
                'required',Rule::in([0,1,2]),
            ],
            'work_id'=> [
                'required','numeric','exists:works,id',
            ],
            'country_id'=> [
                'required','numeric','exists:countries,id',
            ],
            'religion_id'=> [
                'required','numeric','exists:constants,id',
            ],
            'year_of_birth'=> [
                'required','integer','min:1900','max:'.(date('Y')),
            ],
            'height'=> [
                'required','integer','min:100','max:200',
            ],
            'weight'=> [
                'required','integer','min:30','max:200',
            ],
            'language'=> [
                'required','string'
            ],
            'experiences'=> [
                'required','string'
            ],
        ];
        if($id == 0){
            $rules['avatar'] =['required','image'];
        }else{
            $rules['avatar'] =['image'];
        }
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
