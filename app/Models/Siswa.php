<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama', 
        'usia', 
        'kelas', 
        'jenis_kelamin', 
        'kegiatan', 
        'kebutuhan_khusus'
    ];

    public function nilais()
    {
        return $this->hasMany(Nilai::class);
    }

    // Tambahan method untuk rekomendasi usia
    public function getAgeRecommendation()
    {
        if ($this->usia >= 5) {
            return "Siswa sudah cukup umur untuk semua program kegiatan";
        } elseif ($this->usia >= 4) {
            return "Siswa dapat mengikuti program dengan pengawasan khusus";
        } else {
            return "Siswa disarankan mengikuti program dasar dengan intensitas rendah";
        }
    }

    // Tambahan method untuk kategori usia
    public function getAgeCategory()
    {
        if ($this->usia >= 5) {
            return "TK B";
        } else {
            return "TK A";
        }
    }
}