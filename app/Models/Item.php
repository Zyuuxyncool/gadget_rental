<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $table = 'items';
    protected $fillable = [
        'id',
        'name',
        'description',
        'price',
        'image'
    ];

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
}
