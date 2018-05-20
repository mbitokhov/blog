<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePageViewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('page_views', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('token_id')->unsigned()->nullable();
            $table->foreign('token_id')->references('id')->on('tokens');

            $table->integer('blog_post_id')->unsigned();
            $table->foreign('blog_post_id')->references('id')->on('blog_posts');

            $table->integer('views')->default(0);
            $table->index('views');
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
        Schema::dropIfExists('page_views');
    }
}
