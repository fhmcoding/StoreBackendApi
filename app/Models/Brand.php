<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Traits\OptionalPagination;
use App\Traits\DeleteMedia;

class Brand extends Model
{
    use HasFactory;
    use OptionalPagination;
    use DeleteMedia;

    protected $guarded = ['id'];

    protected $media = ['image_url'];



    public function products():HasMany
    {
        return $this->hasMany(Product::class);
    }

}
