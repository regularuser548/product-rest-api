<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCommentRequest;
use App\Http\Requests\UpdateCommentRequest;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Product;
use Illuminate\Http\Response;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class ProductCommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Product $product): LengthAwarePaginator
    {
        Gate::authorize('viewAny', Comment::class);

        return $product->comments()->latest()->paginate();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCommentRequest $request, Product $product)
    {
        return $product->comments()->create(array_merge($request->validated(),
            ['user_id' => $request->user()->id, 'product_id' => $product->id]));
    }

    /**
     * Display the specified resource.
     */
    public function show(Comment $comment): Comment
    {
        Gate::authorize('view', $comment);

        return $comment;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCommentRequest $request, Comment $comment): Comment
    {
        $comment->update($request->validated());
        return $comment;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Comment $comment): Response
    {
        Gate::authorize('delete', $comment);

        $comment->delete();
        return response()->noContent();
    }
}
