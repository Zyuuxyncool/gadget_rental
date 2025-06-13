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

    public static function boot()
    {
        Parent::boot();
        static::creating(function($customer){
            $customer->no_id = mt_rand(100000000, 999999999);
        });
    }
}