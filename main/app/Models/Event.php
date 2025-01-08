<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $table = 'event';
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $fillable = [
      'id',
      'id_penjual',
      'nama_event',
      'jenis_event',
      'tanggal_mulai',
      'tanggal_akhir',
      'lokasi',
      'deskripsi',
      'syarat_ketentuan',
      'nama_kontak',
      'email_kontak',
      'tlp_kontak',
      'denah',
      'banner',
      'pembelian_maksimum',
      'status',
    ];
}
