<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Product;

class ProductController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        return Inertia::render('Dashboard', [
            'user' => $user
        ]);
    }

    public function products()
    {
        $products = Product::with('photos')->get();
        return response()->json($products);
    }

    public function show($id)
    {

        $product = Product::with('photos')->find($id);

        $user = auth()->user();

        if ($user->type == "buyer") {
            return Inertia::render('Product', [
                'product' => $product
            ]);
        } else {
            return redirect()->route('dashboard');
        }
    }
}
