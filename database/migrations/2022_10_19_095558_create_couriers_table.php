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
        Schema::create('couriers', function (Blueprint $table) {
            $table->id();
            $table->string('courier_name')->unique();
            $table->string('courier_slug')->nullable();
            $table->string('courier_charge')->nullable();
            $table->integer('courier_city')->nullable();
            $table->integer('courier_zone')->nullable();
            $table->integer('courier_active')->default(1);
            $table->integer('courier_orderby')->nullable();
            $table->integer('courier_creator')->nullable();
            $table->integer('courier_editor')->nullable();
            $table->integer('courier_status')->default(1);
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
        Schema::dropIfExists('couriers');
    }
};
