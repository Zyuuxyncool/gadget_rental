<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Customer;
use App\Models\Item;

class Transaction extends Model
{
    protected $table = 'transactions';
    protected $fillable = [
        'customer_id',
        'item_id',
        'price',
        'date',
        'time',
        'return_date',
        'status',
    ];

    // Status
    const STATUSES = [
        0 => 'Belum Dikembalikan',
        1 => 'Sudah Dikembalikan',
        2 => 'Terlambat',
        3 => 'Dibatalkan'
    ];

    public function item()
    {
        return $this->belongsTo(Item::class, 'item_id');
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }

    public function getStatusCaptionAttribute()
    {
        return self::STATUSES[$this->attributes['status']] ?? 'Unknown';
    }
}
