<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $fillable = 
    [
        'course_name',
        'year_level',
        'section',
        'color',
    ];

    public function students()
    {
        return $this->hasMany(Student::class);
    }

}