<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pay extends Model
{
    use HasFactory;
    
    protected $fillable = 
    [
        //'payment_id',
        //'student_id',
        'amount',
        'type',
        'method'
    ];

    public function payments()
    {
        return $this->belongsTo(Payment::class, 'student_id');
    }
}


