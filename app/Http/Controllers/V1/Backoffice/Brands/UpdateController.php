<?php

namespace App\Http\Controllers\V1\Backoffice\Brands;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use App\Http\Resources\Backoffice\BrandResource;
use App\Http\Requests\Backoffice\BrandRequest;
use App\Models\Brand;
use Storage;

class UpdateController extends Controller
{
    public function __invoke(BrandRequest $request,Brand $brand):JsonResponse
    {
        return $this->success(
            BrandResource::make(
                tap($brand, function (Brand $brand) use($request) {
                    $brand->update(['name' => $request->name]);
                    if($request->has('file')){
                        Storage::disk('public')->move('tmp/'.$request->file, 'brands/'.$request->file);
                        $brand->deleteAllMedia()->update([
                            'image_url' => '/brands/'.$request->input('file'),
                        ]);
                    }
                })
            )
        );
    }
}
