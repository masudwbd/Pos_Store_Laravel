<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DataTables;
use DB;
class CustomerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    

    public function index(Request $request){
        if($request->ajax()){
            $data = DB::table('customers')->get();
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
        return view('admin.customers.index');
    }
    public function add_new(){
        return view('admin.customers.add_new');
    }

    public function store(Request $request){
        $data = array(
            "name" => $request->name,
            "email" => $request->email,
            "phone" => $request->phone,
            "address" => $request->address,
            "accountholder" => $request->account_holder,
            "accountnumber" => $request->account_number,
            "branchname" => $request->branch_name,
            "city" => $request->city,
        );
        DB::table('customers')->insert($data);
        
        $notfication = array("message" => "data inserted successfully", "type" => "succes");
        return redirect()->back()->with($notfication);
    }

    public function edit($id){
        $customer = DB::table('customers')->where('id', $id)->first();

        return view('admin.customers.edit', compact('customer'));
    }

    public function update(Request $request){
        $data = array(
            "name" => $request->name,
            "email" => $request->email,
            "phone" => $request->phone,
            "address" => $request->address,
            "accountholder" => $request->account_holder,
            "accountnumber" => $request->account_number,
            "branchname" => $request->branch_name,
            "city" => $request->city,
        );
        
        DB::table('customers')->where('id', $request->id)->update($data);
        
        $notfication = array("message" => "data inserted updated", "type" => "succes");
        return redirect()->back()->with($notfication);
    }
}
