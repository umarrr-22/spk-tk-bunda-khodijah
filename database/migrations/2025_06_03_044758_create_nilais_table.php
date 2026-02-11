<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('nilais', function (Blueprint $table) {
            $table->id();
            $table->foreignId('siswa_id')->constrained();
            $table->foreignId('program_id')->constrained();
            $table->foreignId('kriteria_id')->constrained();
            $table->float('nilai');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('nilais');
    }
};