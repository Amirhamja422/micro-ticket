<?php
namespace App\Http\Controllers\API;
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\User;
use Validator;
use App\Http\Resources\UsersResource;
use App\Http\Resources\Resource;
use Illuminate\Http\JsonResponse;

class RegsController extends BaseController
{
    /**
     * Register api
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

    // Validate the request
    $validator = Validator::make($request->all(), [
        // 'name' => 'required|string|max:255',
        'name' => 'required|unique:users,name', // Ensure the name is unique
        'email' => 'required|email|unique:users,email',
        'password' => 'required|string|min:6',
        'number' => 'required|string|max:20',
    ]);

    // Return validation errors if validation fails
    if ($validator->fails()) {
        return $this->sendError('Validation Error.', $validator->errors(), 422);
    }

    // Sanitize and prepare the data for storing
    $input = $request->only(['name', 'email', 'password', 'number']);
    // $input['password'] = Hash::make($input['password']); // Use Hash for password encryption
    $input['password'] = bcrypt($input['password']);

    // Create the user
    $user = User::create($input);

    // Generate API token for the user
    $success['token'] = $user->createToken('token')->plainTextToken;
    $success['name'] = $user->name;
    $success['number'] = $user->number;

    // Return success response
    return $this->sendResponse($success, 'User registered successfully.');
}

}


