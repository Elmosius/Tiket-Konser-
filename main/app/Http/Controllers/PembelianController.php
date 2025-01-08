<?php

namespace App\Http\Controllers;

use App\Models\DetailPembelian;
use App\Models\Event;
use App\Models\Pembelian;
use App\Models\Tiket;
use Carbon\Carbon;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PembelianController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $kategori = $request->query('kategori'); // atau $request->input('filter')
        $hari = intval($request->query('hari'));
        // dd($request);
        $data = DB::table('event')
            ->join('tiket', 'event.id', '=', 'tiket.id_event');

        if ($kategori && $kategori !== 'all') {
            if ($kategori == 'bayar') {
                $data = $data->where('tiket.harga', '>', '0');
            } elseif ($kategori == 'gratis') {
                $data = $data->where('tiket.harga', '=', '0');
            }
            
        }

        // dd($data->get());
        if ($hari){
            $data =$data->whereRaw('DAYOFWEEK(event.tanggal_mulai) = ?', [$hari]);
        }

        $data= $data->distinct()->select('event.*')
            ->orderBy('event.tanggal_mulai', 'desc')
            ->where('event.tanggal_mulai', '>=', now())
            ->take(3) 
            ->get();
        // dd($data);
        return view('pembeli.index', [
            'events' => $data,
        ]);
    }

    public function create (Event $event){
        $tiket = Tiket::where('id_event', $event->id)->get();
        return view('pembeli.upcoming.detail', [
            'event' => $event,
            'tikets'=> $tiket,
        ]);
    }

    public function pembayaran(Request $request, Event $event){
        dd($request);
        $data = $request->tickets;

        $ticketIDs = array_keys($data); // Ambil semua ticketID dari array $data

        // Mengambil semua tiket berdasarkan ID yang ada dalam array ticketIDs
        $tikets = Tiket::whereIn('id', $ticketIDs)->get();

        // Menyiapkan array untuk menggabungkan informasi tiket dengan jumlahnya
        $tiketDetails = [];
        foreach ($tikets as $tiket) {
            $tiketID = $tiket->id;
            $tiketDetails[] = [
                'id' => $tiketID,
                'nama' => $tiket->nama_tiket,
                'jumlah' => $data[$tiketID] ?? 0, // Gunakan operator null coalesce untuk menangani kasus jika tidak ada jumlah tiket
                'harga' => $tiket->harga,
                'total' => intval($data[$tiketID] ?? 0)* intval($tiket->harga),
            ];
        }

        return view('pembeli.upcoming.beli-tiket', [
            'event' => $event,
            'tiketDetails' => $tiketDetails
        ]);
    }
    public function store(Request $request){
        $total=0;
        // dd($request);
        $validateData = validator($request->all(),[
            'tickets'=>'required|array',
            'tickets.*'=>'required|integer'
        ])->validate();
        
        // dd($validateData['tickets']);

        date_default_timezone_set('Asia/Jakarta');

        // Gabungkan prefix dengan timestamp
        $prefix = 'TKT' . date('dmYHis');

        $idPembelian=IdGenerator::generate(['table' => 'pembelian','field'=>'id', 'length'=>20,'prefix' =>$prefix,'reset_on_prefix_change' => true]);
        
        foreach($validateData['tickets'] as $id=>$jumlah){
            // dd($id, $jumlah);
            $data = Tiket::where('id',$id)->first();
            // dd($data->harga);
            $total += intval($data->harga)*intval($jumlah);
        }

        $pembelian= new Pembelian();
        $pembelian->id = $idPembelian;
        $pembelian->id_user = Auth::id();
        $pembelian->total = $total;
        $pembelian->status = 0;
        $pembelian->save();
        
        foreach($validateData['tickets'] as $id=>$jumlah){
            // dd($id, $jumlah);
            if($jumlah !== '0'){
                $prefixDetail = 'DTL'.date('dmYHis');
                $idDetail=IdGenerator::generate(['table' => 'detail_pembelian','field'=>'id','length'=>20, 'prefix' =>$prefixDetail,'reset_on_prefix_change' => true]);
                // dd($id);
                $detailPembelian = new DetailPembelian();
                $detailPembelian->id = $idDetail;
                $detailPembelian->id_pembelian = $idPembelian;
                $detailPembelian->id_tiket = $id;
                $detailPembelian->jumlah = intval($jumlah);
                $detailPembelian->save();
            }
        }

        return redirect(route('pembeli-index'));
    }
}
