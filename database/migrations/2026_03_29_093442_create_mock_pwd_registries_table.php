<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('mock_pwd_registries', function (Blueprint $table) {
            $table->id();
            $table->string('id_number')->unique(); // e.g., 'PWD-CEBU-12345'
            $table->string('full_name'); // To double-check against the user's name if you want
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mock_pwd_registries');
    }
};
