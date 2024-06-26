<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\DeleteMedia;

class ProductImage extends Model
{
    use HasFactory;
    use DeleteMedia;

    protected $guarded = ['id'];
    protected $media = ['image_url'];

    public static function boot()
    {
        parent::boot();

        self::deleting(function($model){
           $model->deleteAllMedia();
        });
    }

}
