<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;

class Rekening extends Model
{
    protected $table = 'rekening';
    // protected $primaryKey = 'id';
    // public $incrementing = false;
    protected $fillable = [
        'id',
        'id_user',
        'no_rekening',
        'nama_rekening',
        'nama_bank',
        'kantor',
        'status',
    ];

    public function searchBank($id){
        $jsonPath = public_path('assets\json\bank.json');
        $jsonBank = json_decode(File::get($jsonPath), true);

        $data =array_search($id, array_column($jsonBank, 'code'));

        return $jsonBank[$data]['name'];
    }
}
