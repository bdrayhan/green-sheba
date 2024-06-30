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
        Schema::create('static_banners', function (Blueprint $table) {
            $table->id();
            $table->string('sb_title');
            $table->string('sb_sub_title');
            $table->string('sb_button_url')->nullable();
            $table->string('sb_bg_color')->nullable();
            $table->string('sb_image')->nullable();
            $table->string('sb_banner_type')->comment('1: Top Banner, 2: Footer Banner');
            $table->string('sb_slug');
            $table->integer('sb_status')->default(1)->comment('1: Active, 0: Inactive');
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
        Schema::dropIfExists('static_banners');
    }
};
