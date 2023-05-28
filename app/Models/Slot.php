<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int|mixed|string day_no
 * @property mixed start_time
 * @property mixed end_time
 */
class Slot extends Model
{
    use HasFactory;
    public $table = 'available_slots';
    public static array $DAYS = [
        1 => "Monday",
        2 => "Tuesday",
        3 => "Wednesday",
        4 => "Thursday",
        5 => "Friday",
        6 => "Saturday",
        7 => "Sunday",
    ];
}
