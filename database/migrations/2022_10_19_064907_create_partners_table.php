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
        Schema::create('partners', function (Blueprint $table) {
            $table->id();
            $table->string('partner_title',100)->nullable();
            $table->string('partner_url',190)->nullable();
            $table->string('partner_logo')->nullable();
            $table->integer('partner_sorting')->nullable();
            $table->integer('partner_creator')->nullable();
            $table->integer('partner_editor')->nullable();
            $table->string('partner_slug',40)->nullable();
            $table->integer('partner_status')->default(1);
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
        Schema::dropIfExists('partners');
    }
};
