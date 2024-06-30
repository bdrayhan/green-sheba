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
        Schema::create('colors', function (Blueprint $table) {
            $table->id();
            $table->string('color_name')->unique();
            $table->string('color_code')->nullable();
            $table->string('color_url')->nullable();
            $table->integer('color_active')->default(1);
            $table->integer('color_creator')->nullable();
            $table->integer('color_editor')->nullable();
            $table->integer('color_orderby')->nullable();
            $table->string('color_slug')->nullable();
            $table->integer('color_status')->default(1);
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
        Schema::dropIfExists('colors');
    }
};
