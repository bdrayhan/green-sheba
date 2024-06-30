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
        Schema::create('courier_cities', function (Blueprint $table) {
            $table->id();
            $table->integer('courier_id');
            $table->integer('city_id');
            $table->string('cc_slug')->nullable();
            $table->string('cc_active')->default(1);
            $table->integer('cc_orderby')->nullable();
            $table->integer('cc_creator')->nullable();
            $table->integer('cc_editor')->nullable();
            $table->integer('cc_status')->default(1);
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
        Schema::dropIfExists('courier_cities');
    }
};
