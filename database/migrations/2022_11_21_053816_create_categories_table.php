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
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('pc_name', 255)->unique();
            $table->string('pc_url', 255)->nullable();
            $table->text('pc_remarks', 255)->nullable();
            $table->string('pc_image', 255)->nullable();
            $table->integer('pc_feature')->default(0);
            $table->integer('pc_orderby')->nullable();
            $table->integer('pc_active')->default(1);
            $table->integer('pc_creator')->nullable();
            $table->integer('pc_editor')->nullable();
            $table->string('pc_slug', 255)->nullable();
            $table->integer('pc_status')->default(1);
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
        Schema::dropIfExists('categories');
    }
};
