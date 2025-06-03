<?php
namespace App\Http\Controllers;

use App\Http\Resources\BreedDataJson;
use App\Models\Breed;
use Exception;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Http;

class BreedController extends Controller
{
    //this can be placed in the .env or DB.
    private $baseUrl = 'https://dog.ceo/api';

    // Get all breeds
    public function index()
    {
        //have made the API calls directly in the controller. but could also
        //create a class to handle the requests and return results here.
        try {
            $response = Http::get("$this->baseUrl/breeds/list/all");

            if ($response->successful()) {
                //Sync data to local DB. This could also be done via a scheduled command.
                $this->sync($response->json('message'));
            }

            return response()->json($response->json(), $response->status());

        } catch (Exception $e) {
            return response()->json(['error' => 'an error has occurred'], 500);
        }
    }

    // Get a specific breed
    public function show($breed)
    {
        try {
            $response = Http::get("$this->baseUrl/breed/$breed/list");

            return response()->json($response->json(), $response->status());

        } catch (Exception $e) {
            return response()->json(['error' => 'an error has occurred'], 500);
        }
    }

    // Get random breed image
    public function random()
    {
        try {
            $response = Http::get("$this->baseUrl/breeds/image/random");
            return response()->json($response->json(), $response->status());
        } catch (Exception $e) {
            return response()->json(['error' => 'an error has occurred'], 500);
        }
    }

    // Get an image by breed
    public function image($breed)
    {
        try {
            $response = Http::get("$this->baseUrl/breed/{$breed}/images/random");
            return response()->json($response->json(), $response->status());
        } catch (Exception $e) {
            return response()->json(['error' => 'an error has occurred'], 500);
        }
    }

    //
    public function details($breed)
    {
        //fetch breed by name. and load relations.
        $breed = Breed::with('parks', 'users')->where('name', $breed)->firstOrFail();

        //used json resource to cleanup response.
        //removed the default "data" key to keep response
        //uniform
        JsonResource::withoutWrapping();
        return new BreedDataJson($breed);
    }

    /**
     *
     */
    private function sync($data)
    {
        $data = collect($data);

        //delete any breeds/sub-breeds locally that dont exist on api.
        Breed::whereNotIn('name', $data->keys()->toArray())->delete();

        foreach ($data as $breedName => $subBreeds) {
            //create breed if not exists.
            $breed = Breed::firstOrCreate(['name' => $breedName]);

            if (! empty($subBreeds)) {
                // Delete sub-breeds not in API
                $breed->subBreeds()->whereNotIn('name', $subBreeds)->delete();

                // Add new sub-breeds
                foreach ($subBreeds as $sub) {
                    $breed->subBreeds()->firstOrCreate(['name' => $sub]);
                }
            } else {
                // If there are no sub-breeds in API, delete all local sub-breeds
                $breed->subBreeds()->delete();
            }

        }
    }
}
