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
        Schema::create('therapists_slots', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('therapists_id')->nullable();
            $table->integer('clinic_id')->nullable();
            $table->integer('duration')->nullable();
            $table->integer('break_time')->nullable();
            $table->json('slots')->nullable();
            $table->text('services')->nullable();
            $table->text('available_at')->nullable();
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
        Schema::dropIfExists('therapists_slots');
    }
};
