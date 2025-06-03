<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $table = 'customers';
    protected $fillable = [         
        'name',
        'no_id',
        'phone',
        'address'
    ];

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
}