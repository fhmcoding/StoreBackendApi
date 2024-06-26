<?php

namespace App\Http\Controllers\V1\Backoffice\Products;

use App\Http\Controllers\Controller;
use App\Models\ProductImage;
use Illuminate\Http\JsonResponse;
use App\Http\Resources\Backoffice\ProductImageResource;

class DeleteImageController extends Controller
{
    public function __invoke($id):JsonResponse
    {
        return $this->success(
            ProductImageResource::make(
                tap(ProductImage::findOrFail($id))->delete()
                           ->deleteAllMedia()
            )
        );
    }
}
