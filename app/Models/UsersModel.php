<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class UsersModel extends Model
{
    use HasFactory;

    protected $table='users';  
    protected $fillable=['ID_User','Nama_Users','Email_Users','Password_Users','ID_User_Roles'];  
    public $timestamps = false;
    public $incrementing = false;
    protected $primaryKey = 'ID_User';


    public static function fetchUser($id)
    {   
        $brng =  DB::table('users')
        ->where('users.Nama', $id)
        ->get();
        return $brng;
    }

    //users role
    
    public static function joinuserroles(){
        $brng =  DB::table('users')
        ->join('users_role', 'users_role.ID_User_Roles', '=', 'users.ID_User_Roles')
        ->get();
        return $brng;
    }   
    
    public static function fetchUserJoinKasir($id)
    {   
        $brng =  DB::table('users')
        ->join('kasir', 'kasir.ID_Kasir', '=', 'users.ID_Kasir')
        ->where('users.ID_User', $id)
        ->get();
        return $brng;
    }

    public static function fetchjoinkasir($id)
    {
        $brng =  DB::table('users')
        ->join('kasir', 'kasir.ID_Kasir', '=', 'users.ID_Kasir')
        ->where('ID_User',$id)
        ->first();
        return $brng;
    }

    //spvowner
    
    public static function joinuserspvowner(){
        $brng =  DB::table('spv_owner')
        ->join('spv_owner', 'spv_owner.ID_SPV_Owner', '=', 'users.ID_SPV_Owner')
        ->get();
        return $brng;
    }   

    public static function fetchUserJoinSPVOwner($id)
    {   
        $brng =  DB::table('users')
        ->join('spv_owner', 'spv_owner.ID_SPV_Owner', '=', 'users.ID_SPV_Owner')
        ->where('users.ID_User', $id)
        ->get();
        return $brng;
    }

    public static function fetchjoinSPVOwner($id)
    {
        $brng =  DB::table('users')
        ->join('spv_owner', 'spv_owner.ID_SPV_Owner', '=', 'users.ID_SPV_Owner')
        ->where('ID_User',$id)
        ->first();
        return $brng;
    }
}