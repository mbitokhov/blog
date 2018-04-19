<?php

use App\Comment;
use App\BlogPost;
use Faker\Generator as Faker;

class FakeDataSeeder extends BaseSeeder
{

    protected $faker;

    public function __construct(Faker $faker)
    {
        $this->faker = $faker;
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (strtolower(env('APP_ENV')) === 'production') {
            return;
        }
        $step = 5;

        // Jesus.. this is so miserably slow
        // 6 minutes for 10,000 blog posts and 12 hours for 1,000,000 comments
        // it seems the slowdown is writing to disk, so there's nothing to do about it

        $blogPosts = 10000;
        
        $bar = $this->createProgressBar('Creating blog posts', $blogPosts);
        for($i = 0; $i < $blogPosts; $i += $step) {
            factory(BlogPost::class, $step)->create();
            $bar->setProgress($i);
        }

        $this->command->getOutput()->newLine();

        $comments = 200000;
        $bar = $this->createProgressBar('Creating comments', $comments);
        for($i = 0; $i < $comments; $i += $step) {
            factory(Comment::class, $step)->create();
            $bar->setProgress($i);
        }
    }
}
