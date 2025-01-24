<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    protected $table = 'states';

    protected $fillable = [
        'name',
        'code',
    ];

    public function cities()
    {
        return $this->hasMany(City::class);
    }
}
