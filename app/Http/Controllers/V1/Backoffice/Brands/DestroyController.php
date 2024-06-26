<?php

namespace App\Http\Controllers\V1\Backoffice\Brands;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use App\Http\Resources\Backoffice\BrandResource;
use App\Models\Brand;

class DestroyController extends Controller
{

    public function __invoke(Brand $brand)
    {
        return $this->success(
            BrandResource::make(
                tap($brand)->delete()
                           ->deleteAllMedia()
            )
        );
    }
}
