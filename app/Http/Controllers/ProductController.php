<?php

namespace App\Http\Controllers;

use App\Filters\ProductFilters;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Gate;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): LengthAwarePaginator
    {
        Gate::authorize('viewAny', Product::class);

        $filters = new ProductFilters($request);
        $query = $filters->apply(Product::query());

        return $query->paginate($request->integer('per_page', 15));
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product): Product
    {
        Gate::authorize('view', $product);

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
    public function destroy(Product $product): Response
    {
        Gate::authorize('delete', $product);

        $product->delete();
        return response()->noContent();
    }
}
