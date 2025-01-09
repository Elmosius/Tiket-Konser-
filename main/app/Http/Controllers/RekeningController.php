<?php

namespace App\Http\Controllers;

use App\Models\Rekening;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class RekeningController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $rekenings = Rekening::where('id_user', Auth::id())->get();
        $jsonPath = public_path('assets\json\bank.json');
        $jsonBank = json_decode(File::get($jsonPath), true);
        return view('penjual.rekening.index',[
            'rekenings'=>$rekenings,
            'banks'=>$jsonBank,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $jsonPath = public_path('assets\json\bank.json');
        $jsonBank = json_decode(File::get($jsonPath), true);
        // dd($jsonBank);

        return view('penjual.rekening.create',[
            'banks'=>$jsonBank,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request);
        $validateData = validator($request->all(),[
            'nama_bank'=>'required|string',
            'nama_rekening'=>'required|string',
            'no_rekening'=>'required |regex:/^[0-9]+$/',
            'kantor'=>'required|string',
        ])->validate();

        // dd($validateData);

        $validateData['nama_rekening'] = strtoupper($validateData['nama_rekening']);

        $rekening = new Rekening($validateData);
        $rekening->id_user = Auth::id();
        $rekening->saldo = 0;
        $status = Rekening::where('id_user', Auth::id())->where(['status' => 1])->first();
        if($status){
            $rekening->status = 0;
        }else{
            $rekening->status = 1;
        }
        $rekening->save();

        return redirect(route('rekening'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Rekening $rekening)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Rekening $rekening)
    {
        $jsonPath = public_path('assets\json\bank.json');
        $jsonBank = json_decode(File::get($jsonPath), true);

        return view('penjual.rekening.edit',[
            'rekenings'=>$rekening,
            'banks'=>$jsonBank,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Rekening $rekening)
    {
        $validateData = validator($request->all(),[
            'nama_bank'=>'required|string',
            'nama_rekening'=>'required|string',
            'no_rekening'=>'required |regex:/^[0-9]+$/',
            'kantor'=>'required|string',
        ])->validate();

        // dd($validateData);

        $validateData['nama_rekening'] = strtoupper($validateData['nama_rekening']);

        $rekening->nama_bank = $validateData['nama_bank'];
        $rekening->nama_rekening = $validateData['nama_rekening'];
        $rekening->no_rekening = $validateData['no_rekening'];
        $rekening->kantor = $validateData['kantor'];
        $rekening->save();

        return redirect(route('rekening'));
    }

    public function statusUpdated($id)
    {
        Rekening::where('id_user', Auth::id())->update(['status' => 0]);
        
        $rekening = Rekening::findOrFail($id);

        // Mengubah nilai boolean status
        $rekening->status = !$rekening->status;
        $rekening->save();

        return redirect(route('rekening'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Rekening $rekening)
    {
        $rekening->delete();

        $status = Rekening::where('id_user', Auth::id())->where(['status' => 1])->first();

        // dd($status);
        if(!$status){
            Rekening::where('id_user', Auth::id())->first()->update(['status' => 1]);
        }
        return redirect(route('rekening'));
    }
}