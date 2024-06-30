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
        Schema::create('posts', function (Blueprint $table) {
            $table->bigIncrements('post_id');
            $table->integer('bc_id');
            $table->unsignedBigInteger('tag_id')->nullable();
            $table->string('post_title');
            $table->text('post_short_details')->nullable();
            $table->longText('post_details')->nullable();
            $table->string('post_feature_image')->nullable();
            $table->string('post_url')->nullable();
            $table->string('post_slug')->nullable();
            $table->integer('post_active')->default(0);
            $table->integer('post_status')->default(1);
            $table->string('blog_meta_title')->nullable();
            $table->string('blog_meta_details')->nullable();
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
        Schema::dropIfExists('posts');
    }
};
