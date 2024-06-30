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
        Schema::create('brands', function (Blueprint $table) {
            $table->id();
            $table->string('brand_name')->unique();
            $table->string('brand_slug')->nullable();
            $table->string('brand_url')->nullable();
            $table->string('brand_image')->nullable();
            $table->integer('brand_orderby')->nullable();
            $table->string('brand_remarks')->nullable();
            $table->integer('brand_feature')->nullable()->comment('1 For Active 0 For Inactive');
            $table->integer('brand_active')->default(1)->comment('1 For Active 0 For Inactive');
            $table->integer('brand_creator')->nullable();
            $table->integer('brand_editor')->nullable();
            $table->integer('brand_status')->default(1)->comment('1 For Product Active/Restore 0 For Soft Delete');
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
        Schema::dropIfExists('brands');
    }
};
