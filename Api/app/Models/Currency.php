<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class currency extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'code', 'symbol'];

    public function fromPairs()
    {
        return $this->hasMany(Pairs::class, 'from_id');
    }

    public function toPairs()
    {
        return $this->hasMany(Pairs::class, 'to_id');
    }

}
