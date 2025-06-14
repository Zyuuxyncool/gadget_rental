<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lokasi extends Model
{
    use HasFactory;
    protected $table = 'lokasi';
    protected $fillable = [
        'tingkat',
        'nama',
        'parent_id',
    ];

    public function parent()
    {
        return $this->belongsTo(Lokasi::class, 'parent_id', 'id');
    }

}
