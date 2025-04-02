<?php

namespace Eymer\LaravelQuotes\Http\Controllers;

use Illuminate\Routing\Controller;
use Inertia\Inertia;

class QuoteViewController extends Controller
{

    public function index()
    {
        return Inertia::render('Quotes/Index', []);
    }

    public function show(string $id)
    {
        return Inertia::render('Quotes/Show', [
            'id' => $id,
        ]);
    }

    public function random()
    {

        return Inertia::render('Quotes/Random');
    }
}
