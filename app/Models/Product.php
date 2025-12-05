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

        // self::created(function($model){
        //     $model->product_code = $model->generateProductCode();
        //     $model->save();
        // });
    }

    public function images()
    {
        return $this->hasManyThrough(
            ProductImage::class,    // Final model we want
            ProductGroup::class,    // Intermediate model
            'id',   // Foreign key on users table
            'id',      // Foreign key on posts table
            'product_group_id',           // Local key on countries
            'image_id'            // Local key on users
        );
    }

    //  public function images():HasMany
    // {
    //     return $this->hasMany(ProductImage::class);
    // }

    public function productGroup():BelongsTo
    {
         return $this->belongsTo(ProductGroup::class);
    }



    public function brand()
    {
        return $this->hasOneThrough(
            Brand::class,
            ProductGroup::class,
            'id',            // Foreign key on ProductGroup table
            'id',            // Foreign key on Brand table
            'product_group_id', // Local key on Product table
            'brand_id'          // Local key on ProductGroup table
        );
    }

    public function category()
{
    return $this->hasOneThrough(
        Category::class,
        ProductGroup::class,
        'id',               // Foreign key on ProductGroup
        'id',               // FK on Category
        'product_group_id', // FK on Product table
        'category_id'       // FK on ProductGroup table
    );
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
