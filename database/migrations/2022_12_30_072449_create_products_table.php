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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->string('product_name');
            $table->string('product_url')->nullable();
            $table->string('product_code')->nullable();
            $table->string('product_thumbnail')->nullable();
            $table->integer('product_featured')->nullable();
            $table->integer('product_hotDeal')->nullable();
            $table->integer('product_best_rated')->nullable();
            $table->integer('product_trending')->nullable();
            $table->integer('product_warranty')->nullable();
            $table->integer('product_back_order')->nullable();
            $table->integer('product_regular_price');
            $table->integer('product_discount_price')->nullable();
            $table->integer('product_quantity')->default(1);
            $table->integer('product_purchase_quantity')->nullable();
            $table->integer('min_quantity')->default(1);
            $table->integer('product_stock_status')->default(1);
            $table->string('delivery_location')->default('bangladesh');
            $table->integer('return_count')->default(0);
            $table->integer('product_active')->default(1);
            $table->mediumText('product_short_details');
            $table->longText('product_details');
            $table->string('product_slug')->nullable();
            $table->string('product_video_link')->nullable();
            $table->string('product_meta_title')->nullable();
            $table->string('product_meta_keyword')->nullable();
            $table->mediumText('product_meta_details')->nullable();
            $table->integer('product_order_by')->default(0);
            $table->integer('product_status')->default(1);
            $table->timestamps();
        });



        Schema::create('product_colors', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained('products');
            $table->foreignId('color_id')->constrained('colors');

            $table->unique(['product_id', 'color_id']);
            $table->timestamps();
        });

        Schema::create('product_size', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained('products');
            $table->foreignId('size_id')->constrained('sizes');

            $table->unique(['product_id', 'size_id']);
            $table->timestamps();
        });

        Schema::create('product_category', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained('products');
            $table->foreignId('category_id')->constrained('categories');

            $table->unique(['product_id', 'category_id']);
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
        Schema::dropIfExists('products');
        Schema::dropIfExists('product_colors');
        Schema::dropIfExists('product_size');
        Schema::dropIfExists('product_category');
    }
};
