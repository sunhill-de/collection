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
        Schema::create('import_movies', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->string('title', 200);       // Title of the movie
            $table->string('source', 50);       // Source of the movie (like videobuster, MyMovies, etc.)
            $table->string('source_id', 20)->nullable()->default(null);  // If possible an unique id of the source 
            $table->string('imdb_id', 10)->nullable()->default(null);      // If given the imdb id
            $table->integer('object_id')->default(0);       // If already imported the object id
            $table->enum('type',['movie','series','episode'])->default('movie');          // Is this a series or a movie
            $table->integer('season')->nullable()->default(null);
            $table->integer('episode')->nullable()->default(null);
            $table->integer('series')->nullable()->default(null);
        });
    }
    
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('import_movies');
        //
    }

};
