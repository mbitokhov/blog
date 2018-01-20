<?php

namespace App\Http\Controllers;

use App\BlogPost;
use App\Http\Controllers\Concerns\InteractsWithModel;

class BlogPostController extends Controller
{
    use InteractsWithModel;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }
}
