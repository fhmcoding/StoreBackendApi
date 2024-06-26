<?php

namespace App\Http\Controllers\V1\Backoffice\Categories;

use App\Http\Controllers\Controller;
use App\Http\Resources\Backoffice\CategoryResource;
use Illuminate\Http\JsonResponse;
use App\Models\Category;

class DestroyController extends Controller
{

    public function __invoke(Category $category)
    {
        return $this->success(
            CategoryResource::make(
                tap($category)->delete()
                           ->deleteAllMedia()
            )
        );
    }
}
