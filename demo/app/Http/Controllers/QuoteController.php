<?php

namespace App\Http\Controllers;

use App\Http\Requests\SearchQuoteRequest;
use App\Http\Requests\StoreQuoteRequest;
use App\Http\Requests\UpdateQuoteRequest;
use App\Models\Quote;
use Illuminate\Http\Request;

class QuoteController extends Controller
{
    public function index()
    {
        $quotes = Quote::orderBy('created_at', 'desc')->get();

        return view('index', compact('quotes'));
    }

    public function search(SearchQuoteRequest $request)
    {
        $keywords = $request->keywords;
        $quotes = Quote::where('quote', 'like', '%' . $request->keywords . '%')
            ->orWhere('author', 'like', '%' . $request->keywords . '%')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('search_results', compact('quotes'));
    }

    public function store(StoreQuoteRequest $request)
    {
        $quote = new Quote();
        $quote->quote = $request->quote;
        $quote->author = $request->author;
        $quote->save();
        $quotes = Quote::orderBy('created_at', 'desc')->get();

        return view('search_results', compact('quotes'));
    }

    // Update an existing quote
    public function update(UpdateQuoteRequest $request, $id)
    {
        $quote = Quote::findOrFail($id);
        $quote->quote = $request->quote;
        $quote->author = $request->author;
        $quote->save();
        $quotes = Quote::orderBy('created_at', 'desc')->get();

        return view('search_results', compact('quotes'));
    }
}
