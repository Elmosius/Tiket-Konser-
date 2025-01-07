<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pembelian extends Model
{
    protected $table = 'pembelian';
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $fillable = [
      'id',
      'id_user',
      'total',
      'tipe_pembayaran',
      'kode_pembayaran',
      'status',
    ];
}
