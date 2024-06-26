<?php

namespace App\Http\Controllers\V1\Backoffice\Brands;

use App\Http\Controllers\Controller;
use App\Http\Resources\Backoffice\BrandResource;
use App\Http\Requests\Backoffice\BrandRequest;
use Illuminate\Http\JsonResponse;
use App\Models\Brand;
use Storage;

class StoreController extends Controller
{

    public function __invoke(BrandRequest $request):JsonResponse
    {
        if($request->has('file')){
            Storage::disk('public')->move('tmp/'.$request->file, 'brands/'.$request->file);
        }

        return $this->success(
            BrandResource::make(
                Brand::query()->create([
                    'name' => $request->input('name'),
                    'image_url' => $request->has('file') ? '/brands/'.$request->input('file') : null,
                ])
            )
        );
    }
}
