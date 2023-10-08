<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = 
    [
        'name',
        'id_num',
        'social_acc',
        'payment_acc'
    ];

    public function courses()
    {
        return $this->belongsTo(Course::class, 'course_id');
    }

}
