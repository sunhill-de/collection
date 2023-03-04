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
        Schema::create('person_movie_assoc', function (Blueprint $table) {
            $table->integer('movie_id');
            $table->integer('person_id');
            $table->string('job',50);
            $table->index(['movie_id','person_id','job']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('person_movie_assoc');
    }
};
