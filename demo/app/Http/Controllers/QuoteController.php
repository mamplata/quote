<?php

namespace App\Http\Controllers;

use App\Models\Quote;
use Illuminate\Http\Request;

class QuoteController extends Controller
{
    public function index()
    {
        return view('index');
    }

    public function search(Request $request)
    {
        $request->validate(['keywords' => 'required']);
        $quotes = Quote::where('quote', 'like', '%' . $request->keywords . '%')->get();
        return view('search_results', compact('quotes'));
    }
}
