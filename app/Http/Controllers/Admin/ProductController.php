<?php

namespace App\Http\Controllers\Admin;

use App\Exports\ProductsExport;
use App\Http\Controllers\Controller;
use App\Imports\ProductsImport;
use Illuminate\Http\Request;
use Str;
use Image;
use DB;
use Toastr;
use DataTables;
use File;
use Excel;

class ProductController extends Controller
{

    public function index(Request $request){
        if ($request->ajax()) {
            $products = "";
            $query = DB::table('products')
            ->leftJoin('categories', 'products.category_id', 'categories.id')
            ->leftJoin('suppliers', 'products.supplier_id', 'suppliers.id')  ;  

                if($request->category_id){
                    $query->where('products.category_id', $request->category_id);
                }
                if($request->supplier_id){
                    $query->where('products.category_id', $request->supplier_id);
                }

            $products = $query->select('products.*' , 'categories.category_name', 'suppliers.name')->get();

            return DataTables::of($products)
                ->addIndexColumn()
                ->editColumn('product_image', function ($row) {
                    return '<img src="' . $row->product_image . '" height="50" width:"30">';
                })
                ->addColumn('action',function($row){
                    $actionbtn = '<a href="#" class="btn btn-info edit" data-id="'.$row->id.'" data-toggle="modal" data-target="#editModal" id="edit"> <i class="fas fa-edit"></i> </a>
                    <a href="'.route('product.delete', [$row->id]).'" class="btn btn-danger" id="delete"> <i class="fas fa-trash"></i>
                    </a>';

                    return $actionbtn;
                })

                ->rawColumns(['action', 'product_image', 'category_name', 'name'])
                ->make(true);
        }
        return view('admin.products.index');
    }

    public function add_new(){
        return view('admin.products.add_new');
    }

    public function store(Request $request){
        $data = array(
            'product_name' => $request->product_name,
            'category_id' => $request->category_id,
            'supplier_id' => $request->supplier_id,
            'product_code' => $request->product_code,
            'product_garage' => $request->product_garage,
            'product_route' => $request->product_route,
            'buy_date' => $request->buy_date,
            'expire_date' => $request->expire_date,
            'buying_price' => $request->buying_price,
            'selling_price' => $request->selling_price,
        );

        $slug = Str::slug($request->product_name . '.');
        $image = $request->product_image;
        $imageName = $slug . '.' . $image->getClientOriginalExtension();
        Image::make($image)->save('backend/files/products/' . $imageName);

        $data['product_image'] = 'backend/files/products/' . $imageName;

        DB::table('products')->insert($data);

        Toastr::success('Product Inserted!', 'Title', ["positionClass" => "toast-top-right"]);
        return redirect()->back();
        
    }

    public function edit($id){
        $product = DB::table('products')->where('id' , $id)->first();

        return view('admin.products.edit', compact('product'));
    }

    public function update(Request $request){
        $data = array(
            'product_name' => $request->product_name,
            'category_id' => $request->category_id,
            'supplier_id' => $request->supplier_id,
            'product_code' => $request->product_code,
            'product_garage' => $request->product_garage,
            'product_route' => $request->product_route,
            'buy_date' => $request->buy_date,
            'expire_date' => $request->expire_date,
            'buying_price' => $request->buying_price,
            'selling_price' => $request->selling_price,
        );

        if($request->product_image){
            if(File::exists($request->old_image)){
                unlink($request->old_image);
            }
            
            $slug = Str::slug($request->product_name . '.');
            $image = $request->product_image;
            $imageName = $slug . '.' . $image->getClientOriginalExtension();
            Image::make($image)->save('backend/files/products/' . $imageName);

            $data['product_image'] = 'backend/files/products/' . $imageName;

            DB::table('products')->where('id', $request->id)->update($data);
    
            Toastr::success('Product Updated!', 'Title', ["positionClass" => "toast-top-right"]);
            return redirect()->back();

        }
        else{
            $data['product_image'] = $request->old_image;
            DB::table('products')->where('id', $request->id)->update($data);
            Toastr::success('Product Updated!', 'Title', ["positionClass" => "toast-top-right"]);
            return redirect()->back();
        }

    }

    public function delete($id){
        DB::table('products')->where('id', $id)->delete();
        Toastr::success('Product Deleted!', 'Title', ["positionClass" => "toast-top-right"]);
        return redirect()->back();
    }

    public function import_products(){
        return view('admin.products.import');
    }

    public function export(){
        return Excel::download(new ProductsExport, 'products.xlsx');
    }

    public function import(Request $request){
        $import = Excel::import(new ProductsImport, $request->file('import_products'));

        if($import){
            Toastr::success('Products Inserted!', 'Title', ["positionClass" => "toast-top-right"]);
            return redirect()->back();
        }else{
            Toastr::error('Operation Failed!', 'Title', ["positionClass" => "toast-top-right"]);
            return redirect()->back();
        }
    }
}
