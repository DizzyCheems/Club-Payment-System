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
        
        public function getPaymentsCountAttribute()
        {
            return Payment::where('agenda_id', $this->id)->count();
        }

            // Define a method to get the total amount of payments for this agenda
    public function getTotalPaymentsAmountAttribute()
    {
        return Payment::where('agenda_id', $this->id)->sum('amount');
    }
}
