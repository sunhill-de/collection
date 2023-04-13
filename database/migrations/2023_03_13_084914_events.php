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
        Schema::create('sunhillevents', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->integer('object_id');
            $table->integer('type_id');
            $table->datetime('stamp');
            $table->string('payload',10)->nullable()->default(null);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sunhillevents');
    }
};
