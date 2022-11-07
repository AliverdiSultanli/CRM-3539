<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryShop extends Model
{
    use HasFactory;

    protected $table = 'category_shop';

    protected $fillable = ['category_id', 'shop_id'];
}
