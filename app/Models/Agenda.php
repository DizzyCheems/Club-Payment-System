<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Payment;

class Agenda extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'agenda_name',
        'deadline',
        'total_fund',
        'students_paid',
        'indiv_contrib'
    ];

    public function students()
    {
        return $this->hasMany(Student::class);
    }

    public function getPaymentsCountAttribute()
    {
        return Payment::where('agenda_id', $this->id)->count();
    }

    public function getTotalPaymentsAmountAttribute()
    {
        return Payment::where('agenda_id', $this->id)->sum('amount');
    }

    public function getAmountFromPaymentsAttribute()
    {
        return Payment::where('agenda_id', $this->id)->value('amount');
    }
}
