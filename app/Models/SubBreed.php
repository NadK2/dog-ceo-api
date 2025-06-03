<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SubBreed extends Model
{
    protected $guarded = [];
    //

    /**
     *
     */
    public function breed(): BelongsTo
    {
        return $this->belongsTo(Breed::class, 'breed_id');
    }
}
