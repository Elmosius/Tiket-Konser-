<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Carbon\Carbon;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class EventController extends Controller
{
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
        ])->validate();

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

        return redirect(route('events'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Event $event)
    {
        return view('penjual.events.detail',[
            // isinya
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Event $event)
    {
        // dd($event);
        return view('penjual.events.edit',[
            'events'=>$event
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
        unlink(public_path($event->banner));
        unlink(public_path($event->denah));

        $event->delete();

        return redirect(route('events'));
    }
}