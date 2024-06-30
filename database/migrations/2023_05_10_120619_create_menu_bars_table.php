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
        Schema::create('menu_bars', function (Blueprint $table) {
            $table->id();
            $table->string('menu_name')->unique();
            $table->string('menu_link')->nullable();
            $table->string('menu__color')->nullable();
            $table->string('menu__bg_color')->nullable();
            $table->integer('menu_order')->nullable();
            $table->integer('menu_status')->default(1)->comment('1=Active, 0=Inactive');
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
        Schema::dropIfExists('menu_bars');
    }
};
