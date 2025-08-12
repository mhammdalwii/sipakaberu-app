<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Posyandu extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'address',
        'village',
        'sub_district',
        'schedule_day',
        'schedule_time',
        'contact_person',
        'phone_number',
    ];
}
