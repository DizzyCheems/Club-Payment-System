<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agenda extends Model
{
    use HasFactory;
    protected $fillable = 
    [
        'agenda_name',
        'deadline',
        'total_fund',
        'students_paid',
    ];


    public function students()
    {
        return $this->hasMany(Student::class);
    }
}
