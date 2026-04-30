<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\OptionalPagination;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Auth;
use Illuminate\Database\Eloquent\Builder;

class Expense extends Model
{
    use HasFactory;
    use OptionalPagination;

    protected $guarded = ['id'];

    public static function boot()
    {
        parent::boot();


        if(Auth::check()){
            if(!Auth::guard('user')->user()->hasPermissionTo('expense-all')){
                static::addGlobalScope('user', static function (Builder $builder): void {
                    $builder->where('user_id', Auth::user()->id);
                });
            }
        }
    }
     public function user():BelongsTo
    {
        return $this->belongsTo(User::class);
    }

}
