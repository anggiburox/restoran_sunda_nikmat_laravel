<?php

namespace App\Http\Controllers;
use App\Models\UsersModel;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class Auth extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {  
        return view('pages/auth/loginforgot');
    }
    
    // update data diskusi
	public function updatelupapassword(Request $request){
        $user = UsersModel::where('Email_Users', $request->email_users)->first();
        if ($user) {
            // jika username ditemukan
            // update data users
            DB::table('users')->where('Email_Users',$request->email_users)->update([
                'Password_Users' =>  $request->password,
            ]);
            // alihkan halaman ke halaman lupa_password
            return redirect('/')->withSuccess('Password berhasil diperbarui');
        } else {
            // jika username tidak ditemukan
            return back()->with('error', 'Username tidak ditemukan');
        }
    }

    public function login(Request $request){  
        $post = request()->all();
        $user = UsersModel::where('Email_Users', $post['email_users'])->first();
        if ($user) {
            $role = $user->ID_User_Roles;
            if ($role == 1) {
                $tutor = UsersModel::fetchusers($user->ID_User);
                if ($post['password'] == $user->Password_Users) {
                    $params = [
                        'islogin'   => true,
                        'nama_users'  => $tutor->Nama_Users,
                        'email_users'  => $tutor->Email_Users,
                        'password'  =>$tutor->Password_Users,
                        'id_user'   => $user->ID_User,
                        'role'      => $tutor->ID_User_Roles
                    ];
                    $request->session()->put($params);
                    if ($role == 1) {
                        return redirect()->to('/admin/dashboard');
                    } 
                } else { 
                    return redirect()->back()->with('error', 'Password salah!');
                }
            } else if ($role == 2) {
                $tutor = UsersModel::fetchusers($user->ID_User);
                if ($post['password'] == $user->Password_Users) {
                    $params = [
                        'islogin'   => true,
                        'nama_users'  => $tutor->Nama_Users,
                        'email_users'  => $tutor->Email_Users,
                        'password'  =>$tutor->Password_Users,
                        'id_user'   => $user->ID_User,
                        'role'      => $tutor->ID_User_Roles
                    ];          
                    $request->session()->put($params);
                    return redirect()->to('/spv_owner/dashboard');
                } else {
                    return redirect()->back()->with('error', 'Password salah!');
                }
            } else if ($role == 3) {
                $tutor = UsersModel::fetchusers($user->ID_User);
                if ($post['password'] == $user->Password_Users) {
                    $params = [
                        'islogin'   => true,
                        'nama_users'  => $tutor->Nama_Users,
                        'email_users'  => $tutor->Email_Users,
                        'password'  =>$tutor->Password_Users,
                        'id_user'   => $user->ID_User,
                        'role'      => $tutor->ID_User_Roles
                    ];          
                    $request->session()->put($params);
                    return redirect()->to('/kasir/dashboard');
                } else {
                    return redirect()->back()->with('error', 'Password salah!');
                }
            } 
            }else{
                return redirect()->back()->with('error', 'Email salah!');
            }
    }
    

    public function logout(){
        Session::forget('id_user');
        Session::forget('islogin');
        Session::forget('nama_users');
        Session::forget('email_users');
        Session::forget('password');
        Session::forget('role');
        Session::flush();
        return redirect()->to('/');
    }
}