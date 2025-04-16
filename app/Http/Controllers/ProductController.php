<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class ProductController extends Controller {
    public function index() 
    {
        return Inertia::render('Products/Index');
    }

    public function show(Product $product) 
    {
        return Inertia::render('Products/Edit', 
            ['product' => $product]
        );
    }

    public function edit(Product $product) {
        return Inertia::render('Products/Edit', 
            ['product' => $product]
        );
    }
}