<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


/**
 * @method static paginate(int $int)
 * @method static where(string $string, $slug)
 * @method static inRandomOrder()
 * @method static orderBy(string $string, string $string1)
 */
class Product extends Model
{
    use HasFactory;

    protected $table="products";

}
