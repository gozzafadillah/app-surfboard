<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produksi extends Model
{
    use HasFactory;

    protected $table = 'produksi';
    protected $guarded = ['id'];

    public function modelProduk()
    {
        return $this->belongsTo(ModelProduk::class, 'model_produk_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function detailProduksi()
    {
        return $this->hasMany(DetailProduksi::class, 'produksi_id', 'id');
    }

    public function estimasi()
    {
        return $this->hasOne(Estimasi::class, 'id', 'estimasi_id');
    }
}
