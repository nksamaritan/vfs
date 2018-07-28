<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Permission;
use Validator;
use DB;

class PermissionController extends Controller
{

    protected $permission;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth', 'checkRole']);
        $this->permission = new Permission();
    }

    /**
     * Display a listing of the permission.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        /**
         * getCollection from App/Models/Permission
         *
         * @return mixed
         */
        $data['permissionData'] = $this->permission->getCollection();
        $data['masterManagementTab'] = "active open";
        $data['permissionTab'] = "active";
        return view('permission.permissionlist', $data);
    }

    /**
     * Show the form for creating a new permission.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['masterManagementTab'] = "active open";
        $data['permissionTab'] = "active";
        return view('permission.add', $data);
    }

    /**
     * Display the specified permission.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        /**
         * get details of the specified permission. from App/Models/Permission
         *
         * @param mixed $id
         * @param string (id) fieldname
         * @return mixed
         */
        $data['details'] = $this->permission->getPermissionByField($id, 'id');
        $data['masterManagementTab'] = "active open";
        $data['permissionTab'] = "active";
        return view('permission.edit', $data);
    }

    /**
     * Validation of add and edit action customeValidate
     *
     * @param array $data
     * @param string $mode
     * @return mixed
     */
    public function customeValidate($data, $mode)
    {
        $rules = array(
            'name' => 'required|max:100',
            'code' => 'required|max:50|unique:tbl_permission,code',
        );

        if ($mode == "edit") {
            $rules['code'] = 'required|max:20|unique:tbl_permission,code,' . $data['id'] . ',id';
        }

        $validator = Validator::make($data, $rules);

        if ($validator->fails()) {
            $errorRedirectUrl = "permission/add";
            if ($mode == "edit") {
                $errorRedirectUrl = "permission/edit/" . $data['id'];
            }
            return redirect($errorRedirectUrl)->withInput()->withErrors($validator);
        }
        return false;
    }

    /**
     * Store a newly created permission in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(request $request)
    {
        $validations = $this->customeValidate($request->all(), 'add');
        if ($validations) {
            return $validations;
        }

        // Start Communicate with database
        DB::beginTransaction();
        try {
            $addpermission = $this->permission->addPermission($request->all());
            DB::commit();
        } catch (\Exception $e) {
            //exception handling
            DB::rollback();
            $errorMessage = '<a target="_blank" href="https://stackoverflow.com/search?q=' . $e->getMessage() . '">' . $e->getMessage() . '</a>';
            $request->session()->flash('alert-danger', $errorMessage);
            return redirect('permission/add')->withInput();
        }

        if ($addpermission) {
            $request->session()->flash('alert-success', __('app.default_add_success', ["module" => __('app.permission')]));
            return redirect('permission/list');
        } else {
            $request->session()->flash('alert-danger', __('app.default_error', ["module" => __('app.permission'), "action" => __('app.add')]));
            return redirect('permission/add')->withInput();
        }
    }

    /**
     * Update the specified permission in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function update(request $request)
    {
        $validations = $this->customeValidate($request->all(), 'edit');
        if ($validations) {
            return $validations;
        }

        // Start Communicate with database
        DB::beginTransaction();
        try {
            $addpermission = $this->permission->addPermission($request->all());
            DB::commit();
        } catch (\Exception $e) {
            //exception handling
            DB::rollback();
            $errorMessage = '<a target="_blank" href="https://stackoverflow.com/search?q=' . $e->getMessage() . '">' . $e->getMessage() . '</a>';
            $request->session()->flash('alert-danger', $errorMessage);
            return redirect('permission/edit/' . $request->get('id'))->withInput();

        }

        if ($addpermission) {
            $request->session()->flash('alert-success', __('app.default_edit_success', ["module" => __('app.permission')]));
            return redirect('permission/list');
        } else {
            $request->session()->flash('alert-danger', __('app.default_error', ["module" => __('app.permission'), "action" => __('app.update')]));
            return redirect('permission/edit/' . $request->get('id'))->withInput();
        }
    }
}
