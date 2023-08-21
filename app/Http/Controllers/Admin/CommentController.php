<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Carbon\Carbon;use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class CommentController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Comment::select('*');
            if($request->search){
                $data->where('name','like','%'.$request->search .'%')
                ->orWhere('description','like','%'.$request->search .'%');
            }
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    return $row->action_buttons;
                })
                ->addColumn('created_at', function($row){
                    return $row->created_at ? Carbon::parse($row->created_at)->format('d-m-Y') : null;
                })
                ->rawColumns(['action','created_at'])
                ->make(true);
        }
        return view('admin.comment.index');
    }
    public function create()
    {
        return view('admin.comment.create', [
            'comment' => new Comment(),
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

        $comment = Comment::create($data);
        return redirect()
            ->route('comments.index')
            ->with('success', 'تمت عملية الإضافة بنجاح');
    }
    public function edit($id)
    {

        $comment = Comment::findOrFail($id);
        if ($comment == null) {
            return abort(404);
        }

        return view('admin.comment.edit', compact('comment'));
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
        $comment = Comment::findOrFail($id);
        $data = $request->all();
        $comment->update($data);

        return redirect()
            ->route('comments.index')
            ->with('success','تمت عملية التعديل بنجاح');

    }
    public function destroy($id)
    {
        $feature = Comment::findOrFail($id);
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
            'name' => [
                'required',
                'string',
                'max:255',
                'unique:comments,name,'.$id,
            ],
            'description' => [
                'required',
                'string',
                'max:255',
            ],
        ];

        return $rules;
    }
}
