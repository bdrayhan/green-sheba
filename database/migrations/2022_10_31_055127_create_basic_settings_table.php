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
        Schema::create('basic_settings', function (Blueprint $table) {
            $table->id();
            $table->string('basic_company', 150)->nullable();
            $table->string('basic_title', 190)->nullable();
            $table->string('basic_url', 100)->nullable();
            $table->string('invoice_code', 10)->nullable();
            $table->string('basic_logo', 100)->nullable();
            $table->string('basic_flogo', 100)->nullable();
            $table->string('basic_favicon', 100)->nullable();
            $table->longText('thanks_notes')->nullable();
            $table->mediumText('invoice_note')->nullable();
            $table->mediumText('invoice_additional')->nullable();
            $table->integer('basic_status')->default(1);
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
        Schema::dropIfExists('basic_settings');
    }
};
