<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use App\Models\Cover;
use App\Models\Product;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function index()
    {
        $covers = Cover::where('is_active', true)
            ->whereDate('start_at', '<=', now())
            ->where(fn($query) => 
                $query->whereDate('end_at', '>=', now())
                    ->orWhereNull('end_at')
                )
            ->with('images')->get();

        $lastProducts = Product::orderBy('created_at', 'desc')
            ->take(12)->with('images')->get();

        return view('welcome', compact('covers', 'lastProducts'));
    }
}
