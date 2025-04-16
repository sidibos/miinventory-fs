<?php

namespace App\Http\Controllers\Api;

use App\Models\PurchaseOrder;
use App\Models\PurchaseOrderItem;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;

class PurchaseOrderController extends Controller {
    public function index(): Response {
        return response(PurchaseOrder::with(['supplier', 'warehouse', 'items.product'])->get());
    }

    public function store(Request $request): Response {
        $validated = $request->validate([
            'supplier_id' => 'required|exists:suppliers,id',
            'warehouse_id' => 'required|exists:warehouses,id',
            'order_date' => 'required|date',
            'status' => 'required|string',
            'discount' => 'numeric',
            'tax' => 'numeric',
            'notes' => 'nullable|string',
            'items' => 'required|array',
            'items.*.product_id' => 'required|exists:products,id',
            'items.*.quantity' => 'required|integer|min:1',
            'items.*.unit_cost' => 'required|numeric|min:0'
        ]);

        $total = 0;
        foreach ($validated['items'] as &$item) {
            $item['subtotal'] = $item['quantity'] * $item['unit_cost'];
            $total += $item['subtotal'];
        }

        $purchaseOrder = PurchaseOrder::create(array_merge(
            $validated,
            ['total' => $total + $validated['tax'] - $validated['discount']]
        ));

        foreach ($validated['items'] as $item) {
            $purchaseOrder->items()->create($item);
        }

        return response($purchaseOrder->load(['supplier', 'warehouse', 'items.product']), 201);
    }

    public function show(PurchaseOrder $purchaseOrder): Response {
        return response($purchaseOrder->load(['supplier', 'warehouse', 'items.product']));
    }

    public function update(Request $request, PurchaseOrder $purchaseOrder): Response {
        // Same logic as store, with update + item sync logic
        // For brevity, not expanded here
        return response()->json(['message' => 'Update not implemented in this stub'], 501);
    }

    public function destroy(PurchaseOrder $purchaseOrder): Response {
        $purchaseOrder->delete();
        return response()->noContent();
    }
}