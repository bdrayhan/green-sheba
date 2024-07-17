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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('invoice_no')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->integer('assign_id')->nullable();
            $table->unsignedBigInteger('courier_id')->nullable();
            $table->string('guest_id')->nullable();
            $table->string('payment_type')->nullable();
            $table->integer('coupon_amount')->nullable();
            $table->integer('paying_amount')->default(0);
            $table->integer('order_subtotal')->nullable();
            $table->integer('product_commission')->nullable();
            $table->integer('shipping_charge')->nullable();
            $table->integer('order_vat')->nullable();
            $table->integer('order_total')->nullable();
            $table->unsignedBigInteger('order_status')->default(1);
            $table->string('order_date')->nullable();
            $table->string('order_month')->nullable();
            $table->string('order_year')->nullable();
            $table->string('complected_date')->nullable();
            $table->string('invoice_date')->nullable();
            $table->string('delivery_date')->nullable();
            $table->string('collected_date')->nullable();
            $table->string('return_date')->nullable();
            $table->string('order_slug')->nullable();
            $table->text('order_notes')->nullable();
            $table->text('return_notes')->nullable();
            $table->text('store_notes')->nullable();
            $table->timestamps();

            $table->foreign('courier_id')->references('id')->on('couriers')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('order_status')->references('id')->on('order_statuses');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
};
