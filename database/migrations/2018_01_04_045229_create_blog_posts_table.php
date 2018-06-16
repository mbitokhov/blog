<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBlogPostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blog_posts', function (Blueprint $table) {
            $table->increments('id');

            // Used for links
            $table->string('short_url')->unique()->charset('ascii')->collation('ascii_bin');
            // Used to give to editors
            $table->string('long_url')->unique()->charset('ascii')->collation('ascii_bin');

            $table->string('title');
            $table->string('picture_name')->nullable();
            $table->longText('body');

            $table->timestamps();
            $table->timestamp('released_at')->nullable();
            $table->softDeletes();

            $table->index(['title', 'released_at']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('blog_posts');
    }
}
