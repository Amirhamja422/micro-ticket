<?php
namespace App\Http\Controllers\API;
use Validator;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Resources\Resource;
use Illuminate\Http\JsonResponse;
use App\Http\Resources\CategryApiResource;
use App\Http\Controllers\API\BaseController as BaseController;

class CategoryapiController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
        {
            $perPage = $request->input('per_page', 3); // Default to 10 items per page
            $cats = Category::paginate($perPage);

            return response()->json([
                'data' => CategryApiResource::collection($cats),
                'meta' => [
                    'total' => $cats->total(),
                    'currentPage' => $cats->currentPage(),
                    'lastPage' => $cats->lastPage(),
                    'perPage' => $cats->perPage(),
                ],
                'links' => [
                    'first' => $cats->url(1),
                    'last' => $cats->url($cats->lastPage()),
                    'prev' => $cats->previousPageUrl(),
                    'next' => $cats->nextPageUrl(),
                ],
            ], 200);
        }


    public function store(Request $request)
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'cat_name' => 'required|unique:categories,cat_name',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $cat = Category::create($input);

        return $this->sendResponse(new CategryApiResource($cat), 'Category created successfully.');
    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $dept)
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'cat_name' => 'required|unique:categories,cat_name,' . $dept->id,
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $dept->cat_name = $input['cat_name'];
        $dept->save();

        return $this->sendResponse(new CategryApiResource($dept), 'Category updated successfully.');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

     public function destroy($id)
     {
         // Find the Category by ID
         $dept = Category::find($id);

         // Check if the Category exists
         if (!$dept) {
             return $this->sendError('Category not found.');
         }

         // Delete the Category
         $dept->delete();

         // Return a success response
         return $this->sendResponse([], 'Category deleted successfully.');
     }
}
