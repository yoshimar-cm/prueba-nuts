<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Product;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = auth()->user()->products()->orderByDesc('created_at')->get();
        return view('products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {
        if ($request->hasFile('video')) {
            $video = $request->file('video')->store('products-videos','public');
        }

        $product = auth()->user()->products()->create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'description' => $request->name,
            'video' => $video
        ]);

        foreach ($request->images as $image) {
            $path = $image->store('products-images','public');
            $product->images()->create([
                'name' => $path
            ]);
        }

        return redirect()->route('products.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        $this->authorize('author', $product);

        return view('products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $this->authorize('author', $product);

        return view('products.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        $this->authorize('author', $product);

        if ($request->hasFile('video')) {
            $video = $request->file('video')->store('products-videos','public');
            $product->video = $video;
        }

        $product->name = $request->name;
        $product->description = $request->description;

        $product->save();

        if ($request->hasFile('images')) {
            foreach ($request->images as $image) {
                $path = $image->store('products-images','public');
                $product->images()->create([
                    'name' => $path
                ]);
            }
        }

        return redirect()->route('products.show', $product);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $this->authorize('author', $product);

        $product->delete();
        return redirect()->route('products.index');
    }
}
