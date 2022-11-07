<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Shop extends Model
{
    use SoftDeletes, HasFactory;

    protected $fillable = ['name', 'slug'];

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class);
    }
}
