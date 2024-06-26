<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Traits\OptionalPagination;

class Product extends Model
{
    use HasFactory;
    use OptionalPagination;

    protected $guarded = ['id'];

    public static function boot()
    {
        parent::boot();

        self::created(function($model){
            $model->product_code = $model->generateProductCode();
            $model->save();
        });
    }

    public function images():HasMany
    {
        return $this->hasMany(ProductImage::class);
    }

    public function brand():BelongsTo
    {
        return $this->belongsTo(Brand::class);
    }

    public function category():BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function generateProductCode():string
    {
        $randomNumber = random_int(1000, 9999);
        if(self::where('product_code','LK-'.$randomNumber)->count() > 0){
            self::generateProductCode();
        }
        return 'LK-'.$randomNumber;
    }

    public function scopeActive($query)
    {
        return $query->where('is_active',true);
    }

}
