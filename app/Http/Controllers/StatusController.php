<?php

namespace App\Http\Controllers;

use App\Models\Status;
use Yajra\DataTables\DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\StatusStoreRequest;
use App\Http\Requests\StatusUpdateRequest;
class StatusController extends Controller
{
       /**
     * Display a listing of the resource.
    */
    public function index()
    {
        return view('status.status');
    }


        /**
     * Display a listing of the resource.
     */
    public function datatable(Request $request)
    {
        ## check ajax request found or not
        if ($request->ajax()) {
            ## query for result
            $resultData = Status::get();
            ## return data to datatable
            return DataTables::of($resultData)
                ->addColumn('actions', function ($resultData) {
                    ## Edit button
                    $html = "<a href='javascript:void(0)' class='text-primary p-1' onclick='editModal(" . $resultData->id . ")' title='Edit'><i class='bi bi-pencil-square'></i></a>&nbsp;";

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
         return view('status.statusCreate')->render();
     }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(StatusStoreRequest $request)
    {

        $store = Status::create([
            'name' => $request->name,
        ]);

        ## return message
        if ($store) {
            return response()->json(['status' => '200', 'msg' => 'Status  Inserted!!']);
        }
    }

        /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $resultData = Status::find($id);

        return view('status.statusUpdate', compact(['resultData']))->render();
    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */


    public function update(StatusUpdateRequest $request, $id)
    {
        $resultData = Status::where('id', $id)
            ->update([
                'name' => $request->name,
            ]);

        ## return message
        if ($resultData) {
            return response()->json(['status' => '200', 'msg' => 'Ticket Status Data Updated!!']);
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
            $findData = Status::find($id);
            $status = $findData->is_active == '1' ? '0' : '1';
            $resultData = Status::where('id', $id)
                ->update(['is_active' => $status]);

            ## return message
            if ($resultData) {
                return response()->json(['status' => '200', 'msg' => 'Ticket Status Change!!']);
            }
        }
    }

}
