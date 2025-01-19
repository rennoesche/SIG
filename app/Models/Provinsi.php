<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Provinsi extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'boundary',
        'latitude',
        'longitude',
        'populasi',
        'gdp',
        'penduduk_miskin',
        'usia_produktif',
        'pengangguran',
        'buta_aksara',
        'pendidikan_s1',
    ];

    protected $casts = [
        'boundary' => 'array',
    ];

    public function cities() {
        return $this->hasMany(Kota::class);
    }
}
