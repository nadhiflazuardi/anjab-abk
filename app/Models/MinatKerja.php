<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MinatKerja extends Model
{
    use HasFactory;

    protected $table = 'minat_kerja';
    protected $guarded = ['id'];
}
