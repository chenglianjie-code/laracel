<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class StaticPagesController extends Controller
{
    public function home()
    {
        $feed_items = [];
        if (Auth::check()) {
            $feed_items = Auth::user()->feed()->paginate(30);
        }
        return view('home', compact('feed_items'));
    }

    public function help()
    {
        return view('help');
    }

    public function about()
    {
        return view('about');
    }
}
