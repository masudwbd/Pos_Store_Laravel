<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\Present;
use Illuminate\Http\Request;
use DB;
use Toastr;
use DataTables;
class PresentController extends Controller
{
    public function index(Request $request){
        if($request->ajax()){
            $employers = DB::table('presents')->select('edit_date')->groupBy('edit_date')->get();
            return DataTables::of($employers)
                ->addIndexColumn()
                ->addColumn('action',function($row){
                    $actionbtn = '<a href="'.route('present.edit' ,[$row->edit_date] ).'" class="btn btn-info edit"> <i class="fas fa-edit"></i> </a>
                    <a href="" class="btn btn-danger" id="delete"> <i class="fas fa-trash"></i>
                    </a>';

                    return $actionbtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('admin.presents.index');
    }

    public function add_new(){
        return view('admin.presents.add_new');
    }

    public function store(Request $request){

        $date = $request->edit_date;
        $attendance = DB::table('presents')->where('edit_date' , $date)->first();

        if($attendance){
            Toastr::error('Presents Of Today Is Already Given', 'Title', ["positionClass" => "toast-top-right"]);
            return redirect()->back();
        }else{
            foreach ($request->user_id as $id){
                $data[] = [
                    "employer_id" => $id,
                    "date" => $request->date,
                    "year" => $request->year,
                    "attendance" => $request->attendance[$id],
                    "edit_date" => date("d_m_y"),
                ];
            }
    
            DB::table('presents')->insert($data);
            Toastr::success('Presents Given', 'Title', ["positionClass" => "toast-top-right"]);
            return redirect()->back();
        }
    }

    public function edit($edit_date){
        $employes = DB::table('presents')->where('edit_date', $edit_date)->get();
        return view('admin.presents.edit', compact('employes'));
    }

    public function update(Request $request){
        foreach ($request->user_id as $id){
            $data = [
                "date" => $request->date,
                "year" => $request->year,
                "attendance" => $request->attendance[$id],
            ];

            $attendance = Present::where(['date' => $request->date, 'id' => $id])->first();
            $attendance->update($data);
        }

        Toastr::success('Presents Updated', 'Title', ["positionClass" => "toast-top-right"]);
        return redirect()->back();

    }
}
