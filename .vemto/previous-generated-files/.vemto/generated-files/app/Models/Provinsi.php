<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Provinsi extends Model
{
    use HasFactory;

    protected $table = 'provinsi';

    protected $guarded = [];

    public function kabkotas()
    {
        return $this->hasMany(Kabkota::class);
    }
}
