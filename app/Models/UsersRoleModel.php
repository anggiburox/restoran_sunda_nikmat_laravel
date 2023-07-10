<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class UsersRoleModel extends Model
{
    use HasFactory;

    protected $table='users_role';  
    protected $fillable=['ID_User_Roles','Role'];  
    public $timestamps = false;
    public $incrementing = false;
    protected $primaryKey = 'ID_User_Roles';
}