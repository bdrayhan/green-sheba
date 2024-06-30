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
        Schema::create('banners', function (Blueprint $table) {
            $table->id();
            $table->string('banner_title')->nullable();
            $table->string('banner_slug')->nullable();
            $table->string('banner_mid_title')->nullable();
            $table->string('banner_sub_title')->nullable();
            $table->string('banner_button')->nullable();
            $table->string('banner_url')->nullable();
            $table->string('banner_image')->nullable();
            $table->integer('banner_sorting')->nullable();
            $table->integer('banner_publish')->default(0);
            $table->integer('banner_creator')->nullable();
            $table->integer('banner_editor')->nullable();
            $table->integer('banner_status')->default(1);
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
        Schema::dropIfExists('banners');
    }
};
