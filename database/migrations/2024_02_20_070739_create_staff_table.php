<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('staff', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('motto', 255)->nullable();
            $table->longText('address')->nullable();
            $table->string('position', 100)->nullable();
            $table->string('mapel', 150)->nullable();
            $table->string('phone', 100)->nullable()->default('0');
            $table->string('photo', 100)->nullable();
            $table->string('facebook', 100)->nullable()->default('https://www.facebook.com/');
            $table->string('instagram', 100)->nullable()->default('https://www.instagram.com/');
            $table->string('twitter', 100)->nullable()->default('https://twitter.com/');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('staff');
    }
};
