<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tiket extends Model
{
    protected $table = 'tiket';
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $fillable = [
      'id',
      'id_event',
      'nama_tiket',
      'jumlah_tiket',
      'harga',
      'deskripsi',
      'tanggal_mulai',
      'tanggal_selesai',
    ];

}
