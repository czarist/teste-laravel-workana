<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;

    protected $fillable = [
        'cep', 'street', 'number', 'city', 'state', 'country', 'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
