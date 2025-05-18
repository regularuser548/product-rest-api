<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if (!$request->user()->tokenCan('product:list'))
            abort(401, 'Unauthorized');

        return Product::paginate();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {
        return Product::create($request->validated());
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Product $product): Product
    {
        if (!$request->user()->tokenCan('product:read'))
            abort(401, 'Unauthorized');

        return $product;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, Product $product): Product
    {
        $product->update($request->validated());
        return $product;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product, Request $request): JsonResponse
    {
        if (!$request->user()->tokenCan('product:delete'))
            abort(401, 'Unauthorized');

        $product->delete();
        return response()->json(null, 204);
    }
}
