<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static where(string $string, int $int)
 */
class HomeSlider extends Model
{
    use HasFactory;

    protected $table='home_sliders';

}
