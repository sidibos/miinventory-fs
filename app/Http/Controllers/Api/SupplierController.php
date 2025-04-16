<?php

namespace App\Http\Controllers\Api;

use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;

class SupplierController extends Controller {
    public function index(): Response {
        return response(Supplier::with('products')->get());
    }

    public function store(Request $request): Response {
        $supplier = Supplier::create($request->validate([
            'name' => 'required|string',
            'email' => 'nullable|email',
            'phone' => 'nullable|string',
            'address' => 'nullable|string',
            'tax_number' => 'nullable|string'
        ]));

        return response($supplier, 201);
    }

    public function show(Supplier $supplier): Response {
        return response($supplier->load('products'));
    }

    public function update(Request $request, Supplier $supplier): Response {
        $supplier->update($request->validate([
            'name' => 'required|string',
            'email' => 'nullable|email',
            'phone' => 'nullable|string',
            'address' => 'nullable|string',
            'tax_number' => 'nullable|string'
        ]));

        return response($supplier);
    }

    public function destroy(Supplier $supplier): Response {
        $supplier->delete();
        return response()->noContent();
    }
}