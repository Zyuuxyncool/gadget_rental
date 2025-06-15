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
        'address',
        'image',
        'photo1',
        'photo2',
        'photo3',
        'provinsi_id',
        'kabupaten_id',
        'kecamatan_id',
        'kelurahan_id',
    ];

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    public function provinsi()
    {
        return $this->belongsTo(Lokasi::class, 'provinsi_id');
    }

    public function kabupaten()
    {
        return $this->belongsTo(Lokasi::class, 'kabupaten_id');
    }

    public function kecamatan()
    {
        return $this->belongsTo(Lokasi::class, 'kecamatan_id');
    }

    public function kelurahan()
    {
        return $this->belongsTo(Lokasi::class, 'kelurahan_id');
    }

    public function getLokasiAttribute()
    {
        $lokasi = [];
        if ($this->provinsi) $lokasi[] = $this->provinsi->nama;
        if ($this->kabupaten) $lokasi[] = $this->kabupaten->nama;
        if ($this->kecamatan) $lokasi[] = $this->kecamatan->nama;
        if ($this->kelurahan) $lokasi[] = $this->kelurahan->nama;
        return implode(', ', $lokasi);
    }
}
