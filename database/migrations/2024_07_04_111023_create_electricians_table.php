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
        Schema::create('electricians', function (Blueprint $table) {
            $table->id();
            $table->string('first_name', 50)->nullable();
            $table->string('last_name', 50)->nullable();
            $table->string('phone', 20)->unique();
            $table->string('email',)->nullable();
            $table->string('date_of_birth')->nullable();
            $table->string('nid_number')->nullable();
            $table->string('electrician_category')->nullable();
            $table->string('address1')->nullable();
            $table->string('address2')->nullable();
            $table->string('fb_account')->nullable();
            $table->string('nid_image')->nullable();
            $table->string('image')->nullable();
            $table->integer('status')->default(1);
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
        Schema::dropIfExists('electricians');
    }
};
