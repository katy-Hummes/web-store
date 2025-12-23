<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Product;
use App\Models\Photo;
use App\Http\Requests\RequestProduct;

class SellerController extends Controller
{
    public function create()
    {
        $user = auth()->user();

        if ($user->type == "seller") {
            return Inertia::render('CreateProduct',[
                'user' => $user
            ]);
        } else {
            return redirect()->route('Product');
        }
    }

    public function store(RequestProduct $request)
    {
        // dd($request->all());
        $product = Product::create([
            'user_id' => auth()->user()->id,
            'name' => $request->name,
            'price' => $request->price
        ]);

        if ($request->hasFile('photos')) {
            foreach ($request->file('photos') as $photo) {
                $photoPath = $photo->store('photos', 'public');

                Photo::create([
                    'product_id' => $product->id,
                    'photo_path' => $photoPath
                ]);
            }
        }
    }

    public function show($id)
    {
        
        $user = auth()->user();

        $products = Product::with('photos')->where('user_id', $id)->get();

        if ($user->type == "seller") {
            return Inertia::render('Store', [
                'products' => $products,
                'user' => $user
            ]);
        } else {
            return redirect()->route('Product');
        }
    }

    public function update($id)
    {
        $product = Product::find($id);
        $product->update([
            'name' => request('name'),
            'price' => request('price'),
        ]);
    }

    public function destroy($id)
    {
        $product = Product::find($id);
        $product->delete();
    }
}
