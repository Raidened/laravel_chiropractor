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
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->bigInteger('schedule_id')->unsigned()->default(1); // Set default value
            $table->bigInteger('client_id')->unsigned();
            $table->string('client_note');
            $table->boolean('status');
            $table->string('doctor_name');
            $table->string('type');
            $table->dateTime('date');
            $table->foreign('client_id')->references('id')->on('users');
            $table->foreign('schedule_id')->references('id')->on('schedules');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appointments');
    }
};
