<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;
    protected $fillable = 
    [
        'agenda_id',
        'student_id',
        'amount',
        'type',
        'method'
    ];

    public function agendas()
    {
        return $this->belongsTo(Agenda::class, 'agenda_id');
    }

    public function students()
    {
        return $this->belongsTo(Student::class, 'student_id');
    }
}
