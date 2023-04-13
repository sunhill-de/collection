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
        Schema::create('eventtypes', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->string('name',100);
            $table->string('allowed_objects',400)->nullable()->default(null);
            $table->enum('type',['change','happening']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('eventtypes');
    }
};
