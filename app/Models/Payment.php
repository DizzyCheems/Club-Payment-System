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
        'method',
        'approved'
    ];

    public function agendas()
    {
        return $this->belongsTo(Agenda::class, 'agenda_id');
    }

    public function students()
    {
        return $this->belongsTo(Student::class, 'student_id');
    }
    public function pays()
    {
        return $this->hasMany(Pay::class, 'payment_id');
    }
}
