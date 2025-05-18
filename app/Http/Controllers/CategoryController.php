<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\Category;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if (!$request->user()->tokenCan('category:list'))
            abort(403);

        return Category::paginate();

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryRequest $request)
    {
        return Category::create($request->validated());
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category, Request $request): Category
    {
        if (!$request->user()->tokenCan('category:read'))
            abort(403);

        return $category;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryRequest $request, Category $category): Category
    {
        $category->update($request->validated());
        return $category;

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category, Request $request): JsonResponse
    {
        if (!$request->user()->tokenCan('category:delete'))
            abort(403);

        $category->delete();
        return response()->json(null, 204);
    }
}
