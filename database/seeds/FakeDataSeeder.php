<?php

use App\Comment;
use App\BlogPost;

class FakeDataSeeder extends BaseSeeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (mb_strtolower(config('app.env')) === 'production') {
            return;
        }
        $step = 10;

        // Jesus.. this is so miserably slow
        // 6 minutes for 10,000 blog posts and 12 hours for 1,000,000 comments
        // it seems the slowdown is writing to disk, so there's nothing to do about it

        $blogPosts = 50000;

        $bar = $this->createProgressBar('Creating blog posts', $blogPosts);
        for ($i = BlogPost::count(); $i < $blogPosts; $i += $step) {
            factory(BlogPost::class, $step)->create();
            $bar->setProgress($i);
        }

        $this->command->getOutput()->newLine();

        $comments = 10000;
        $bar      = $this->createProgressBar('Creating comments', $comments);
        for ($i = Comment::count(); $i < $comments; $i += $step) {
            factory(Comment::class, $step)->create();
            $bar->setProgress($i);
        }
    }
}
