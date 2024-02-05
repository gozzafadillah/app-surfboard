<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proses extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function modelProduk()
    {
        return $this->belongsTo(ModelProduk::class, 'model_id', 'id');
    }
}
