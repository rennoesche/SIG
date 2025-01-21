<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Kabkota extends Model
{
    use HasFactory;

    protected $table = 'kabkota';

    protected $guarded = [];

    protected $fillable = [
        'provinsi_id', 'nama', 'latitude', 'longitude', 'populasi', 'kodepos', 'kecamatan', 'desa', 'islam', 'kristen', 'katolik', 'hindu', 'pk_petani', 'pk_nelayan', 'pk_pedagang', 'pk_asn'
    ];

    public function provinsi()
    {
        return $this->belongsTo(Provinsi::class);
    }
}
