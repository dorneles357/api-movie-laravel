<?php
 
namespace App\Http\Controllers\Api;

use App\Models\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function show($id)
    {
        $user = User::find($id);
        return response()->json($user);
    }

    public function update(Request $request, $id)
    {   $data = [
            "name"=> $request->name,
            "email"=> $request->email,
            "password"=> $request->password
        ];

        $user = User::find($id);

       $user->update($data);

        return response()->json(['status'=>'update']);
    }


    public function destroy($id)
    {
        $user = User::find($id);

        $user->delete($user);

        return response()->json(['status'=>'deleted']);
    }
}