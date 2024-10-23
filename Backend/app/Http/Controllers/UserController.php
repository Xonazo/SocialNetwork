<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\UserRequest;


class UserController extends Controller
{
    public function createUser(UserRequest $request)
    {
       try{
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->save();
        return response()->json(['message' => 'User created', [$user]], 201);
       }catch( Exception $e){
        return response()->json(['message' => 'User not created'], 400);
       }

    }


    public function getUsers()
    {
        $users = User::all();
        return response()->json(['users' => $users], 200);
    }

    public function getUser(Request $request){
       try{
        $id = $request->input('id');
        $user = User::find($id);
        return response()->json(['user' => $user], 200);

       }catch( Exception $e){
            return response()->json(['message' => 'User not found'], 404);
       }
    }

    public function deleteUser(Request $request){

        try{
            $id = $request->input('id');
            $user = User::find($id);
            $user->delete();
            return response()->json(['message' => 'User deleted', [$user]], 200);
        }
        catch( Exception $e){
            return response()->json(['message' => 'User not found'], 404);
        }
    }

}
