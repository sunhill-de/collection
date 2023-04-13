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
        Schema::create('import_persons', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->string('first_names',100);
            $table->string('last_names',100);
            $table->string('type',50);
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
        Schema::dropIfExists('import_persons');
        //
    }
};
