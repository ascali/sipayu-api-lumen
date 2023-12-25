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
        Schema::create('advertisments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('type')->nullable();
            $table->longText('image')->nullable();
            $table->longText('url')->nullable();
            $table->longText('description')->nullable();
            $table->datetime('efective')->nullable();
            $table->datetime('expired')->nullable();
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();
            $table->boolean('status')->nullable();
            $table->string('type_ads')->nullable();
            $table->float('price_ads')->nullable();
            $table->string('name_advertiser')->nullable();
            $table->string('email_advertiser')->nullable();
            $table->string('telp_advertiser')->nullable();
            $table->integer('impression')->nullable();
            $table->integer('clicked')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('advertisments');
    }
};
