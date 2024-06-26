<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Traits\OptionalPagination;

class Customer extends Model
{
    use HasFactory;
    use OptionalPagination;

    protected $guarded = ['id'];


    public function orders():HasMany
    {
        return $this->hasMany(Order::class);
    }

}
