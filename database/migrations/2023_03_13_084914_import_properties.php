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
        Schema::create('import_properties', function (Blueprint $table) {
            $table->id()->autoIncrement();
            
            $table->string('name',200);
            $table->string('ean',20)->nullable()->default(null);
            $table->string('type',30);
            $table->integer('object_id')->default(0);
            $table->string('refering_table')->nullable()->default(null);
            $table->integer('refering_id')->nullable()->default(null);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('import_properties');
    }
};
