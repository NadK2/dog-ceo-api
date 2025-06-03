<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class User extends Model
{
    /**
     *
     */
    protected $fillable = ['email', 'name', 'location'];

    /**
     *
     */
    public function parks(): MorphToMany
    {
        return $this->morphToMany(Park::class, 'parkable');
    }

    /**
     *
     */
    public function breeds(): MorphToMany
    {
        return $this->morphToMany(Breed::class, 'breedable');
    }
}
