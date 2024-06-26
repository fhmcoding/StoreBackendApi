<?php

namespace App\Http\Controllers\V1\Backoffice\Categories;

use App\Http\Controllers\Controller;

use App\Http\Resources\Backoffice\CategoryResource;
use App\Http\Requests\Backoffice\CategoryRequest;
use Illuminate\Http\JsonResponse;
use App\Models\Category;
use Storage;

class StoreController extends Controller
{

    public function __invoke(CategoryRequest $request):JsonResponse
    {
        if($request->has('file')){
            Storage::disk('public')->move('tmp/'.$request->file, 'categories/'.$request->file);
        }

        return $this->success(
            CategoryResource::make(
                Category::query()->create([
                    'name' => $request->input('name'),
                    'image_url' => $request->has('file') ? '/categories/'.$request->input('file') : null,
                ])
            )
        );
    }
}
