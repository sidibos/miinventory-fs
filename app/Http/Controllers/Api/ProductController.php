<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function index()
    {
        return Product::with(['category', 'unit', 'variants'])->get();
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'sku' => 'required|unique:products',
            'description' => 'nullable',
            'category_id' => 'required|exists:categories,id',
            'unit_id' => 'required|exists:units,id',
            'variants' => 'array'
        ]);

        $product = Product::create($validated);
        if ($request->has('variants')) {
            $product->variants()->createMany($request->variants);
        }

        return response()->json($product->load(['category', 'unit', 'variants']), 201);
    }

    public function show(Product $product)
    {
        return $product->load(['category', 'unit', 'variants']);
    }

    public function update(Request $request, Product $product)
    {
        $product->update($request->only(['name', 'sku', 'description', 'category_id', 'unit_id']));
        $product->variants()->delete();
        $product->variants()->createMany($request->variants ?? []);

        return $product->load(['category', 'unit', 'variants']);
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return response()->noContent();
    }
}
