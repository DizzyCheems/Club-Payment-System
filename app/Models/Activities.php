<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activities extends Model
{
    use HasFactory;
    protected $fillable = 
    [
        'agenda_id',
        'activity_name',
        'date',
        'fund',
    ];

    public function agendas()
    {
        return $this->belongsTo(Agenda::class, 'agenda_id');
    }

}



