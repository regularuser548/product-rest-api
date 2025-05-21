<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PurchaseHistoryController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $orders = $request->user()->purchases()
            ->with('product')
            ->latest()
            ->paginate();

        return response()->json($orders);
    }
}
