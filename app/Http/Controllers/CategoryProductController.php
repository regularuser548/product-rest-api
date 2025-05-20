<?php

namespace App\Http\Controllers;

use App\Filters\ProductFilters;
use App\Http\Requests\StoreProductRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Gate;

class CategoryProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Category $category, Request $request): LengthAwarePaginator
    {
        Gate::authorize('viewAny', $category);

        $filters = new ProductFilters($request);
        $query = $filters->apply($category->products()->getQuery());

        return $query->paginate($request->integer('per_page', 15));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request, Category $category)
    {
        return $category->products()->create(array_merge($request->validated(),
            ['category_id' => $category->id]));
    }
}
