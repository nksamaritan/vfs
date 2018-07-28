<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;
    protected $table = 'users';
    protected $primaryKey = 'id';
    protected $dates = ['deleted_at'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'first_name', 'last_name', 'joining_date', 'role_id', 'landline_number',
        'mobile_number', 'status', 'created_by', 'updated_by'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function Role()
    {
        return $this->hasOne('App\Models\Role', 'id', 'role_id');
    }

    public function ParentUser()
    {
        return $this->belongsTo('App\Models\User', 'parent_id');
    }

    public function UserPermission()
    {
        return $this->hasManyThrough(
            'App\Models\RolePermission', 'App\Models\Role',
            'id', 'role_id', 'role_id'
        );
    }

    /**
     * Get all User getCollection
     *
     * @return mixed
     */
    public function getCollection()
    {

        return User::with('Role', 'ParentUser')->get();
    }

    /**
     * Get all User with role and ParentUser relationship
     *
     * @return mixed
     */
    public function getDatatableCollection()
    {
        return User::with('Role', 'ParentUser');
    }

    /**
     * Query to get user total count
     *
     * @param $dbObject
     * @return integer $userCount
     */
    public static function getUserCount($dbObject)
    {
        $userCount = $dbObject->count();
        return $userCount;
    }

    /**
     * Scope a query to get all data
     *
     * @param  \Illuminate\Database\Eloquent\Builder $query
     * @param  Request $request
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeGetUserData($query, $request)
    {
        return $query->skip($request->start)->take($request->length)->get(config('constant.userFieldArray'));
    }

    /**
     * scopeGetFilteredData from App/Models/User
     * get filterred users
     *
     * @param  object $query
     * @param  \Illuminate\Http\Request $request
     * @return mixed
     */
    public function scopeGetFilteredData($query, $request)
    {
        $filter = $request->filter;
        $Datefilter = $request->filterDate;
        $filterSelect = $request->filterSelect;

        /**
         * @param string $filter  text type value
         * @param string $Datefilter  date type value
         * @param string $filterSelect select value
         *
         * @return mixed
         */
        return $query->where(function ($query) use ($filter, $Datefilter, $filterSelect) {
            if (!empty($filter) > 0) {
                foreach ($filter as $key => $value) {
                    if ($value != "") {
                        $query->where($key, 'LIKE', '%' . trim($value) . '%');
                    }
                }
            }

            if (!empty($Datefilter) > 0) {
                foreach ($Datefilter as $dtkey => $dtvalue) {
                    if ($dtvalue != "") {
                        $query->where($dtkey, 'LIKE', '%' . date('Y-m-d', strtotime(trim($dtvalue))) . '%');
                    }
                }
            }

            if (!empty($filterSelect) > 0) {
                foreach ($filterSelect as $Sekey => $Sevalue) {
                    if ($Sevalue != "") {
                        $query->whereRaw('FIND_IN_SET(' . trim($Sevalue) . ',' . $Sekey . ')');
                    }
                }
            }

        });

    }

    /**
     * Scope a query to sort data
     *
     * @param  \Illuminate\Database\Eloquent\Builder $query
     * @param  Request $request
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeSortUserData($query, $request)
    {

        return $query->orderBy(config('constant.userDataTableFieldArray')[$request->order['0']['column']], $request->order['0']['dir']);

    }

    /**
     * Scope a query to sort data
     *
     * @param  \Illuminate\Database\Eloquent\Builder $query
     * @param  string $column
     * @param  string $dir
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeSortDefaultDataByRaw($query, $column, $dir)
    {
        return $query->orderBy($column, $dir);
    }

    /**
     * Add & update User addUser
     *
     * @param array $models
     * @return boolean true | false
     */
    public function addUser(array $models = [])
    {
        if (isset($models['id'])) {
            $user = User::find($models['id']);
        } else {
            $user = new User;
            $user->created_at = date('Y-m-d H:i:s');
            $user->created_by = Auth::user()->id;
            $user->password = bcrypt($models['password']);
            $user->email = $models['email'];
        }

        $user->name = $models['first_name'] . " " . $models['last_name'];
        $user->first_name = $models['first_name'];
        $user->last_name = $models['last_name'];
        $user->role_id = $models['role_id'];
        if (isset($models['status'])) {
            $user->status = $models['status'];
        } else {
            $user->status = 0;
        }

        $user->updated_by = Auth::user()->id;
        $user->updated_at = date('Y-m-d H:i:s');
        $userId = $user->save();

        if ($userId) {
            if (!isset($models['id'])) {
                $user->password = $models['password'];
            }
            $user->subjectLine = "Welcome to IMS";
            $user->viewTemplate = "emails.user_signup";
            return $user;
        } else {
            return false;
        }
    }

    /**
     * get User By fieldname getUserByField
     *
     * @param mixed $id
     * @param string $field_name
     * @return mixed
     */
    public function getUserByField($id, $field_name)
    {
        return User::where($field_name, $id)->first();
    }

    /**
     * update User Status
     *
     * @param array $models
     * @return boolean true | false
     */
    public function updateStatus(array $models = [])
    {
        $user = User::find($models['id']);
        $user->status = $models['status'];
        $user->updated_by = Auth::user()->id;
        $user->updated_at = date('Y-m-d H:i:s');
        $userId = $user->save();
        if ($userId)
            return true;
        else
            return false;

    }

    /**
     * update User's Password
     *
     * @param array $models
     * @return boolean true | false
     */
    public function updateChangePassword(array $models = [])
    {
        $user = User::find(Auth::user()->id);
        $user->password = bcrypt($models['new_password']);
        $user->updated_by = Auth::user()->id;
        $user->updated_at = date('Y-m-d H:i:s');
        $userId = $user->save();
        if ($userId)
            return true;
        else
            return false;

    }

    /**
     * Delete User
     *
     * @param int $id
     * @return boolean true | false
     */
    public function deleteUser($id)
    {
        $delete = User::where('id', $id)->delete();
        if ($delete)
            return true;
        else
            return false;

    }

    /**
     * update User's Token
     *
     * @param array $models
     * @return mixed
     */
    public function updateUserTokens(array $models = [])
    {
        $user = User::find(Auth::id());
        $user->device_token = $models['device_token'];
        $user->device_type = $models['device_type'];
        $user->api_token = str_random(60);
        $user_id = $user->save();
        if($user_id){
            return $user;
        }
        return false;
    }
}
