<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Laravel\Passport\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use App\Traits\OptionalPagination;
use DB;
class User extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens, HasRoles, OptionalPagination;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $guard_name = 'user';
    protected $guard = 'user';


    protected $fillable = [
        'first_name', 'last_name', 'phone_number', 'password', 'is_active','cache','tpe','virement','cheque','credit'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'is_active' => 'boolean',
        'cache'=> 'boolean',
        'tpe' => 'boolean',
        'credit' => 'boolean',
        'virement' => 'boolean',
        'cheque' => 'boolean'
    ];


    public function orders():HasMany
    {
        return $this->hasMany(Order::class);
    }

    public function payments():HasMany
    {
        return $this->hasMany(Payment::class);
    }

    public function getCreditAttribute(): float
    {
         $ordersTotal = DB::table('order_products')
        ->join('orders', 'orders.id', '=', 'order_products.order_id')
        ->where('orders.user_id', $this->id)
        ->selectRaw('COALESCE(SUM(order_products.quantity * order_products.price), 0)')
        ->value(DB::raw('SUM(order_products.quantity * order_products.price)'));

    $paymentsTotal = $this->payments()->sum('amount');

    return $ordersTotal - $paymentsTotal;
    }
}
