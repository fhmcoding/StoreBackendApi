<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Builder;
use App\Traits\OptionalPagination;

class Order extends Model
{
    use HasFactory;
    use OptionalPagination;

    protected $guarded = ['id'];
    protected $appends = ['delivery_fee','sub_total','total'];

    public const PENDING = 'pending';
    public const CONFIRMED = 'confirmed';
    public const DELIVERED = 'delivered';
    public const RETURNED =  'returned';
    public const CANCELLED = 'cancelled';
    public const ON_HOLD  = 'on_hold';
    public const IN_TRANSIT = 'in_transit';


    public static function boot()
    {
        parent::boot();

        self::created(function($model){
            $model->order_ref = $model->generateOrdeReference();
        });
    }

    public function customer():BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    public function user():BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function caissier():BelongsTo
    {
        return $this->belongsTo(User::class,'caissier_id');
    }

    public function products():BelongsToMany
    {
        return $this
            ->belongsToMany(Product::class, 'order_products', 'order_id','product_id')
            ->withPivot(['id','quantity','price','original_price'])
            ->using(OrderProduct::class);
    }

     public function statusHistory():HasMany
    {
        return $this->hasMany(OrderStatusHistory::class);
    }

     public function payments():HasMany
    {
        return $this->hasMany(Payment::class);
    }



    function getSubTotalAttribute()
    {
        return $this->products->sum(function ($product) {
            return $product->pivot->price * $product->pivot->quantity;
        });
    }

    function getTotalAttribute()
    {

        return $this->sub_total;
    }

    // function getStatusAttribute()
    // {
    //     return $this->delivery_status == Order::PENDING ? $this->confiramtion_status : $this->delivery_status;
    // }

    public function getDeliveryFeeAttribute()
    {
        return 25;
    }

    public function scopeCreatedBefore(Builder $query, $date)
    {
        return $query->whereDate('orders.created_at', '<=', \Carbon\Carbon::parse($date));
    }
    public function scopeCreatedAfter(Builder $query, $date)
    {
        return $query->whereDate('orders.created_at', '>=', \Carbon\Carbon::parse($date));
    }

    public static function generateOrdeReference():int
    {
        $randomNumber = random_int(1000, 9999);
        if(self::where('order_ref',$randomNumber)->count() > 0){
            return self::generateOrdeReference();
        }
        return $randomNumber;
    }

}
