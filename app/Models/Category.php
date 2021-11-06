<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static paginate(int $int)
 * @method static whereIn(string $string, string[] $cats)
 * @method static find(int $int)
 */
class Category extends Model
{
    use HasFactory;

    protected $table='categories';



}
