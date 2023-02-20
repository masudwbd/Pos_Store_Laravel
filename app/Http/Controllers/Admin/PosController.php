<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use DataTables;
use Cart;
use Toastr;
class PosController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index(Request $request){
        $products = DB::table('products')
        ->leftJoin('categories', 'products.category_id', 'categories.id')
        ->select('products.*' , 'categories.category_name')
        ->get();


        return view('admin.pos.index' , compact('products'));
    }

    public function add_to_cart(Request $request){
        $data = array(
            'id' => $request->id,
            'name' => $request->name,
            'qty' => $request->qty,
            'price' => $request->price,
            'weight' => '1'
        );
        Cart::add($data);
        
        Toastr::success('Product Added!', 'Title', ["positionClass" => "toast-top-right"]);
        return redirect()->back();
    }

    public function update_cart(Request $request, $rowId){
        Cart::update($rowId, ['qty' => $request->qty]);
        Toastr::success('Product Added!', 'Title', ["positionClass" => "toast-top-right"]);
        return redirect()->back();
    }

    public function delete_cart($rowId){
        Cart::remove($rowId);
        Toastr::error('Product Deleted!', 'Title', ["positionClass" => "toast-top-right"]);
        return redirect()->back();
    }
    public function create_invoice(Request $request){
        $validatedDate = $request->validate([
            'customer_id' => 'required'
        ],
        [
            'customer_id.required' => 'Select A Customer First!',
        ]
    ); 
        $customer = DB::table('customers')->where('id', $request->customer_id)->first();
        $items = Cart::content();

        return view('admin.pos.order' , compact(['customer', 'items']));
    }
    public function order_store(Request $request){
        $data = array(
            'customer_id' => $request->customer_id,
            'order_date' => $request->order_date,
            'order_status' => $request->order_status,
            'total_products' => $request->total_products,
            'sub_total' => $request->subtotal,
            'vat' => $request->vat,
            'total' => $request->total,
            'payment_status' => $request->payment_status,
            'pay' => $request->pay,
            'due' => $request->due,
        );

        
        $order_id = DB::table('orders')->insertGetId($data);
        $contents = Cart::content();

        $o_data = array();

        foreach($contents as $content){
            $o_data['order_id'] = $order_id;
            $o_data['product_id'] = $content->id;
            $o_data['quantity'] = $content->qty;
            $o_data['unitcost'] = $content->price;
            $o_data['total'] = $content->total;
        }

        DB::table('order_details')->insert($o_data);
        Cart::destroy();
        Toastr::success('Order Added!', 'Title', ["positionClass" => "toast-top-right"]);
        return redirect()->to('pos/');
     }
}
