<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use App\Models\UsersModel;
use App\Models\UsersRoleModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UsersControllerAdmin extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        // mengambil data dari table users
        $pgw = UsersModel::joinuserroles();
    	// mengirim data users ke view index
        return view('pages/admin/users/index',['pgw' => $pgw]);
    }

    public function tambah(){
		$usersrole = UsersRoleModel::all();
        return view('pages/admin/users/tambah', ['usersrole'=>$usersrole]);
    }

    public function store(Request $request){
		$validator = Validator::make($request->all(), [
			'email_users' => 'required|unique:users',
		], [
			'email_users.unique' => 'Email sudah terdaftar, silahkan masukkan Email lain.',
		]);

        
		// Cek apakah validasi gagal
		if ($validator->fails()) {
			return redirect()->back()
				->withErrors($validator)
				->withInput();
		}
	// insert data ke table users
	DB::table('users')->insert([
        'Nama_Users' => $request->nama_users,
        'Email_Users' => $request->email_users,
        'Password_Users' => $request->password_users,
        'ID_User_Roles' => $request->id_user_role
	]);
	// alihkan halaman ke halaman users
	return redirect('/admin/users/')->withSuccess('Data berhasil disimpan');
    }

    public function edit($id)
	{
		// mengambil data users berdasarkan id yang dipilih
		$pgw = DB::table('users')->where('ID_User',$id)->get();
		$usersrole = UsersRoleModel::all();
		// passing data users yang didapat ke view edit.blade.php
		return view('pages/admin/users/edit',['pgw' => $pgw,'usersrole'=>$usersrole]);
	}

	// update data users
	public function update(Request $request){

        $m = UsersModel::find($request->id_users);
	
		if ($m) {
			$email_lama = $m->Email_Users;
			$validatedData = $request->validate([
				'email_users' => $email_lama == $request->email_users ? '' : 'unique:users,Email_Users',
			], [
                'email_users.unique' => 'Email sudah terdaftar, silahkan masukkan Email lain.',
			]);

	
			// Cek apakah NPM sudah terdaftar selain data yang sedang diupdate
			$npm_exists = UsersModel::where('Email_Users', $request->email_users)
				->where('ID_User', '!=', $request->id_users)
				->exists();
	
            // update data users
            DB::table('users')->where('ID_User',$request->id_users)->update([
                'Nama_Users' => $request->nama_users,
                'Email_Users' => $request->email_users,
                'Password_Users' => $request->password_users,
                'ID_User_Roles' => $request->id_user_role
            ]);

		// alihkan halaman ke halaman users
		return redirect('/admin/users')->withSuccess('Data berhasil diperbaharui');
		}
	
		return redirect()->back()->withErrors(['NIK' => 'NIK tidak ditemukan']);
	}

	// method untuk hapus data users
	public function hapus($id){
		// menghapus data users berdasarkan id yang dipilih
		DB::table('users')->where('ID_User',$id)->delete();
		
		// alihkan halaman ke halaman users
		return redirect('/admin/users')->withDanger('Data berhasil dihapus');
	}
}