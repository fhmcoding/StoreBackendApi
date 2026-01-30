<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
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


    public function offers():BelongsToMany
    {
        return $this
            ->belongsToMany(Offer::class, 'offer_products','product_id' ,'offer_id')
            ->withPivot(['price'])
            ->using(OfferProduct::class);


    }


    public function images()
    {

        return $this->hasMany(ProductImage::class);

        // return $this->hasManyThrough(
        //     ProductImage::class,   // Final model
        //     ProductGroup::class,   // Intermediate model
        //     'id',                  // FK on product_groups (product_groups.id)
        //     'product_group_id',    // FK on product_images
        //     'product_group_id',    // Local key on products
        //     'id'                   // Local key on product_groups
        // );
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

          return $this->belongsTo(Brand::class);

        // return $this->hasOneThrough(
        //     Brand::class,
        //     ProductGroup::class,
        //     'id',            // Foreign key on ProductGroup table
        //     'id',            // Foreign key on Brand table
        //     'product_group_id', // Local key on Product table
        //     'brand_id'          // Local key on ProductGroup table
        // );
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
