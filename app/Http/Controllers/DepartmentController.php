<?php

namespace App\Http\Controllers;
use App\Models\Department;
use Yajra\DataTables\DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\DepartmentStoreRequest;
use App\Http\Requests\DepartmentUpdateRequest;

class DepartmentController extends Controller
{

    /**
     * Display a listing of the resource.
    */
    public function index()
    {
        return view('department.dept');
    }


    /**
     * Display a listing of the resource.
     */
    public function datatable(Request $request)
    {
        ## check ajax request found or not
        if ($request->ajax()) {
            ## query for result
            $resultData = Department::get();
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


                ->addColumn('created_at', function ($resultData) {
                    return $resultData->created_at;
                })

                ->addColumn('is_active', function ($resultData) {
                    return status($resultData->is_active);
                })

                ->rawColumns(['actions', 'created_at', 'is_active'])
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

         return view('department.deptCreate')->render();
     }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */


    public function store(DepartmentStoreRequest $request)
    {

        $store = Department::create([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        ## return message
        if ($store) {
            return response()->json(['status' => '200', 'msg' => 'Department  Inserted!!']);
        }
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $resultData = Department::find($id);

        return view('department.deptUpdate', compact(['resultData']))->render();
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function update(DepartmentUpdateRequest $request, $id)
    {
        $resultData = Department::where('id', $id)
            ->update([
                'name' => $request->name,
            ]);

        ## return message
        if ($resultData) {
            return response()->json(['status' => '200', 'msg' => 'Department Data Updated!!']);
        }
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
            $findData = Department::find($id);
            $status = $findData->is_active == '1' ? '0' : '1';
            $resultData = Department::where('id', $id)
                ->update(['is_active' => $status]);

            ## return message
            if ($resultData) {
                return response()->json(['status' => '200', 'msg' => 'Department Status Change!!']);
            }
        }
    }

}
