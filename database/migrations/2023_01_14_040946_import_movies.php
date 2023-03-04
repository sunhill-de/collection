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
            $table->integer('imported_id');
            $table->integer('possible_duplicate')->default(0);
            $table->string('title',200);
            $table->string('ean',30)->searchable()->nullable();
            $table->enum('medium_type',['DVD','Blu-ray','Stream']);
            $table->string('year',4)->nullable();
            $table->string('imdb_id',15)->searchable()->nullable();
            $table->integer('length')->nullable();
            $table->integer('director')->default(0);
            $table->integer('object_id')->default(0);
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
