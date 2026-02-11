<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kriteria extends Model
{
    use HasFactory;

    protected $fillable = ['nama', 'bobot'];

    public function nilais()
    {
        return $this->hasMany(Nilai::class);
    }
}
