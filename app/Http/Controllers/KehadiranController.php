<?php

namespace App\Http\Controllers;

use App\Models\Kehadiran;
use App\Models\Kehadirandetail;
use App\Models\Anggotarombel;
use App\Models\Pembelajaran;
use Illuminate\Http\Request;

class KehadiranController extends Controller
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
    public function store(Request $request)
    {
        $validated = $request->validate([
            'pembelajaran_id' => 'required',
            'tanggal' => 'required',
            'keterangan' => 'required'
        ]);
        $berhasil=0;
        $validated['user_id'] = auth()->user()->id;
        $pembelajaran = Pembelajaran::where('id', $request->pembelajaran_id)->first();        
        Kehadiran::create($validated);
            $kehadiran_id = Kehadiran::where('pembelajaran_id', $request->pembelajaran_id)->where('tanggal',$request->tanggal)->orderBy('id', 'desc')->first()->id;
            if($kehadiran_id != NULL){
                $anggotarombels = Anggotarombel::where('rombonganbelajar_id', $pembelajaran->rombonganbelajar_id)->get();
                $data['kehadiran_id'] = $kehadiran_id;
                foreach($anggotarombels as $ar){
                    $data['kehadiran'] = $request->{'kehadiran'.$ar->id};
                    $data['user_id'] = $ar->user_id;
                    Kehadirandetail::create($data);
                    $berhasil++;
                }
            }
        
            return redirect()->back()->with('success', 'Berhasil menambahkan '.$berhasil.' Kehadiran Peserta didik');
    }

    /**
     * Display the specified resource.
     */
    public function show(Kehadiran $kehadiran)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Kehadiran $kehadiran)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Kehadiran $kehadiran)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kehadiran $kehadiran)
    {
        //
    }
}
