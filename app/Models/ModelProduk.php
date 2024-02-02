<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModelProduk extends Model
{
    use HasFactory;

    protected $table = 'model_produk';
    protected $guarded = ['id'];

    public function estimasi()
    {
        return $this->hasMany(Estimasi::class);
    }

    public function proses()
    {
        return $this->hasMany(Proses::class, 'model_id', 'id');
    }
}
