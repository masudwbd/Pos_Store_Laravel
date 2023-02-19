<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use DataTables;

class SupplierController extends Controller
{
    public function index(Request $request){
        if($request->ajax()){
            $suppliers = "";
            $query = DB::table('suppliers')->orderBy('id', "DESC");
                if($request->type==1){
                    $query->where('type', 1);
                }elseif($request->type==2){
                    $query->where('type', 2);
                }elseif($request->type==3){
                    $query->where('type', 3);
                }elseif($request->type=='all'){
                    $query->get();
                }
            $suppliers = $query->get();
            return DataTables::of($suppliers)
                ->addIndexColumn()
                ->editColumn('type', function($row){
                    if($row->type==1){
                        return 'Distributor';
                    }elseif($row->type==2){
                        return 'Wholeseller';
                    }elseif($row->type==3){
                        return 'Brochure';
                    }
                })
                ->addColumn('action',function($row){
                    $actionbtn = '<a href="#" class="btn btn-info edit" data-id="'.$row->id.'" data-toggle="modal" data-target="#editModal" id="edit"> <i class="fas fa-edit"></i> </a>
                    <a href="'.route('supplier.delete', [$row->id]).'" class="btn btn-danger" id="delete"> <i class="fas fa-trash"></i>
                    </a>';

                    return $actionbtn;
                })
                -> rawColumns(['action','type'])
                ->make(true);
        }
        return view('admin.suppliers.index');
    }

    public function add_new(){
        return view('admin.suppliers.add_new');
    }

    public function store(Request $request){
        $data = array(
            "name" => $request->name,
            "email" => $request->email,
            "phone" => $request->phone,
            "address" => $request->address,
            "type" => $request->type,
            "shop" => $request->shop,
            "accountholder" => $request->account_holder,
            "accountnumber" => $request->account_number,
            "branchname" => $request->branch_name,
            "city" => $request->city,
        );

        DB::table('suppliers')->insert($data);
        
        $notfication = array("message" => "data inserted", "type" => "success");
        return redirect()->back()->with($notfication);
    }
    

    public function edit($id){
        $supplier = DB::table('suppliers')->where('id', $id)->first();

        return view('admin.suppliers.edit' , compact('supplier'));
    }

    public function update(Request $request){
        $data = array(
            "name" => $request->name,
            "email" => $request->email,
            "phone" => $request->phone,
            "address" => $request->address,
            "type" => $request->type,
            "shop" => $request->shop,
            "accountholder" => $request->account_holder,
            "accountnumber" => $request->account_number,
            "branchname" => $request->branch_name,
            "city" => $request->city,
        );

        DB::table('suppliers')->where('id', $request->id)->update($data);
        
        $notfication = array("message" => "data updated", "type" => "success");
        return redirect()->back()->with($notfication);
    }


    public function delete($id){
        DB::table('suppliers')->where('id', $id)->delete();
        $notfication = array("message" => "data deleted", "type" => "error");
        return redirect()->back()->with($notfication);
    }
}
