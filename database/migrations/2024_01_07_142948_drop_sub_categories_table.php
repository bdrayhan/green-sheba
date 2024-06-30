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
        // Drop SubCategories Table
        Schema::dropIfExists('sub_categories');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::create('sub_categories', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('category_id')->nullable();
            $table->string('psc_name', 255)->nullable();
            $table->string('psc_url', 255)->nullable();
            $table->text('psc_remarks')->nullable();
            $table->string('psc_image', 255)->nullable();
            $table->integer('psc_active')->default(1);
            $table->integer('psc_orderby')->nullable();
            $table->integer('psc_creator')->nullable();
            $table->integer('psc_editor')->nullable();
            $table->string('psc_slug', 255)->nullable();
            $table->integer('psc_status')->default(1);
            $table->timestamps();

            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
        });
    }
};
