<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Pembelian extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function pelanggan(): HasOne
    {
        return $this->hasOne(User::class, 'id', 'pelanggan_id');
    }
}
