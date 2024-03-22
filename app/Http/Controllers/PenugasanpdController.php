<?php

namespace App\Http\Controllers;

use App\Models\Penugasan;
use App\Models\Pembelajaran;
use App\Models\Pengerjaan;
use App\Models\Tahunpelajaran;
use App\Models\Soal;
use Illuminate\Http\Request;

class PenugasanpdController extends Controller
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
            'penugasan_id' => 'required'
        ]);
        $penugasan = Penugasan::where('id', $request->penugasan_id)->first();        
        if($request->token != $penugasan->token){
            return redirect()->back()->with('failed', 'Token Salah');
        } else {
            if($penugasan->jenispenugasan_id==1){
                if($penugasan->acaksoal == '1'){
                $datasoal = Soal::where('banksoal_id', $penugasan->banksoal_id)
                            ->inRandomOrder()->get();
                } else {
                $datasoal = Soal::where('banksoal_id', $penugasan->banksoal_id)
                                ->inRandomOrder()->get();
                }
                if($datasoal->count() != 0){
                    $rekaman = "";
                    foreach ($datasoal as $ds) {
                        $rekaman = $rekaman . "(_#_)" . $ds->id . "(-)0";
                    }
                }
                $validated['rekaman'] = $rekaman;
            } else {
                $validated['rekaman'] = "";
            }
            $validated['status'] = "1";
            $validated['user_id'] = auth()->user()->id;
            $cekpengerjaan = Pengerjaan::where('penugasan_id', $request->penugasan_id)->where('user_id', auth()->user()->id)->get();
            if($cekpengerjaan->count() == 0){
                Pengerjaan::create($validated);
            }
            return redirect(url('penugasanpd/'.$request->penugasan_id.'/edit'));
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Penugasan $penugasanpd)
    {
        if($penugasanpd->token != NULL){
            return view('inputtoken', [
                'menu' => 'pembelajaran',
                'tab' => 'penugasan',
                'tapels' => Tahunpelajaran::orderBy('tapel_code','asc')->get(),
                'penugasan' => $penugasanpd,
                'pembelajaran' => Pembelajaran::where('id', $penugasanpd->pembelajaran_id)->first()
            ]);
        } else {
            echo "token nonaktif";
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Penugasan $penugasanpd)
    {
        $penugasan = Penugasan::where('id', $penugasanpd->pembelajaran_id)->first();
        return view('pengerjaankuis', [
            'tapels' => Tahunpelajaran::orderBy('tapel_code','asc')->get(),
            'penugasan' => $penugasanpd,
            'pembelajaran' => Pembelajaran::where('id', $penugasanpd->pembelajaran_id)->first()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Penugasan $penugasan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Penugasan $penugasan)
    {
        //
    }
}
