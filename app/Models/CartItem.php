<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    public $timestamps = false;

    public function item(): HasOne
    {
        return $this->hasOne(Item::class,'id','item_id');
    }
}
