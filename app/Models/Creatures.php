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

    public static function search(?string $name = null, ?int $minPv = null, ?int $maxPv = null)
    {
        $query = self::query();

        if (!is_null($name)) {
            $query->where('name', 'like', '%' . $name . '%');
        }

        if (!is_null($minPv)) {
            $query->where('pv', '>=', $minPv);
        }

        if (!is_null($maxPv)) {
            $query->where('pv', '<=', $maxPv);
        }

        return $query->get();
    }
}
