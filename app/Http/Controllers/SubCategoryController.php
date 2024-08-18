<?php

namespace App\Http\Controllers;

use App\Models\SubCategory;
use App\Models\Category;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\SubcategoryStoreRequest;
use App\Http\Requests\SubcategoryUpdateRequest;
class SubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('subcategory.subCategory');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $subcategory = Category::where('is_active', '1')->get();
        return view('subcategory.subCategoryCreate', compact(['subcategory']))->render();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

     public function store(SubcategoryStoreRequest $request)
     {
         $store = SubCategory::create([
            'cat_id' => $request->cat_id,
             'sub_cat_name' => $request->sub_cat_name
         ]);

         ## return message
         if ($store) {
             return response()->json(['status' => '200', 'msg' => 'Sub Category  Inserted!!']);
         }
     }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categoryData = Category::where('is_active', '1')->get();
        $subcategoryData = SubCategory::find($id);
        return view('subcategory.subcategoryUpdate', compact(['categoryData','subcategoryData']))->render();
    }


    /**
     * Display a listing of the resource.
    */
    public function datatable(Request $request)
    {
        ## check ajax request found or not
        if ($request->ajax()) {
            ## query for result
            $resultData = SubCategory::with(['cat_name'])->get();
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

                ->addColumn('is_active', function ($resultData) {
                    return status($resultData->is_active);
                })

                ->rawColumns(['actions', 'created_at', 'is_active'])
                ->make(true);
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
            $findData = SubCategory::find($id);
            $status = $findData->is_active == '1' ? '0' : '1';
            $resultData = SubCategory::where('id', $id)
                ->update(['is_active' => $status]);

            ## return message
            if ($resultData) {
                return response()->json(['status' => '200', 'msg' => 'Subcategory Status Change!!']);
            }
        }
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SubcategoryUpdateRequest $request, $id)
    {
        ## fid user and save data
        $subcatname = SubCategory::find($request->id);
        $subcatname->cat_id = $request->cat_id;
        $subcatname->sub_cat_name = $request->sub_cat_name;
        $subcatname->save();
        ## return message
        return response()->json(['status' => '200', 'msg' => 'Subcategory Data Updated!!']);
    }

}
