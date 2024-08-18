<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Department;
use App\Models\Designation;
use App\Models\userDept;
use App\Models\UserSignature;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Http\Requests\SignatureStoreRequest;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use DOMDocument;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('user.user');
    }

    /**
     * Display a listing of the resource.
     */
    public function datatable(Request $request)
    {
        ## check ajax request found or not
        if ($request->ajax()) {
            ## query for result
            $resultData = User::with(['department_name'])->get();
            $resultsJoinData = DB::table('departments')
            ->join('user_depts', 'departments.id', '=', 'user_depts.department_id')
            ->join('users', 'users.id', '=', 'user_depts.user_id')
            ->select('departments.name', 'user_depts.user_id')
            ->get();

        ## Organize department names by user ID
        $userDepartments = [];
        foreach ($resultsJoinData as $deptDataGet) {
            $userDepartments[$deptDataGet->user_id][] = $deptDataGet->name;
        }
            ## return data to datatable
            return DataTables::of($resultData)
                ->addColumn('actions', function ($resultData) {
                    ## Edit button
                    $html = "<a href='javascript:void(0)' class='text-primary p-1' onclick='editModal(" . $resultData->id . ")' title='Edit'><i class='bi bi-pencil-square'></i></a>&nbsp;";

                    ## Delete button
                    if ($resultData->is_active == '1') {
                        $html .= "<a href='javascript:void(0)' class='text-danger p-1' onclick='changeStatus(" . $resultData->id . ")' title='Inactive'><i class='bi bi-x-square margin-right-0'></i></a>";
                    } else {
                        $html .= "<a href='javascript:void(0)' class='text-success p-1' onclick='changeStatus(" . $resultData->id . ")' title='Active'><i class='bi bi-check-square margin-right-0'></i></a>";
                    }

                    return $html;
                })
                ->addColumn('department', function ($resultData) use ($userDepartments) {
                    $departments = $userDepartments[$resultData->id] ?? [];
                    $colors = ['mediumaquamarine', 'burlywood', 'lightsteelblue','darkgray']; // Example colors array
                    $html = '';
                    foreach ($departments as $index => $department) {
                        $color = $colors[$index % count($colors)]; // Get color based on index
                        $html .= '<span class="chip chip" style="background-color: ' . $color . '">' . htmlspecialchars($department) . '</span>';
                    }
                    return $html;
                })
                ->addColumn('role_designation', function ($resultData) {
                    return roleViewForUser($resultData->getRoleNames());
                })

                ->addColumn('signature', function ($resultData) {
                    return $resultData->signature;
                })

                ->addColumn('is_active', function ($resultData) {
                    return status($resultData->is_active);
                })

                ->rawColumns(['actions', 'signature', 'is_active', 'role_designation','department'])
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
        $departments = Department::where('is_active', '1')->get();
        $roles = DB::table('roles')->get();

        return view('user.userCreate', compact(['departments', 'roles']))->render();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(UserStoreRequest $request)
    {

            // $user_id = Auth::user()->id;
            // $signature = $request->signature;
            $store = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'number' => $request->number,
                'password' => Hash::make("12345678"),
            ]);


            foreach ($request->department_id as $dept_id) {
            userDept::create([
                'user_id' => $store->id,
                'department_id' =>$dept_id,
            ]);
        }

        ## return message
        if ($store) {
            ## set role under user
            if ($request->role_id) {
                $store->assignRole($request->role_id);
            }

            return response()->json(['status' => '200', 'msg' => 'User  Inserted!!']);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $resultData = User::find($id);

        $departments = Department::where('is_active', '1')->get();
        $rolesData = DB::table('roles')->get();
        $selectedRole = $resultData->roles->pluck('id')->toArray();

        return view('user.userUpdate', compact(['resultData', 'departments', 'rolesData', 'selectedRole']))->render();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserUpdateRequest $request, $id)
    {
        ## fid user and save data
        $user = User::find($request->id);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->number = $request->number;
        $user->department_id = $request->department_id;
        $user->save();

        ## detach previous role
        $user->roles()->detach();

        ## assign new role
        if ($request->role_id) {
            $user->assignRole($request->role_id);
        }

        ## return message
        return response()->json(['status' => '200', 'msg' => 'User Data Updated!!']);
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function statusChange($id)
    {
        if (!empty($id)) {
            $findData = User::find($id);
            $status = $findData->is_active == '1' ? '0' : '1';
            $resultData = User::where('id', $id)
                ->update(['is_active' => $status]);

            ## return message
            if ($resultData) {
                return response()->json(['status' => '200', 'msg' => 'User Status Change!!']);
            }
        }
    }


    public function userIndex(){
        return view('signature.signature');
    }


    public function userCreate(){
        $users = User::where('is_active', '1')->get();
        return view('signature.signatureCreate', compact(['users']))->render();

    }
    public function signatureStore(SignatureStoreRequest $request)
    {
        try {
            $description = $request->signature_file;
            $user_id = Auth::user()->id;

            // Load HTML safely
            libxml_use_internal_errors(true);
            $dom = new DOMDocument();
            $dom->loadHTML($description, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
            libxml_clear_errors();

            $images = $dom->getElementsByTagName('img');

            foreach ($images as $key => $img) {
                $src = $img->getAttribute('src');
                if (strpos($src, 'data:image') === 0) {
                    // Extract base64 image data
                    $data = substr($src, strpos($src, ',') + 1);
                    $image_data = base64_decode($data);

                    // Generate unique image name
                    $image_name = time() . '_' . $key . '.png';
                    // Store the image
                    Storage::disk('public')->put('attachments/images/' . $image_name, $image_data);

                    // Update img src attribute
                    $img->setAttribute('src', 'http://127.0.0.1:8000/storage/attachments/images/' . $image_name);
                }

                // Set fixed height and width
                $img->setAttribute('width', '100'); // Set width to 100px
                $img->setAttribute('height', '100'); // Set height to 100px

                // Set padding and margin
                // $img->setAttribute('style', 'padding: 10px; margin: 10px;');
            }

            // Save modified HTML with image paths
            $description = $dom->saveHTML();

            // Create user signature record
            UserSignature::create([
                'user_id' => $user_id,
                'signature_file' => $description,
            ]);

            return response()->json(['status' => '200', 'msg' => 'Signature File Inserted!!']);
        } catch (\Exception $e) {
            // Handle any exceptions
            return response()->json(['status' => '500', 'msg' => 'Error occurred: ' . $e->getMessage()], 500);
        }
    }




}
