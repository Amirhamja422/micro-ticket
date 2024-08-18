<?php

namespace App\Http\Controllers;

use App\Http\Requests\RoleStoreRequest;
use App\Http\Requests\RoleUpdateRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\Facades\DataTables;

class RoleController extends Controller
{
    /**
     * constructor
     */
    public function __construct()
    {
        $this->middleware(['role_or_permission:role']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('role.role');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function datatable(Request $request)
    {
        ## check ajax request found or not
        if ($request->ajax()) {
            ## query for result
            $resultData = Role::get();

            ## return data to datatable
            return DataTables::of($resultData)
                ->addColumn('actions', function ($resultData) {
                    ## Edit button
                    $html = "<a href='javascript:void(0)' class='text-primary p-1' onclick='editModal(" . $resultData->id . ")' title='Edit'><i class='bi bi-pencil-square'></i></a>&nbsp;";

                    $html .= "<a href='javascript:void(0)' class='text-danger p-1' onclick='deleteData(" . $resultData->id . ")' title='Delete'><i class='bi bi-trash'></i></a>&nbsp;";

                    return $html;
                })

                ->addColumn('created_at', function ($resultData) {
                    return $resultData->created_at;
                })

                ->addColumn('permissions', function ($resultData) {
                    $permissionNames = $resultData->permissions->pluck('name')->toArray();
                    return showPermissionsName($permissionNames);;
                })

                ->rawColumns(['actions', 'created_at', 'permissions'])
                ->make(true);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        ## get permission group data with permission name
        $permission_groups = DB::table('permission_groups')
            ->leftJoin('permissions', 'permission_groups.id', '=', 'permissions.group_id')
            ->select('permission_groups.id as group_id', 'permission_groups.name as group_name', 'permissions.id as permission_id', 'permissions.name as permission_name')
            ->orderBy('permission_groups.id')
            ->get();

        ## process data for view
        $groupedPermissions = [];
        foreach ($permission_groups as $permission) {
            $groupId = $permission->group_id;

            if (!isset($groupedPermissions[$groupId])) {
                $groupedPermissions[$groupId] = [
                    'group_id' => $groupId,
                    'group_name' => $permission->group_name,
                    'permissions' => [],
                ];
            }

            if (!empty($permission->permission_name) && !empty($permission->permission_id)) {
                $groupedPermissions[$groupId]['permissions'][] = [
                    'id' => $permission->permission_id,
                    'name' => $permission->permission_name,
                ];
            }
        }
        $results = array_values($groupedPermissions);

        ## return response
        return view('role.create', compact(['results']))->render();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RoleStoreRequest $request)
    {
        $role = Role::create(['name' => $request->name]);
        $resultData = $role->syncPermissions($request->checkPermission);

        ## return response
        if ($resultData) {
            return response()->json(['status' => '200', 'msg' => 'Role Created!!']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $role = DB::table('roles')->where('id', $id)->first();

        ## get permission group data with permission name
        $permission_groups = DB::table('permission_groups')
            ->leftJoin('permissions', 'permission_groups.id', '=', 'permissions.group_id')
            ->select('permission_groups.id as group_id', 'permission_groups.name as group_name', 'permissions.id as permission_id', 'permissions.name as permission_name')
            ->orderBy('permission_groups.id')
            ->get();

        ## process data for view
        $groupedPermissions = [];
        foreach ($permission_groups as $permission) {
            $groupId = $permission->group_id;

            if (!isset($groupedPermissions[$groupId])) {
                $groupedPermissions[$groupId] = [
                    'group_id' => $groupId,
                    'group_name' => $permission->group_name,
                    'permissions' => [],
                ];
            }

            if (!empty($permission->permission_name) && !empty($permission->permission_id)) {

                $hasPermission = DB::table('role_has_permissions')
                    ->where('permission_id', $permission->permission_id)
                    ->where('role_id', $role->id)
                    ->count();

                $groupedPermissions[$groupId]['permissions'][] = [
                    'id' => $permission->permission_id,
                    'name' => $permission->permission_name,
                    'is_checked' => $hasPermission > 0 ? 'checked' : '',
                ];
            }
        }
        $results = array_values($groupedPermissions);

        ## return response
        return view('role.edit', compact(['results', 'role']))->render();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(RoleUpdateRequest $request, $id)
    {
        ## update data
        DB::table('roles')
            ->where('id', $id)
            ->update(['name' => $request->name]);

        ## assign role
        $role = Role::findById($request->id);
        $role->syncPermissions($request->checkPermission);

        ## return response
        return response()->json(['status' => '200', 'msg' => 'Role Updated!!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
