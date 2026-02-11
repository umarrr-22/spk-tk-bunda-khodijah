<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nilai extends Model
{
    use HasFactory;

    protected $fillable = ['siswa_id', 'program_id', 'kriteria_id', 'nilai'];

    public function siswa()
    {
        return $this->belongsTo(Siswa::class);
    }

    public function program()
    {
        return $this->belongsTo(Program::class);
    }

    public function kriteria()
    {
        return $this->belongsTo(Kriteria::class);
    }
}