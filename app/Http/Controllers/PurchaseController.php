<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PurchaseController extends Controller
{
    public function purchase(Product $product, Request $request): JsonResponse
    {
        $order = $request->user()->purchases()->create([
            'product_id' => $product->id,
            'quantity' => $request->integer('quantity', 1),
            'original_price' => $product->price,
        ]);

        return response()->json(['message' => 'Purchase successful', 'order' => $order]);

    }
}
