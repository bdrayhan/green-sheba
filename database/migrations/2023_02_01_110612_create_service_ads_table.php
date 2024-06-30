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
        Schema::create('service_ads', function (Blueprint $table) {
            $table->id();
            $table->string('sa_icon');
            $table->string('sa_title');
            $table->string('sa_sub_title');
            $table->string('sa_slug');
            $table->integer('sa_status')->default(1);
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
        Schema::dropIfExists('service_ads');
    }
};
