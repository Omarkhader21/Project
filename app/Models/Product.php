<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


/**
 * @method static paginate(int $int)
 * @method static where(string $string, $slug)
 * @method static inRandomOrder()
 */
class Product extends Model
{
    use HasFactory;

    protected $table="products";

    protected $perPage=5;

}
