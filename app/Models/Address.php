<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $fillable = ['cep', 'street', 'number', 'city', 'state', 'country', 'user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
