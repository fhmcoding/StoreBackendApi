<?php

namespace App\Http\Controllers\V1\Backoffice\Categories;

use App\Http\Controllers\Controller;
use App\Http\Resources\Backoffice\CategoryResource;
use App\Http\Requests\Backoffice\CategoryRequest;
use Illuminate\Http\JsonResponse;
use App\Models\Category;
use Storage;

class UpdateController extends Controller
{

    public function __invoke(CategoryRequest $request,Category $category):JsonResponse
    {
        return $this->success(
            CategoryResource::make(
                tap($category, function (Category $category) use($request) {
                    $category->update(['name' => $request->name]);
                    if($request->has('file')){
                        Storage::disk('public')->move('tmp/'.$request->file, 'categories/'.$request->file);
                        $category->deleteAllMedia()->update([
                            'image_url' => '/categories/'.$request->input('file'),
                        ]);
                    }
                })
            )
        );
    }
}
