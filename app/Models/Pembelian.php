<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Pembelian extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function pelanggan(): HasOne
    {
        return $this->hasOne(User::class, 'id', 'pelanggan_id');
    }

    static function generate_no_surat($pembelian_id, $jumlah_item)
    {
        // $time = time();
        // $last_four_digit = substr(strval($time),-4);
        // $time_key = $time - (int)$last_four_digit;
        // dump($last_four_digit);
        // dd($time_key);
        // $length = 3;
        // $randomString = substr(str_shuffle("abcdefghijklmnopqrstuvwxyz"),0,$length);
        // dump($randomString);
        // dump(str_shuffle("abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"));
        // dump(substr("abcdefghijklmnopqrstuvwxyz", mt_rand(0, 25), 1).substr(md5(time()), 1));
        // dump(Str::uuid());
        // dump(Str::random(3));
        // dump(time());
        // dd(time()-1678420000);
        $time = time();
        $last_four_digit = substr(strval($time),-4);
        $time_key = $time - (int)$last_four_digit;
        $no_surat = "$pembelian_id" . $last_four_digit[0] . "." . "$jumlah_item" . $last_four_digit[1] . "." . $last_four_digit[2] . $last_four_digit[3];

        return array($no_surat, $time_key);
        // dump($last_four_digit);
        // dd($time_key);
    }

    public function items(): HasMany
    {
        return $this->hasMany(PembelianItem::class, 'pembelian_id', 'id');
    }
}
