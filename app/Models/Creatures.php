<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Creatures extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'pv',
        'atk',
        'def',
        'speed',
        'CreatureType',
        'CreatureRace',
        'capture_rate',
        'user_id'
        ];

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }
}
