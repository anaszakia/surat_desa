<?php

namespace App\Models;

use App\Models\Surat;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class KategoriSurat extends Model
{
    use HasFactory;
    protected $fillable = [
        'nama',
        'slug',
        'kode'
    ];

     public function surats()
    {
        return $this->hasMany(Surat::class);
    }
}
