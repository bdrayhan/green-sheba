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
        Schema::create('analytics', function (Blueprint $table) {
            $table->id();
            $table->text('google_analytic')->nullable();
            $table->text('facebook_pixel')->nullable();
            $table->text('bing_analytic')->nullable();
            $table->string('google_site_verification')->nullable();
            $table->string('facebook_site_verification')->nullable();
            $table->string('bing_site_verification')->nullable();
            $table->text('custom_header_script')->nullable();
            $table->text('custom_footer_script')->nullable();
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
        Schema::dropIfExists('analytics');
    }
};
