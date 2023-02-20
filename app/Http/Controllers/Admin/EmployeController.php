<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Str;
use Image;
use DB;
use DataTables;
use File;

class EmployeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index(Request $request){
        if ($request->ajax()) {
            $employes = "";
            $query = DB::table('employes')->orderBy('id', 'DESC');
                if($request->position==1){
                    $query->where('position', 1);
                }
                if($request->position==2){
                    $query->where('position', 2);
                }
                if($request->position==3){
                    $query->where('position', 3);
                }

        $employes = $query->get();

            return DataTables::of($employes)
                ->addIndexColumn()
                ->editColumn('position', function($row){
                    if($row->position==1){
                        return 'Manager';
                    }elseif($row->position==2){
                        return 'Seller';
                    }elseif($row->position==3){
                        return 'Security';
                    }
                })
                ->editColumn('photo', function ($row) {
                    return '<img src="' . $row->photo . '" height="50" width:"30">';
                })
                ->addColumn('action',function($row){
                    $actionbtn = '<a href="#" class="btn btn-info edit" data-id="'.$row->id.'" data-toggle="modal" data-target="#editModal" id="edit"> <i class="fas fa-edit"></i> </a>
                    <a href="'.route('employe.delete', [$row->id]).'" class="btn btn-danger" id="delete"> <i class="fas fa-trash"></i>
                    </a>';

                    return $actionbtn;
                })

                -> rawColumns(['action', 'position', 'photo'])
                ->make(true);
        }
        return view('admin.employes.index');
    }

    public function add_employe(){
        return view('admin.employes.add_new');
    }
    
    public function store(Request $request){
        $data = array(
            'name' => $request->name,
            'position' => $request->position,
            'salary' => $request->salary,
            'phone' => $request->phone,
            'address' => $request->address,
        );
        
        $slug = Str::slug($request->name . '-');
        $photo = $request->photo;

        $photoname = $slug . '.' . $photo->getClientOriginalExtension();
        Image::make($photo)->save('backend/files/employes/'.$photoname);

        $data['photo'] = 'backend/files/employes/' . $photoname;


        DB::table('employes')->insert($data);

        $notfication = array("message" => "data inserted successfully", "type" => "succes");
        return redirect()->back()->with($notfication);

    }

    public function edit($id){
        $employe = DB::table('employes')->where('id', $id)->first();

        return view('admin.employes.edit', compact('employe'));
    }

    public function update(Request $request){

        $data = array(
            'name' => $request->name,
            'position' => $request->position,
            'salary' => $request->salary,
            'phone' => $request->phone,
            'address' => $request->address,
        );

        if($request->photo){
            if(File::exists($request->old_photo)){
                unlink($request->old_photo);
            }
            $slug = Str::slug($request->name . '-');
            $photo = $request->photo;

            $photoname = $slug . '.' . $photo->getClientOriginalExtension();
            Image::make($photo)->save('backend/files/employes/'.$photoname);
    
            $data['photo'] = 'backend/files/employes/' . $photoname;
            
            DB::table('employes')->where('id', $request->id)->update($data);

            $notfication = array("message" => "data updated successfully", "type" => "succes");
            return redirect()->back()->with($notfication);
        }else{
            $data['photo'] = $request->old_photo;
            
            DB::table('employes')->where('id', $request->id)->update($data);

            $notfication = array("message" => "data updated successfully", "type" => "succes");
            return redirect()->back()->with($notfication);
        }
    }

    public function delete($id){
        DB::table('employes')->where('id', $id)->delete();
        $notfication = array("message" => "deleted successfully", "type" => "error");
        return redirect()->back()->with($notfication);
    }
}
