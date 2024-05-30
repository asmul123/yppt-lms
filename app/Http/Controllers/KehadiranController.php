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
            'tanggal' => 'required',
            'keterangan' => 'required'
        ]);
        $berhasil=0;
        if($request->pembelajaran_id){
            $validated['user_id'] = auth()->user()->id;
            $validated['pembelajaran_id'] = $request->pembelajaran_id;
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
            return redirect()->back()->with('success', 'Berhasil menambahkan '.$berhasil.' kehadiran peserta didik');
        } else if($request->kehadiran_id){
            // dd($request);
            // echo $request->diskusi_id;
            Kehadiran::where('id',$request->kehadiran_id)->update($validated);
            $pembelajaran_id = Kehadiran::where('id', $request->kehadiran_id)->first()->pembelajaran_id;
            $pembelajaran = Pembelajaran::where('id', $pembelajaran_id)->first();        
                    $anggotarombels = Anggotarombel::where('rombonganbelajar_id', $pembelajaran->rombonganbelajar_id)->get();
                    foreach($anggotarombels as $ar){
                        $data['kehadiran'] = $request->{'kehadiran'.$ar->id};
                        Kehadirandetail::where('kehadiran_id',$request->kehadiran_id)->where('user_id',$ar->user_id)->update($data);
                        $berhasil++;
                    }
            return redirect()->back()->with('success', 'Berhasil mangubah '.$berhasil.' kehadiran peserta didik');
        }        
    }

    /**
     * Display the specified resource.
     */
    public function show(Kehadiran $kehadiran)
    {
        //return response
        $kehadirandetail = Kehadirandetail::where('kehadiran_id', $kehadiran->id)->get();
        return response()->json([
            'success' => true,
            'message' => 'Detail Data Post',
            'data'    => $kehadiran, 
            'detail'    => $kehadirandetail  
        ]);
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
        $cekuser = Kehadiran::where('id', $kehadiran->id)->first()->user_id;
        if($cekuser == auth()->user()->id){
            Kehadiran::destroy($kehadiran->id);
            Kehadirandetail::where('kehadiran_id',$kehadiran->id)->delete();
            return redirect()->back()->with('success', 'Kehadiran berhasil dihapus');
        } else{
            return redirect()->back()->with('failed', 'Anda tidak dapat menghapus Kehadiran ini');
        }
    }
}
