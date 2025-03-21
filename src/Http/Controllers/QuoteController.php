<?php

namespace Eymer\LaravelQuotes\Http\Controllers;

use Illuminate\Routing\Controller;
use Eymer\LaravelQuotes\Services\QuoteService;
use Illuminate\Http\Request;

class QuoteController extends Controller
{
    public function __construct(protected QuoteService $quoteService)
    {
    }

    public function index(Request $request)
    {
        $params = $request->input();

        return $this->quoteService->getAllQuotes($params);
    }

    public function show(string $id)
    {

        return $this->quoteService->getQuote($id);
    }

    public function random()
    {

        return $this->quoteService->getRandomQuote();
    }

    public function ui(Request $request)
    {
        return view();
    }
}
