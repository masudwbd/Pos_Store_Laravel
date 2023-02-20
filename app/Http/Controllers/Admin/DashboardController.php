<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use DB;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index(){
          
        $date = date('d-m-y');
        $orders = DB::table('orders')
                ->where('order_date', $date)
                ->get();

        $today_sales = 0; 
          
        foreach ($orders as $order) {
            $today_sales += intVal($order->total); 
        }
        return view('admin.dashboard.index' , compact(['today_sales', 'orders']));
    }
}
