<?php

namespace App\Http\Controllers;

use App\Models\DetailPembelian;
use App\Models\Event;
use App\Models\Pembelian;
use App\Models\Tiket;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PembayaranController extends Controller
{
    public function index()
    {
        // Fetching Pembelian with nested DetailPembelian and Tiket data
        $data = Pembelian::with(['details.tiket'])->get();
    
        // Returning the data to the view
        return view('pembeli.pembayaran', [
            'pembelians' => $data,
        ]);
    }

    public function create(Pembelian $pembelian){
        $dataDetail = DetailPembelian::where('id_pembelian', $pembelian->id)->get();
        $idTiket = $dataDetail->pluck('id_tiket')->first();
        $dataTiket = Tiket::where('id',$idTiket)->get();
        $idEvent = $dataTiket->pluck('id_event')->first();
        $dataEvent = Event::where('id',$idEvent)->first();

        // $dataDetail = DetailPembelian::where('id_pembelian', $pembelian->id)->first();
        // // dd($dataDetail);
        // $dataTiket = Tiket::where('id',$dataDetail->id_tiket)->first();
        // // dd($dataTiket);
        // $dataEvent = Event::where('id',$dataTiket->id_event)->first();
        // dd($dataDetail, $dataTiket, $dataEvent);
        return view('pembeli.upcoming.beli-tiket', [
            'pembelian' => $pembelian,
            'detailPembelian'=>$dataDetail,
            'tiket'=>$dataTiket,
            'event'=>$dataEvent,
        ]);
    }

    public function update(Request $request, Pembelian $pembelian){
        // dd($request,$pembelian);
        date_default_timezone_set('Asia/Jakarta');
        $validateData = validator($request->all(),[
            'paymentMethod'=>'required|String',
        ])->validate();

        // dd($validateData);

        $pembelian->tipe_pembayaran = $validateData['paymentMethod'];
        $pembelian->kode_pembayaran = date('dmYHis').Str::random(6).rand(0, 999);
        $pembelian->status = 1;
        $pembelian->save();

        return redirect(route('pemesanan-index'));
    }
    
}