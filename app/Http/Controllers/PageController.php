<?php

namespace App\Http\Controllers;

use App\Page;

class PageController extends Controller
{
    public function show($name)
    {
        $page = Page::where('name', $name)->firstOrFail();

        return view('pages.show', compact('page'));
    }
}