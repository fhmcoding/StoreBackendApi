<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\OptionalPagination;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Offer extends Model
{
    use HasFactory;
    use OptionalPagination;


    protected $guarded = ['id'];



    public function products():BelongsToMany
    {
        return $this
            ->belongsToMany(Product::class, 'offer_products', 'offer_id','product_id')
            ->withPivot(['price'])
            ->using(OfferProduct::class);
    }


    public function productOffers() : HasMany
    {
        return $this->hasMany(OfferProduct::class);

    }


    public function user():BelongsTo
    {
         return $this->belongsTo(User::class);
    }
}
