<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('variable_penilaian', function (Blueprint $table) {
            $table->bigInteger("kriteria")->default(0)->after("nama");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('variable_penilaian', function (Blueprint $table) {
            //
        });
    }
};
