<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estimasi extends Model
{
    use HasFactory;

    protected $table = 'estimasi';
    protected $guarded = ['id'];
    public function modelProduk()
    {
        return $this->belongsTo(ModelProduk::class);
    }
}
