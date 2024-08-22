<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{

    /** 
     * Return a paginate list of users.
     * 
     * This method retrieves a paginated list of users from database
     * and returns as a JSON response.
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function index() : JsonResponse
    {
        // retrieve users
        $users = User::orderBy('id', 'DESC')->paginate(2);

        // return data from users
        return response()->json([
            'status' => true,
            'users' => $users
        ], 200);
    }

    /**
     * Display details from specified user.
     * 
     * This method returns details from a specific user in JSON format.
     * 
     * @param \App\Models\User $user is the object of the specified user
     * @return \Illuminate\Http\JsonResponse
     */
    public function show (User $user) : JsonResponse
    {
        // return data from selected user
        return response()->json([
            'status' => true,
            'user' => $user
        ], 200);
    }

    /**
     * Creates a new user with data from the request.
     * 
     * @param App\Http\Requests\UserRequest $request is the object from the request containing the user data to be created.
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(UserRequest $request) : JsonResponse
    {
        // begin transaction in the database
        DB::beginTransaction();

        try {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => $request->password
            ]);

            // operation successfull
            DB::commit();

            // return suscessfull message
            return response()->json([
                'status' => true,
                'user' => $user,
                'message' => 'User sucessfully inserted!'
            ], 201);
        } catch (Exception $e) {

            // rollback
            DB::rollBack();

            //return error message
            return response()->json([
                'status' => false,
                'message' => 'User not inserdet. An error occurred.'
            ], 400);
        }
    }

    /**
     * Updates data from an existing user based on data provided by the request.
     * 
     * @param App\Http\Requests\UserRequest $request is the object from the request containing the user data to be updated.
     * * @return \Illuminate\Http\JsonResponse
     */
    public function update(UserRequest $request, User $user) : JsonResponse
    {
        // begin transaction
        DB::beginTransaction();

        try {
            $user->update([
                'name' => $request->name,
                'email' => $request->email,
                'password' => $request->password
            ]);

        DB::commit();

        // return suscessfull message
        return response()->json([
            'status' => true,
            'user' => $user,
            'message' => 'User sucessfully updated!'
        ], 200);


        } catch (Exception $e) {
            // rollback
            DB::rollBack();

            //return error message
            return response()->json([
                'status' => false,
                'message' => 'User not updated. An error occurred.'
            ], 400);
        }
    }

    /**
     * Deletes an existing user from the database.
     * 
     * @param \App\Models\User $user is the object to be deleted.
     * * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(User $user) : JsonResponse
    {
        try {
            $user->delete();
            // return data from selected user
            return response()->json([
                'status' => true,
                'user' => $user,
                'message' => 'User successfully deleted!'
            ], 200);
        } catch (Exception $e) {
            //return error message
            return response()->json([
                'status' => false,
                'message' => 'User not deleted. An error occurred.'
            ], 400);
        }
        
    }
}
