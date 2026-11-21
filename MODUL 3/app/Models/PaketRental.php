<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaketRental extends Model
{
    protected $table = 'daftar_paket_rental';

    public $timestamps = false;

    protected $fillable = ['jenis_paket', 'durasi', 'ketentuan'];
}