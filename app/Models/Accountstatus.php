<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Accountstatus extends Model
{
    use HasFactory;
    use HasFactory;
    protected $fillable = 
    [
        'accountstatus',
        'description',
    ];

    public function users()
    {
        return $this->hasMany(User::class);
    }
}
