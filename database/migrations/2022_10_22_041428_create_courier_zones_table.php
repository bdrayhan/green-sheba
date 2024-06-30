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
        Schema::create('courier_zones', function (Blueprint $table) {
            $table->id();
            $table->integer('courier_id');
            $table->integer('cc_id');
            $table->string('zone_name');
            $table->string('zone_slug')->nullable();
            $table->integer('zone_active')->default(1);
            $table->integer('zone_orderby')->nullable();
            $table->integer('zone_creator')->nullable();
            $table->integer('zone_editor')->nullable();
            $table->integer('zone_status')->default(1);
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
        Schema::dropIfExists('courier_zones');
    }
};
