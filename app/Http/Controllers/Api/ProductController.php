<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\CreateProductRequest;
use App\Http\Requests\Api\UpdateProductRequest;
use App\Http\Resources\ProductCollection;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductController extends Controller
{

    public function index(): ProductCollection
    {
        $products = Product::all();
        return ProductCollection::make($products);
    }


    public function show(Product $product): ProductResource
    {
        return ProductResource::make($product);
    }


    public function create(CreateProductRequest $request): ProductResource
    {

        if ($request->hasFile('video')) {
            $video = $request->file('video')->store('products-videos','public');
        }

        $product = Product::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'description' => $request->description,
            'video' => $video,
            'user_id' => 1
        ]);

        foreach ($request->images as $image) {
            $path = $image->store('products-images','public');
            $product->images()->create([
                'name' => $path
            ]);
        }

        return ProductResource::make($product);
    }



    public function update(UpdateProductRequest  $request, Product $product):  ProductResource
    {

        dd($request);

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

        return ProductResource::make($product);

    }


    public function delete(Product $product)
    {
        $product->delete();

        return response()->json([
            'status' => true
        ],200);
    }
}
