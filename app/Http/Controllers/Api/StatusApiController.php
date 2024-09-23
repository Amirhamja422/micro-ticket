<?php
namespace App\Http\Controllers\API;
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\Status;
use Validator;
use App\Http\Resources\StatusApiResource;
use App\Http\Resources\Resource;
use Illuminate\Http\JsonResponse;


class StatusApiController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
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
         $input = $request->all();

         $validator = Validator::make($input, [
             'name' => 'required|unique:statuses,name',
         ]);

         if ($validator->fails()) {
             return $this->sendError('Validation Error.', $validator->errors());
         }

         $status = Status::create($input);

         return $this->sendResponse(new StatusApiResource($status), 'Status created successfully.');
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
