<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class ProductFilters
{
    public function __construct(protected Request $request) {}

    public function apply(Builder $query): Builder
    {
        return $query
            ->when($this->request->filled('category_id'), fn($q) =>
            $q->where('category_id', $this->request->input('category_id'))
            )
            ->when($this->request->filled('min_price'), fn($q) =>
            $q->where('price', '>=', $this->request->input('min_price'))
            )
            ->when($this->request->filled('max_price'), fn($q) =>
            $q->where('price', '<=', $this->request->input('max_price'))
            )
            ->when($this->request->filled('search'), fn($q) =>
            $q->where(function ($sub) {
                $search = $this->request->input('search');
                $sub->where('name', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%");
            })
            )
            ->when($this->request->filled('sort'), function ($q) {
                $sort = $this->request->input('sort');
                $direction = 'asc';

                if (str_starts_with($sort, '-')) {
                    $direction = 'desc';
                    $sort = ltrim($sort, '-');
                }

                if (in_array($sort, ['price', 'name', 'created_at'])) {
                    $q->orderBy($sort, $direction);
                }
            }, fn($q) => $q->latest());
    }
}
