<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\UsersModel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ProfileControllerKasir extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     public function index()
     {  
         $user = UsersModel::fetchUserProfile(session()->get('id_user'));
 
         return view('pages/kasir/profile', ['user'=>$user]);
     }
 
     public function editprofile(Request $request){
         $user = UsersModel::find($request->id_user);
         if($user){
             $email_lama = $user->Email_Users;
             $validatedData = $request->validate([
                 'email_users' => $email_lama == $request->email ? '' : 'unique:users,Email_Users',
             ],[
                 'email_users.unique' => 'Email sudah terdaftar, silahkan masukkan Email lain.'
             ]);
 
         DB::table('users')->where('ID_User',$request->id_user)->update([
             'Nama_Users' => $request->nama_users,
             'Email_Users' => $request->email_users,
             'Password_Users' =>  $request->password_users,
         ]);
         // alihkan halaman ke halaman perawat
         return redirect('/kasir/profile')->withSuccess('Data berhasil diperbaharui');
     }
     return redirect()->back()->withErrors(['id_user' => 'User tidak ditemukan']);
     }
}