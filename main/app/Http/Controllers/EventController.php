<?php

namespace App\Http\Controllers;

use App\Models\DetailPembelian;
use App\Models\Event;
use App\Models\Tiket;
use Carbon\Carbon;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class EventController extends Controller
{
    protected $ticketController;
    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Event::all();
        return view('penjual.events.index',[
            'events'=> $data,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('penjual.events.create',[
            // isinya
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request);

        $validateData = validator($request->all(),[
            'banner'=>'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'nama_event' =>'required|string',
            'jenis_event' =>'required|integer',
            'tanggal_mulai' =>'required|date|before_or_equal:tanggal_akhir',
            'tanggal_akhir' =>'required|date|after_or_equal:tanggal_mulai',
            'lokasi' =>'required|string',
            'deskripsi' =>'nullable|string',
            'syarat_ketentuan' =>'required|string',
            'nama_kontak' =>'required|string',
            'email_kontak' =>'required|email',
            'tlp_kontak' =>'required|string',
            'denah' =>'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'pembelian_maksimum' =>'nullable|integer|between:1,5',

            'nama_tiket'=>'required',
            'nama_tiket.*' => 'required|string',
            'jumlah_tiket'=>'required',
            'jumlah_tiket.*'=>'required|integer',
            'harga_tiket'=>'required',
            'harga_tiket.*'=>'required|integer',
            'deskripsi_tiket'=>'required',
            'deskripsi_tiket.*'=>'required|string',
            'tanggal_mulai_tiket'=>'required',
            'tanggal_mulai_tiket.*'=>'required|date|before_or_equal:tanggal_akhir',
            'tanggal_selesai_tiket'=>'required',
            'tanggal_selesai_tiket.*'=>'required|date|after_or_equal:tanggal_mulai',
        ])->validate();

        // dd($validateData);

        $id = IdGenerator::generate(['table' => 'event','field'=>'id', 'length' => 10, 'prefix' =>'EVT-']);
        $validateData['tanggal_mulai'] = Carbon::parse($validateData['tanggal_mulai'])->format('Y-m-d H:i:s');
        $validateData['tanggal_akhir'] = Carbon::parse($validateData['tanggal_akhir'])->format('Y-m-d H:i:s');
        $validateData['pembelian_maksimum']= intval($validateData['pembelian_maksimum']);

        $event= new Event($validateData); 
        $event->id = $id;
        $event->id_penjual = Auth::id();
        $event->status = 1;

        if ($request->hasFile('banner')) {
            $file = $request->file('banner');
            $fileName = time().'_'.$id.'_'.$file->getClientOriginalName();
            $fileName = str_replace(' ', '_', $fileName);
            $customRoute = Auth::id().'/banner';
            $filePath = $file->storeAs($customRoute,$fileName, 'public');  
            $bannerURL = Storage::url($filePath);
            $event->banner = $bannerURL;
        }
        
        if ($request->hasFile('denah')) {
            $file = $request->file('denah');
            $fileName = time().'_'.$id.'_'.$file->getClientOriginalName();
            $fileName = str_replace(' ', '_', $fileName);
            $customRoute = Auth::id().'/denah';
            $filePath = $file->storeAs($customRoute,$fileName,'public');  
            $bannerURL = Storage::url($filePath);
            $event->denah = $bannerURL;
        } 

        $event->save();

        $tickets = [];
        foreach ($validateData['nama_tiket'] as $index => $nama) {
            $tickets[] = [
                'id_event'=>$id,
                'nama_tiket' => $nama,
                'jumlah_tiket' => intval($validateData['jumlah_tiket'][$index]),
                'harga' => intval($validateData['harga_tiket'][$index]),
                'deskripsi' => $validateData['deskripsi_tiket'][$index],
                'tanggal_mulai' => Carbon::parse($validateData['tanggal_mulai_tiket'][$index])->format('Y-m-d H:i:s'),
                'tanggal_selesai' => Carbon::parse($validateData['tanggal_selesai_tiket'][$index])->format('Y-m-d H:i:s'),
            ];
        }

        $ticketController = new TiketController();
        $ticketController->store($tickets);

        return redirect(route('events'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Event $event)
    {
        // dd($event->id);
        $detailPembelians = DB::table('detail_pembelian')
        ->join('tiket', 'detail_pembelian.id_tiket', '=', 'tiket.id')
        ->join('event', 'tiket.id_event', '=', 'event.id')
        ->join('pembelian','detail_pembelian.id_pembelian','=','pembelian.id')
        ->where('event.id', '=', $event->id) // ID event milik pengguna
        ->where('event.id_penjual','=',Auth::id())
        ->select('pembelian.*', 'event.id_penjual', 'detail_pembelian.*')
        ->distinct()
        ->orderByDesc('pembelian.updated_at')->get();

        $tikets = Tiket::where('id_event', $event->id)
        ->with(['detailPembelians' => function($query) {
            $query->whereHas('pembelian', function($q) {
                $q->where('status', 1);
            });
        }])
        ->get()->map(function ($tiket) {
            $jumlahTerjual = $tiket->detailPembelians->sum('jumlah');
            return [
                'idTiket' => $tiket->id,
                'namaTiket' => $tiket->nama_tiket,
                'jumlahTerjual' => $jumlahTerjual
            ];
        });

        // dd($tikets);

        // dd($bayarTiket,$belumBayarTiket);
        return view('penjual.events.detail',[
            'event'=>$event,
            'detailPembelians'=>$detailPembelians,
            'tikets'=> $tikets,
            // 'belmus'=>$belumBayarTiket,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Event $event)
    {
        // dd($event);
        $tiket= Tiket::where('id_event',$event->id)->get();
        // dd($tiket);
        return view('penjual.events.edit',[
            'events'=>$event,
            'tickets'=>$tiket,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Event $event)
    {
        // dd($request, $event);
        
        $validateData = validator($request->all(),[
            'banner'=>'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'nama_event' =>'required|string',
            'jenis_event' =>'required|integer',
            'tanggal_mulai' =>'required|date',
            'tanggal_akhir' =>'required|date|after:tanggal_mulai',
            'lokasi' =>'required|string',
            'deskripsi' =>'nullable|string',
            'syarat_ketentuan' =>'required|string',
            'nama_kontak' =>'required|string',
            'email_kontak' =>'required|string',
            'tlp_kontak' =>'required|string',
            'denah' =>'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'pembelian_maksimum' =>'nullable|integer|between:1,5',

            'id'=>'nullable',
            'id.*'=>'nullable|string',
            'nama_tiket'=>'required',
            'nama_tiket.*' => 'required|string',
            'jumlah_tiket'=>'required',
            'jumlah_tiket.*'=>'required|integer',
            'harga_tiket'=>'required',
            'harga_tiket.*'=>'required|integer',
            'deskripsi_tiket'=>'required',
            'deskripsi_tiket.*'=>'required|string',
            'tanggal_mulai_tiket'=>'required',
            'tanggal_mulai_tiket.*'=>'required|date|before_or_equal:tanggal_akhir',
            'tanggal_selesai_tiket'=>'required',
            'tanggal_selesai_tiket.*'=>'required|date|after_or_equal:tanggal_mulai',
        ])->validate();

        $validateData['tanggal_mulai'] = Carbon::parse($validateData['tanggal_mulai'])->format('Y-m-d H:i:s');
        $validateData['tanggal_akhir'] = Carbon::parse($validateData['tanggal_akhir'])->format('Y-m-d H:i:s');
        $validateData['pembelian_maksimum']= intval($validateData['pembelian_maksimum']);

        // $event->$validateData['banner'];
        $event->nama_event = $validateData['nama_event'];
        $event->jenis_event = $validateData['jenis_event'];
        $event->tanggal_mulai = $validateData['tanggal_mulai'];
        $event->tanggal_akhir = $validateData['tanggal_akhir'];
        $event->lokasi = $validateData['lokasi'];
        $event->deskripsi = $validateData['deskripsi'];
        $event->syarat_ketentuan = $validateData['syarat_ketentuan'];
        $event->nama_kontak = $validateData['nama_kontak'];
        $event->email_kontak = $validateData['email_kontak'];
        $event->tlp_kontak = $validateData['tlp_kontak'];
        $event->pembelian_maksimum = $validateData['pembelian_maksimum'];

        if ($request->hasFile('banner')) {
            $image_path = public_path($event->banner);
            unlink($image_path);

            $file = $request->file('banner');
            $fileName = time().'_'.$event->id.'_'.$file->getClientOriginalName();
            $fileName = str_replace(' ', '_', $fileName);
            $customRoute = Auth::id().'/banner';
            $filePath = $file->storeAs($customRoute,$fileName, 'public');  
            $bannerURL = Storage::url($filePath);
            $event->banner = $bannerURL;
        }
        
        if ($request->hasFile('denah')) {
            $image_path = public_path($event->denah);
            unlink($image_path);

            $file = $request->file('denah');
            $fileName = time().'_'.$event->id.'_'.$file->getClientOriginalName();
            $fileName = str_replace(' ', '_', $fileName);
            $customRoute = Auth::id().'/denah';
            $filePath = $file->storeAs($customRoute,$fileName,'public');  
            $bannerURL = Storage::url($filePath);
            $event->denah = $bannerURL;
        } 
        $event->save();

        $tickets = [];
        foreach ($validateData['nama_tiket'] as $index => $nama) {
            $tickets[] = [
                'id' => isset($validateData['id'][$index]) ? $validateData['id'][$index] : null,  // jika tidak ada id, set null
                'id_event'=>$event->id,
                'nama_tiket' => $nama,
                'jumlah_tiket' => intval($validateData['jumlah_tiket'][$index]),
                'harga' => intval($validateData['harga_tiket'][$index]),
                'deskripsi' => $validateData['deskripsi_tiket'][$index],
                'tanggal_mulai' => Carbon::parse($validateData['tanggal_mulai_tiket'][$index])->format('Y-m-d H:i:s'),
                'tanggal_selesai' => Carbon::parse($validateData['tanggal_selesai_tiket'][$index])->format('Y-m-d H:i:s'),
            ];
        }

        // dd($tickets);

        $ticketController = new TiketController();
        $ticketController->update($tickets,$event->id);

        return redirect(route('events'));
    }

    public function statusUpdated($id)
    {
        $event = Event::findOrFail($id);

        // Mengubah nilai boolean status
        $event->status = !$event->status;
        $event->save();

        return redirect(route('events'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Event $event)
    {
        if($event->banner){
            unlink(public_path($event->banner));
        }
        if($event->denah){
            unlink(public_path($event->denah));
        }
    
        $storedTickets= Tiket::where('id_event',$event->id)->get();
        $ticketController = new TiketController();
        foreach ($storedTickets as $ticket) {
            $ticketController->destroy($ticket);
        }
        $event->delete();
        return redirect(route('events'));
    }
}