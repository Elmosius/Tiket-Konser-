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

  // Relasi ke Event
  public function event()
  {
      return $this->belongsTo(Event::class, 'id_event');
  }

  public function detailPembelians()
    {
        return $this->hasMany(DetailPembelian::class,'id_tiket');
    }
  
    // Dalam model Tiket
  public function pembelians()
  {
      return $this->hasManyThrough(
          Pembelian::class,
          DetailPembelian::class,
          'id_tiket',  // Foreign key pada DetailPembelian
          'id',         // Foreign key pada Pembelian
          'id',         // Local key pada Tiket
          'id_pembelian' // Local key pada DetailPembelian
      );
  }

}
