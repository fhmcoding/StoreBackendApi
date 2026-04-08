<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;

trait OptionalPagination
{
    public function scopeOptionalPagination(Builder $query)
    {
        return request()->has('all') ? $query->get() : $query->paginate(request()->has('per_page') ? request()->per_page : 50);
    }
}
