<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    protected $table = 'tbl_permission';
    protected $primaryKey = 'id';

    public function RolePermission()
    {
        return $this->belongsToMany('App\Models\RolePermission','tbl_role_permission','permission_id');
    }

    /**
     * Get all Permissions getCollection
     *
     * @return mixed
     */
    public function getCollection()
    {
        return Permission::get();
    }

    /**
     * Add & update Permission addPermission
     *
     * @param array $models
     * @return boolean true | false
     */
    public function addPermission(array $models = [])
    {
        if (isset($models['id'])) {
            $permission = Permission::find($models['id']);
        } else {
            $permission = new Permission;
            $permission->created_at = date('Y-m-d H:i:s');
        }

        $permission->name = $models['name'];
        $permission->code = $models['code'];
        $permission->updated_at = date('Y-m-d H:i:s');
        $permissionId = $permission->save();

        if ($permissionId)
            return true;
        else
            return false;
    }

    /**
     * get Permission By fieldname getPermissionByField
     *
     * @param mixed $id
     * @param string $field_name
     * @return mixed
     */
    public function getPermissionByField($id, $field_name)
    {
        return Permission::where($field_name, $id)->first();
    }
}
