<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /*
    * example request data to link user to a park or breed.
    *
    *   {
    *     "id": 1, //id of [park,breed]
    *     "type": "park" // type of assocation ["park","breed"].
    *   }
    *
    */
    public function associate(Request $request, User $user)
    {
        $type = $request->input('type');
        $id   = $request->input('id');

        if ($type === 'park') {
            //used syncWithoutDetaching so data is not duplicated.
            $user->parks()->syncWithoutDetaching([$id]);
            return response()->json(['message' => 'Park associated with user']);
        } elseif ($type === 'breed') {
            $user->breeds()->syncWithoutDetaching([$id]);
            return response()->json(['message' => 'Breed associated with user']);
        }

        return response()->json(['error' => 'Invalid type'], 400);
    }
}
