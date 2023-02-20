<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DataTables;
use DB;


class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index(Request $request){
        if ($request->ajax()) {
            $orders = "";
            $query = DB::table('orders')->orderBy('id', 'DESC');
                if($request->payment_status){
                    $query->where('payment_status', $request->payment_status);
                }
                if($request->order_date){
                $order_date = date('d-m-y', strtotime($request->order_date));
                    $query->where('order_date', $order_date);
                }

            $orders = $query->get();
            return DataTables::of($orders)
                ->addIndexColumn()
                // ->editColumn('date', function($row){
                //     if($row->position==1){
                //         return 'Manager';
                //     }elseif($row->position==2){
                //         return 'Seller';
                //     }elseif($row->position==3){
                //         return 'Security';
                //     }
                // })
                ->addColumn('action',function($row){
                    $actionbtn = '<a href="#" class="btn btn-info edit" data-id="'.$row->id.'" data-toggle="modal" data-target="#editModal" id="edit"> <i class="fas fa-edit"></i> </a>
                    <a href="'.route('product.delete', [$row->id]).'" class="btn btn-danger" id="delete"> <i class="fas fa-trash"></i>
                    </a>';

                    return $actionbtn;
                })

                ->rawColumns(['action'])
                ->make(true);
        }
        return view('admin.orders.index');
    }
}
