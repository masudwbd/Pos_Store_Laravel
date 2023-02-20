<?php

namespace App\Http\Controllers\Admin;
use Auth;
use Toastr;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function logout(){
        Auth::logout();
        Toastr::error('Logged Out!', 'Title', ["positionClass" => "toast-top-right"]);
        return redirect()->to('/login');
    }
}
