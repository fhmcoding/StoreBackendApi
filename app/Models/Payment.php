<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\OptionalPagination;

class Payment extends Model
{
    use HasFactory;
    use OptionalPagination;

    protected $guarded = ['id'];


    public function user():BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function order():BelongsTo
    {
        return $this->belongsTo(Order::class);
    }
}
