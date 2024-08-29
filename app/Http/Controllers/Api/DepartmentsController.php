<?php
namespace App\Http\Controllers\API;
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\Department;
use Validator;
use App\Http\Resources\DepartmentsResource;
use App\Http\Resources\Resource;
use Illuminate\Http\JsonResponse;

class DepartmentsController extends BaseController
{
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    // public function index()
    // {
    //     $departments = Department::all();

    // //    return $tickets;
    //     return $this->sendResponse(DepartmentsResource::collection($departments), 'Department retrieved successfully.');
    // }


    public function index(Request $request)
        {
            $perPage = $request->input('per_page', 3); // Default to 10 items per page
            $departments = Department::paginate($perPage);

            return response()->json([
                'data' => DepartmentsResource::collection($departments),
                'meta' => [
                    'total' => $departments->total(),
                    'currentPage' => $departments->currentPage(),
                    'lastPage' => $departments->lastPage(),
                    'perPage' => $departments->perPage(),
                ],
                'links' => [
                    'first' => $departments->url(1),
                    'last' => $departments->url($departments->lastPage()),
                    'prev' => $departments->previousPageUrl(),
                    'next' => $departments->nextPageUrl(),
                ],
            ], 200);
        }


    /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */

    public function store(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'name' => 'required',
            'email' => 'required',
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());
        }
        $department = Department::create($input);

        return $this->sendResponse(new DepartmentsResource($department), 'Department created successfully.');
    }



     /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function update(Request $request, Department $dept)
    {

        $input = $request->all();
        $validator = Validator::make($input, [
            'name' => 'required',
            'email' => 'required'
        ]);
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());
        }
        $dept->name = $input['name'];
        $dept->email = $input['email'];
        $dept->save();

        return $this->sendResponse(new DepartmentsResource($dept), 'Department updated successfully.');
    }


    /**
    * Display the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */

    // public function show($id)
    // {
    //     $dept = Department::find($id);
    //     if (is_null($dept)) {
    //         return $this->sendError('Department not found.');
    //     }
    //     return $this->sendResponse(new DepartmentsResource($dept), 'Department retrieved successfully.');
    // }

    public function show(Request $request)
    {
    $perPage = $request->input('per_page', 2); // Default to 10 items per page
    $depts = Department::paginate($perPage);

    return response()->json([
        'data' => DepartmentsResource::collection($depts),
        'meta' => [
            'total' => $depts->total(),
            'currentPage' => $depts->currentPage(),
            'lastPage' => $depts->lastPage(),
            'perPage' => $depts->perPage(),
        ],
        'links' => [
            'first' => $depts->url(1),
            'last' => $depts->url($depts->lastPage()),
            'prev' => $depts->previousPageUrl(),
            'next' => $depts->nextPageUrl(),
        ],
    ], 200);
}


/**
 * Remove the specified resource from storage.
 *
 * @param  int  $id
 * @return \Illuminate\Http\Response
 */
public function destroy($id)
{
    // Find the department by ID
    $dept = Department::find($id);

    // Check if the department exists
    if (!$dept) {
        return $this->sendError('Department not found.');
    }

    // Delete the department
    $dept->delete();

    // Return a success response
    return $this->sendResponse([], 'Department deleted successfully.');
}

}
