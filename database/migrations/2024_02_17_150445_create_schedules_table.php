<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('schedules', function (Blueprint $table) {
            $table->id();
            $table->date('day');
            $table->time('hour_start');
            $table->time('hour_end');
            $table->timestamps();
        });

    }

    public function down()
    {
        Schema::dropIfExists('schedules');
    }
};
