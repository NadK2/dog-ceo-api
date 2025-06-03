<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class Breed extends Model
{
    protected $fillable = ['name'];

    /*
     *
     */
    public function users(): MorphToMany
    {
        return $this->morphedByMany(User::class, 'breedable');
    }

    /*
     *
     */
    public function parks(): MorphToMany
    {
        return $this->morphedByMany(Park::class, 'breedable');
    }

    /*
     *
     */
    public function subBreeds(): HasMany
    {
        return $this->hasMany(SubBreed::class, 'breed_id');
    }
}
