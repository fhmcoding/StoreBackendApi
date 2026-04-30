<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\OptionalPagination;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Expense extends Model
{
    use HasFactory;
    use OptionalPagination;

    protected $guarded = ['id'];


     public function user():BelongsTo
    {
        return $this->belongsTo(User::class);
    }

}
