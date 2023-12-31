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
        Schema::create('e_brosures', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->longText('image')->nullable();
            $table->text('description')->nullable();
            $table->datetime('efective')->nullable();
            $table->datetime('expired')->nullable();
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('e_brosures');
    }
};
