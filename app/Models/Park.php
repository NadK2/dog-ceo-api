<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class Park extends Model
{
    /**
     *
     */
    protected $fillable = ['name'];

    /**
     *
     */
    public function users(): MorphToMany
    {
        return $this->morphedByMany(User::class, 'parkable');
    }

    /**
     *
     */
    public function breeds(): MorphToMany
    {
        return $this->morphToMany(Breed::class, 'breedable');
    }
}
