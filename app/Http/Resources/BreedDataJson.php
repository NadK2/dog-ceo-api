<?php
namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BreedDataJson extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "message" => [
                'id'         => $this->id,
                'name'       => $this->name,
                'sub_breeds' => $this->subBreeds->pluck('name'),
                'parks'      => ParkJson::collection($this->parks),
                'users'      => UserJson::collection($this->users),
            ],
        ];
    }
}
