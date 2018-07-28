<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RolePermission extends Model
{
    protected $table = 'tbl_role_permission';
    protected $primaryKey = 'id';


    public function Role()
    {
        return $this->hasMany('App\Models\Role');
    }

}
