<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
     protected $fillable = [
        'title',
        'description',
        'category',
        'price',
        'duration',
        'thumbnail',
        'status',
        'instructor_name',
        'published_at',
    ];

    public function modules()
    {
        return $this->hasMany(Module::class);
    }
}
