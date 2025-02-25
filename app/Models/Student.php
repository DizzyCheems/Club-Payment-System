<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = 
    [
        'course_id',
        'user_id',
        'name',
        'id_num',
        'social_acc',
        'payment_acc'
    ];

    public function courses()
    {
        return $this->belongsTo(Course::class, 'course_id');
    }

    public function users()
    {
        return $this->belongsTo(User::class, 'user_id')->withDefault();
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }
}
