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
            $table->string('user_id',50)->nullable();
            $table->string('partner_name',100)->nullable();
            $table->string('phone',30)->nullable();
            $table->string('email',100)->nullable();
            $table->string('date_of_birth',100)->nullable();
            $table->integer('nid',80)->uniqid();
            $table->string('address',100)->nullable();
            $table->string('nid_img',50)->nullable();
            $table->string('partner_img',50)->nullable();
            $table->string('partner_title',100)->nullable();
            $table->string('partner_url',190)->nullable();
            $table->string('partner_logo')->nullable();
            $table->integer('partner_sorting')->nullable();
            $table->integer('partner_creator')->nullable();
            $table->integer('partner_editor')->nullable();
            $table->string('partner_slug',40)->nullable();
            $table->integer('partner_status')->default(0);
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
