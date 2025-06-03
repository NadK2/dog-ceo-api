<?php
namespace App\Http\Controllers;

use App\Models\Park;
use Illuminate\Http\Request;

class ParkController extends Controller
{

    public function associateBreed(Request $request, Park $park)
    {
        $id = $request->input('id');

        //Here we would check to see if a breed is valid and if allowed in given park.
        //This can be achieved by creating a table to whitelist breeds allowed in parks.
        //or we could blacklist and only store breeds not allowed per park.

        //e.g
        //---------------------
        //park_breeds_allowed
        //---------------------
        //id | park_id | breed_id

        //return response()->json(['error' => 'Breed cannot be associated with park'], 500);

        //used syncWithoutDetaching so data is not duplicated.
        $park->breeds()->syncWithoutDetaching([$id]);

        return response()->json(['message' => 'Breed associated with park']);
    }
}
