<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kota extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'province_id', 'latitude', 'longitude'];

    public function province() {
        return $this->belongsTo(Provinsi::class);
    }
}
