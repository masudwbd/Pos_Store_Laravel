<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use DB;
use Image;
use Illuminate\Http\Request;
use Str;
use Toastr;
use File;

class SettingsController extends Controller
{
    public function index(){
        $data = DB::table('settings')->first();
        return view('admin.settings.index', compact('data'));
    }

    public function update(Request $request){
        $data = array(
            'company_name' => $request->company_name,
            'company_address' => $request->company_address,
            'company_email' => $request->company_email,
            'company_phone' => $request->company_phone,
            'company_mobile' => $request->company_mobile,
            'company_city' => $request->company_city,
            'company_country' => $request->company_country,
            'company_zipcode' => $request->company_zipcode
        );

    $slug = Str::slug($request->company_name . '-');


    if($request->company_logo){
        if(File::exists($request->old_logo)){
            unlink($request->old_logo);
        }
        $logoname = $slug . '.' .  $request->company_logo->getClientOriginalExtension();
        Image::make($request->company_logo)->save('backend/files/logo/'.$logoname);

        $data['company_logo'] = 'backend/files/logo/'.$logoname;

        DB::table('settings')->where('id' , $request->id)->update($data);

        Toastr::success('Settings Updated!', 'Title', ["positionClass" => "toast-top-right"]);
        return redirect()->back();
    }else{
        $data['company_logo'] = $request->old_logo;

        DB::table('settings')->where('id' , $request->id)->update($data);

        Toastr::success('Settings Updated!', 'Title', ["positionClass" => "toast-top-right"]);
        return redirect()->back();
    }

    }

}
