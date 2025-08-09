<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class MedicinalPlant extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'scientific_name',
        'image',
        'description',
        'benefits',
        'how_to_use',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($plant) {
            if (empty($plant->slug)) {
                $plant->slug = Str::slug($plant->name);
            }
        });

        static::updating(function ($plant) {
            if (empty($plant->slug)) {
                $plant->slug = Str::slug($plant->name);
            }
        });
    }
}
