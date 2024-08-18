<?php

namespace App\Http\Controllers;

use App\Models\Classification;
use App\Models\Product;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\ClassificationStoreRequest;
use App\Http\Requests\ClassificationUpdateRequest;
class ClassificationController extends Controller
{
    //

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('classification.classification');
    }

    /**
     * Display a listing of the resource.
     */
    public function datatable(Request $request)
    {
        ## check ajax request found or not
        if ($request->ajax()) {
            ## query for result
            $resultData = Classification::with(['product_name'])->get();
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

                ->addColumn('classification_sla', function ($resultData) {
                    return number_format($resultData->classification_sla/60, 2); // Rounds to 2 decimal places

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
        $products = Product::where('is_active', '1')->get();
        return view('classification.classificationCreate', compact(['products']))->render();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

     public function store(ClassificationStoreRequest $request)
     {
         $store = Classification::create([
            'product_id' => $request->product_id,
             'classification_name' => $request->classification_name,
             'classification_sla' => $request->classification_sla*60
         ]);

         ## return message
         if ($store) {
             return response()->json(['status' => '200', 'msg' => 'Classification  Inserted!!']);
         }
     }


    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // $products = Product::where('is_active', '1')->get();
        $products = DB::table('products')->get();
        $resultData = Classification::find($id);
        return view('classification.classificationUpdate', compact(['products','resultData']))->render();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ClassificationUpdateRequest $request, $id)
    {
        ## fid user and save data
        $classification = Classification::find($request->id);
        $classification->product_id = $request->product_id;
        $classification->classification_name = $request->classification_name;
        $classification->classification_sla = $request->classification_sla*60;
        $classification->save();
        ## return message
        return response()->json(['status' => '200', 'msg' => 'Classification Data Updated!!']);
    }



}
