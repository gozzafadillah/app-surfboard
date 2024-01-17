<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class P_Produksi extends Model
{
    use HasFactory;
    protected $table = 'p_produksi';
    protected $guarded = ['id'];
}
