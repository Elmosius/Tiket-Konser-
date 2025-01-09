<?php

namespace App\Http\Controllers;

use App\Models\Tiket;
use Carbon\Carbon;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Http\Request;

class TiketController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(array $tickets)
    {
        // dd($tickets);
        foreach($tickets as $ticketsData){
           $validateData= validator($ticketsData,[
                'id_event'=>'required|string',
                'nama_tiket' => 'required|string',
                'jumlah_tiket' => 'required|integer|min:1',
                'harga' => 'required|integer|min:0',
                'deskripsi' => 'required|string',
                'tanggal_mulai'=> 'required|date',
                'tanggal_selesai' => 'required|date',
            ])->validate();
            // dd($validateData);

            $id = IdGenerator::generate(['table' => 'tiket','field'=>'id', 'length' => 10, 'prefix' =>'TKT-']); 

            $tiket = new Tiket($validateData);
            $tiket->id = $id;
            $tiket->save();
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(Tiket $tiket)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tiket $tiket)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(array $tickets, $eventID)
    {
        // dd($tickets, $eventID);
        $storedTickets= Tiket::where('id_event',$eventID)->get();
        
        foreach($tickets as $ticketsData){
            $validateData= validator($ticketsData,[
                'id'=>'nullable|string',
                'id_event'=>'required|string',
                'nama_tiket' => 'required|string',
                'jumlah_tiket' => 'required|integer|min:1',
                'harga' => 'required|integer|min:0',
                'deskripsi' => 'required|string',
                'tanggal_mulai'=> 'required|date',
                'tanggal_selesai' => 'required|date',
             ])->validate();
 
             if (!empty($validateData['id'])) {
                $existingTicket = $storedTickets->firstWhere('id', $validateData['id']);
    
                if ($existingTicket) {
                    // Perbarui data tiket yang ada
                    $existingTicket->nama_tiket = $validateData['nama_tiket'];
                    $existingTicket->jumlah_tiket = $validateData['jumlah_tiket'];
                    $existingTicket->harga = $validateData['harga'];
                    $existingTicket->deskripsi = $validateData['deskripsi'];
                    $existingTicket->tanggal_mulai = $validateData['tanggal_mulai'];
                    $existingTicket->tanggal_selesai = $validateData['tanggal_selesai'];
                    $existingTicket->save();
                    continue;
                }
            }
            // Simpan data tiket baru
            $id = IdGenerator::generate(['table' => 'tiket','field'=>'id', 'length' => 10, 'prefix' =>'TKT-']); 

            $tiket = new Tiket($validateData);
            $tiket->id = $id;
            $tiket->save();
        }

        $incomingIDs = collect($tickets)->pluck('id')->filter(); // Ambil semua ID dari $tickets
        foreach ($storedTickets as $storedTicket) {
            if (!$incomingIDs->contains($storedTicket->id)) {
                $storedTicket->delete(); // Hapus tiket yang tidak ada di array $tickets
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tiket $tiket)
    {
        $tiket->delete();
    }
}
