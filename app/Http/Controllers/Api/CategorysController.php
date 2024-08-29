<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\Category;
use Validator;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\Resource;
use Illuminate\Http\JsonResponse;

class CategorysController extends BaseController

{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $perPage = $request->input('per_page', 3); // Default to 10 items per page
        $categories = Category::paginate($perPage);

        return response()->json([
            'data' => CategoryResource::collection($categories),
            'meta' => [
                'total' => $categories->total(),
                'currentPage' => $categories->currentPage(),
                'lastPage' => $categories->lastPage(),
                'perPage' => $categories->perPage(),
            ],
            'links' => [
                'first' => $categories->url(1),
                'last' => $categories->url($categories->lastPage()),
                'prev' => $categories->previousPageUrl(),
                'next' => $categories->nextPageUrl(),
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

        // Validate input
        $validator = Validator::make($input, [
            'cat_name' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        // Check if the category already exists
        $existingCategory = Category::where('cat_name', $input['cat_name'])->first();
        if ($existingCategory) {
            return $this->sendError('Validation Error.', ['cat_name' => 'Category with this name already exists.']);
        }

        // Create new category if it doesn't exist
        $category = Category::create($input);

        return $this->sendResponse(new CategoryResource($category), 'Category created successfully.');
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function show($id)
    {
        $dept = Category::find($id);
        if (is_null($dept)) {
            return $this->sendError('Category not found.');
        }
        return $this->sendResponse(new CategoryResource($dept), 'Category retrieved successfully.');
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
        $input = $request->all();

        // Find the category by ID
        $cats = Category::find($id);

        if (!$cats) {
            return $this->sendError('Category not found.');
        }

        // Validate input
        $validator = Validator::make($input, [
            'cat_name' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        // Check if any other category has the same name
        $existingCategory = Category::where('cat_name', $input['cat_name'])->where('id', '!=', $id)->first();
        if ($existingCategory) {
            return $this->sendError('Validation Error.', ['cat_name' => 'Category with this name already exists.']);
        }

        // Update the category name if no conflict
        $cats->cat_name = $input['cat_name'];
        $cats->save();

        return $this->sendResponse(new CategoryResource($cats), 'Category updated successfully.');
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
