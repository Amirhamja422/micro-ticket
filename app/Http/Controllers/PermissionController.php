<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class PermissionController extends Controller
{
    /**
     * constructor
     */
    public function __construct()
    {
        $this->middleware(['role_or_permission:permission']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('permission.permission');
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
            $resultData = DB::table('permissions')->get();

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
                    $html .= "<a href='javascript:void(0)' class='text-danger p-1' onclick='deleteData(" . $resultData->id . ")' title='Delete'><i class='bi bi-trash'></i></a>&nbsp;";

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
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
