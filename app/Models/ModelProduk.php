<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModelProduk extends Model
{
    use HasFactory;

    protected $table = 'model_produk';
    protected $guarded = ['id'];
}
