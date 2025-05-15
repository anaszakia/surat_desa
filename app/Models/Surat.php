<?php

namespace App\Models;

use App\Models\Ttd;
use App\Models\KategoriSurat;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Surat extends Model
{
     use HasFactory;

    protected $fillable = [
        'kategori_surat_id',
        'nama_lengkap',
        'nik',
        'alamat',
        'tanggal_terbit',
        'nomor_surat',
        'data_lainnya',
        'jenis_kelamin',
        'pekerjaan',
        'keperluan',
        'ttd_id',
        'tempat_lahir',
        'tanggal_lahir',
        'agama'
    ];

    protected $casts = [
        'data_lainnya' => 'array',
        'tanggal_terbit' => 'date',
    ];

    public function kategori()
    {
        return $this->belongsTo(KategoriSurat::class, 'kategori_surat_id');
    }

    public function ttd()
    {
        return $this->belongsTo(Ttd::class, 'ttd_id');
    }

    // Logic penomoran otomatis bisa diletakkan di boot method
    protected static function booted()
    {
        static::creating(function ($surat) {
            $kategori = KategoriSurat::find($surat->kategori_surat_id);
            $kodeSurat = $kategori->kode;

            $tanggal = $surat->tanggal_terbit ?? now();
            $tahun = $tanggal->format('Y');
            $bulan = $tanggal->format('m');
            $tgl = $tanggal->format('d');

            $count = Surat::where('kategori_surat_id', $surat->kategori_surat_id)
                ->whereYear('tanggal_terbit', $tahun)
                ->count() + 1;

            $nomorUrut = str_pad($count, 4, '0', STR_PAD_LEFT);
            $surat->nomor_surat = "$kodeSurat/$nomorUrut/$tgl/$bulan/$tahun";
        });
    }
}
