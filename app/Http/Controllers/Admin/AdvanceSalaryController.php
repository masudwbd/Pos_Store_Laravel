<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Toastr;
use DataTables;
class AdvanceSalaryController extends Controller
{
    public function index(Request $request){
        if($request->ajax()){
            $data = DB::table('advance_salaries')->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action',function($row){
                    $actionbtn = '<a href="#" class="btn btn-info edit" data-id="'.$row->id.'" data-toggle="modal" data-target="#editModal" id="edit"> <i class="fas fa-edit"></i> </a>
                    <a href="" class="btn btn-danger" id="delete"> <i class="fas fa-trash"></i>
                    </a>';

                    return $actionbtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('admin.advance_salaries.index');
    }

    public function add_new(){
        return view('admin.advance_salaries.add_new');
    }

    public function store(Request $request){

        $advanced = DB::table('advance_salaries')->where('employe_id', $request->employe_id)->where('month', $request->month)->where('year', $request->year)->first();

        if(!$advanced){
            $data = array(
                "employe_id" => $request->employe_id,
                "month" =>  $request->month,
                "salary" =>  $request->salary,
                "year" =>  $request->year,
                "advance_salary" => $request->advance_salary,
            );

            DB::table('advance_salaries')->insert($data);
            Toastr::success('Advance Salary Inserted!', 'Title', ["positionClass" => "toast-top-right"]);
            return redirect()->back();
        }else{
            Toastr::error('Advance Salary Already Given!', 'Title', ["positionClass" => "toast-top-right"]);
            return redirect()->back();
        }
    }

    public function employer_salary($id){
        $data = DB::table('employes')->where('id', $id)->first();
        return response($data);
    }
}
