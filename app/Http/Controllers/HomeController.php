<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home()
    {
        return view('home')
            ->with('navigation', 'home')
            ->with('notifications', [['type'=>null, 'info'=>'notification']]);
    }
}
