<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table = 'tbl_user_role';
    protected $primaryKey = 'id';


    public function RolePermission()
    {
        return $this->belongsToMany('App\Models\RolePermission','tbl_role_permission','role_id','permission_id')->withTimestamps();
    }

    public function Permissions()
    {
        return $this->hasMany('App\Models\RolePermission','role_id','id');
    }

    /**
     * Get all Roles getCollection
     *
     * @return mixed
     */
    public function getCollection()
    {
        return Role::get();
    }

    /**
     * Add & update Role addRole
     *
     * @param array $models
     * @return boolean true | false
     */
    public function addRole(array $models = [])
    {
        if (isset($models['id'])) {
            $role = Role::find($models['id']);
        } else {
            $role = new Role;
            $role->created_at = date('Y-m-d H:i:s');
        }

        $role->role_type = $models['role_type'];
        $role->code = $models['code'];
        $role->updated_at = date('Y-m-d H:i:s');
        $roleId = $role->save();

        if (isset($models['id'])) {
            $role->RolePermission()->detach();
        }

        if(isset($models['permission_ids'])){
            foreach ($models['permission_ids'] as $prms_id){
                $role->RolePermission()->attach($prms_id);
            }
        }
        if ($roleId)
            return true;
        else
            return false;
    }

    /**
     * get Role By fieldname getRoleByField
     *
     * @param mixed $id
     * @param string $field_name
     * @return mixed
     */
    public function getRoleByField($id, $field_name)
    {
        return Role::with('Permissions')->where($field_name, $id)->first();
    }

}
