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
        Schema::table('prestasis', function (Blueprint $table) {
            if (Schema::hasColumn('prestasis', 'published_at')) {
                $table->dateTime('published_at')->nullable()->change();
            } else {
                $table->dateTime('published_at')->nullable();
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('prestasis', function (Blueprint $table) {
            if (Schema::hasColumn('prestasis', 'published_at')) {
                $table->dateTime('published_at')->nullable(false)->change();
            }
        });
    }
};
