<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pay extends Model
{
    use HasFactory;
    
    protected $fillable = 
    [
        'payment_id',
        'student_id',
        'amount',
        'ref_num'
    ];

    public function students()
    {
        return $this->belongsTo(Student::class, 'student_id');
    }

    public function payments()
    {
        return $this->belongsTo(Payment::class, 'payment_id');
    }
}


