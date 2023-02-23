<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Item extends Model
{
    use HasFactory;
    protected $guarded=['id'];

    static function getSpecs()
    {
        $specs=Spec::all();
        $tipe_barangs = array_values($specs->where('kategori','tipe_barang')->toArray());
        $antings = array_values($specs->where('kategori','tipe_perhiasan')->where('tipe','ANTING')->toArray());
        $giwangs = array_values($specs->where('kategori','tipe_perhiasan')->where('tipe','GIWANG')->toArray());
        $cincins = array_values($specs->where('kategori','tipe_perhiasan')->where('tipe','CINCIN')->toArray());
        $kalungs = array_values($specs->where('kategori','tipe_perhiasan')->where('tipe','KALUNG')->toArray());
        $gelangrantais = array_values($specs->where('kategori','tipe_perhiasan')->where('tipe','GELANG-RANTAI')->toArray());
        $gelangbulats = array_values($specs->where('kategori','tipe_perhiasan')->where('tipe','GELANG-BULAT')->toArray());
        $liontins = array_values($specs->where('kategori','tipe_perhiasan')->where('tipe','LIONTIN')->toArray());
        $rangeusias = array_values($specs->where('kategori','range_usia')->toArray());
        $warnaemass = array_values($specs->where('kategori','warna_emas')->toArray());
        $nampans = array_values($specs->where('kategori','nampan')->toArray());
        $matas = array_values($specs->where('kategori','mata')->toArray());
        $mainans = array_values($specs->where('kategori','mainan')->toArray());
        $caps = array_values($specs->where('kategori','cap')->toArray());
        $kondisis = $specs->where('kategori','kondisi');
        $tipejeniss=array_values($specs->where('kategori','tipe_perhiasan')->groupBy('tipe')->toArray());
        $tipeperhiasans=[];
        $kodetipeperhiasans=[];
        $nomortipeperhiasans=[];
        for ($i=0; $i < count($tipejeniss); $i++) {
            $tipeperhiasans[]=$tipejeniss[$i][0]['tipe'];
            $kodetipeperhiasans[]=$tipejeniss[$i][0]['kode_tipe'];
            $nomortipeperhiasans[]=$tipejeniss[$i][0]['nomor_tipe'];
        }
        $jenisperhiasans=array_values($specs->where('kategori','tipe_perhiasan')->toArray());
        $kadars=$specs->where('kategori','kadar');
        $mereks=$specs->where('kategori','merek');
        // dd($tipeperhiasans);
        // dd($gelangrantais);
        $data = [
            'specs'=>$specs,
            'tipe_barangs'=>$tipe_barangs,
            'antings'=>$antings,
            'giwangs'=>$giwangs,
            'cincins'=>$cincins,
            'kalungs'=>$kalungs,
            'gelangrantais'=>$gelangrantais,
            'gelangbulats'=>$gelangbulats,
            'liontins'=>$liontins,
            'rangeusias'=>$rangeusias,
            'warnaemass'=>$warnaemass,
            'nampans'=>$nampans,
            'matas'=>$matas,
            'mainans'=>$mainans,
            'caps'=>$caps,
            'kondisis'=>$kondisis,
            'tipeperhiasans'=>$tipeperhiasans,
            'kodetipeperhiasans'=>$kodetipeperhiasans,
            'nomortipeperhiasans'=>$nomortipeperhiasans,
            'jenisperhiasans'=>$jenisperhiasans,
            'kadars'=>$kadars,
            'mereks'=>$mereks,
        ];

        return $data;
    }

    public function photos(): HasMany
    {
        return $this->hasMany(ItemPhoto::class);
    }
}
