<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\Permission;
use Validator;
use DB;

class RoleController extends Controller
{

    protected $role;
    protected $permission;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth', 'checkRole']);
        $this->role = new Role();
        $this->permission = new Permission();
    }

    /**
     * Display a listing of the role.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        /**
         * getCollection from App/Models/Role
         *
         * @return mixed
         */
        $data['roleData'] = $this->role->getCollection();
        $data['masterManagementTab'] = "active open";
        $data['roleTab'] = "active";
        return view('role.rolelist', $data);
    }

    /**
     * Show the form for creating a new role.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['masterManagementTab'] = "active open";
        $data['roleTab'] = "active";
        $data['permissionData'] = $this->permission->getCollection();
        return view('role.add', $data);
    }

    /**
     * Display the specified role.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        /**
         * get details of the specified role. from App/Models/Role
         *
         * @param mixed $id
         * @param string (id) fieldname
         * @return mixed
         */
        $data['details'] = $this->role->getRoleByField($id, 'id');
        $data['permissionData'] = $this->permission->getCollection();
        $data['masterManagementTab'] = "active open";
        $data['roleTab'] = "active";
        return view('role.edit', $data);
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
            'role_type' => 'required|max:50',
            'code' => 'required|max:20|unique:tbl_user_role,code',
        );

        if ($mode == "edit") {
            $rules['code'] = 'required|max:20|unique:tbl_user_role,code,' . $data['id'] . ',id';
        }

        $validator = Validator::make($data, $rules);

        if ($validator->fails()) {
            $errorRedirectUrl = "role/add";
            if ($mode == "edit") {
                $errorRedirectUrl = "role/edit/" . $data['id'];
            }
            return redirect($errorRedirectUrl)->withInput()->withErrors($validator);
        }
        return false;
    }

    /**
     * Store a newly created role in storage.
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
        try{
            $addrole = $this->role->addRole($request->all());
            DB::commit();
        } catch (\Exception $e) {
            //exception handling
            DB::rollback();
            $errorMessage = '<a target="_blank" href="https://stackoverflow.com/search?q='.$e->getMessage().'">'.$e->getMessage().'</a>';
            $request->session()->flash('alert-danger', $errorMessage);
            return redirect('role/add')->withInput();

        }

        if ($addrole) {
            $request->session()->flash('alert-success', __('app.default_add_success',["module" => __('app.role')]));
            return redirect('role/list');
        } else {
            $request->session()->flash('alert-danger', __('app.default_error',["module" => __('app.role'),"action"=>__('app.add')]));
            return redirect('role/add')->withInput();
        }
    }

    /**
     * Update the specified role in storage.
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
        try{
            $addrole = $this->role->addRole($request->all());
            DB::commit();
        } catch (\Exception $e) {
            //exception handling
            DB::rollback();
            $errorMessage = '<a target="_blank" href="https://stackoverflow.com/search?q='.$e->getMessage().'">'.$e->getMessage().'</a>';
            $request->session()->flash('alert-danger', $errorMessage);
            return redirect('role/edit/' . $request->get('id'))->withInput();

        }

        if ($addrole) {
            $request->session()->flash('alert-success', __('app.default_edit_success',["module" => __('app.role')]));
            return redirect('role/list');
        } else {
            $request->session()->flash('alert-danger', __('app.default_error',["module" => __('app.role'),"action"=>__('app.update')]));
            return redirect('role/edit/' . $request->get('id'))->withInput();
        }
    }
}
