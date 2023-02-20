<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Toastr;
use DataTables;
class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function add_new(){
        return view('admin.categories.add_new');
    }

    public function store(Request $request){
        $data = array(
            'category_name' => $request->category_name,
        );
        DB::table('categories')->insert($data);
        Toastr::success('Category Inserted!', 'Title', ["positionClass" => "toast-top-right"]);
        return redirect()->back();
    }

    public function index(Request $request){
        if($request->ajax()){
            $data = DB::table('categories')->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action',function($row){
                    $actionbtn = '<a href="#" class="btn btn-info edit" data-id="'.$row->id.'" data-toggle="modal" data-target="#editModal" id="edit"> <i class="fas fa-edit"></i> </a>
                    <a href="" class="btn btn-danger" id="delete"> <i class="fas fa-trash"></i>
                    </a>';

                    return $actionbtn;
                })
                -> rawColumns(['action'])
                ->make(true);
        }
        return view('admin.categories.index');
    }

    public function edit($id){
        $category = DB::table('categories')->where('id', $id)->first();
        return view('admin.categories.edit', compact('category'));
    }

    public function update(Request $request){
        $data = array(
            'category_name' => $request->category_name,
        );
        DB::table('categories')->where('id', $request->id)->update($data);
        Toastr::success('Category updated!', 'Title', ["positionClass" => "toast-top-right"]);
        return redirect()->back();
    }
}
