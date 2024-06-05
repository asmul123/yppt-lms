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
                                ->get();
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
                echo $cekpengerjaan->count();
                // Pengerjaan::create($validated);
            }
            // return redirect(url('penugasanpd/'.$request->penugasan_id.'/edit'));
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Penugasan $penugasanpd)
    {
        
        if(session()->has('penugasan')){
            // session()->forget('penugasan');
            return redirect('/penugasanpd/'.session('penugasan').'/edit');
        } else {
            $cekpengerjaan = Pengerjaan::where('penugasan_id', $penugasanpd->id)->where('user_id', auth()->user()->id)->first();
            // dd($cekpengerjaan);
            if($penugasanpd->waktuselesai < date('Y-m-d H:i:s') && $penugasanpd->terlambat == 0 && !$cekpengerjaan){
                return view('statustugas', [
                    'menu' => 'pembelajaran',
                    'tab' => 'penugasan',
                    'status' => 'ditutup',
                    'tapels' => Tahunpelajaran::orderBy('tapel_code','asc')->get(),
                    'penugasan' => $penugasanpd,
                    'pembelajaran' => Pembelajaran::where('id', $penugasanpd->pembelajaran_id)->first()
                ]);
            } 
            else if($cekpengerjaan && $cekpengerjaan->status != "1"){
                if($cekpengerjaan->status == "2"){
                    return view('statustugas', [
                        'menu' => 'pembelajaran',
                        'tab' => 'penugasan',
                        'status' => 'selesai',
                        'tapels' => Tahunpelajaran::orderBy('tapel_code','asc')->get(),
                        'penugasan' => $penugasanpd,
                        'pembelajaran' => Pembelajaran::where('id', $penugasanpd->pembelajaran_id)->first(),
                        'pengerjaan' => Pengerjaan::where('penugasan_id', $penugasanpd->id)->where('user_id', auth()->user()->id)->first()
                    ]);
                } else if($cekpengerjaan->status == "3"){
                    return view('statustugas', [
                        'menu' => 'pembelajaran',
                        'tab' => 'penugasan',
                        'status' => 'blokir',
                        'tapels' => Tahunpelajaran::orderBy('tapel_code','asc')->get(),
                        'penugasan' => $penugasanpd,
                        'pembelajaran' => Pembelajaran::where('id', $penugasanpd->pembelajaran_id)->first(),
                        'pengerjaan' => Pengerjaan::where('penugasan_id', $penugasanpd->id)->where('user_id', auth()->user()->id)->first()
                    ]);
                }
            } else if($penugasanpd->token != NULL){
                return view('inputtoken', [
                    'menu' => 'pembelajaran',
                    'tab' => 'penugasan',
                    'tapels' => Tahunpelajaran::orderBy('tapel_code','asc')->get(),
                    'penugasan' => $penugasanpd,
                    'pembelajaran' => Pembelajaran::where('id', $penugasanpd->pembelajaran_id)->first()
                ]);
            } else {
                $validated['penugasan_id'] = $penugasanpd->id;
                session(['penugasan' => $penugasanpd->id]);
                if($penugasanpd->jenispenugasan_id==1){
                    if($penugasanpd->acaksoal == '1'){
                    $datasoal = Soal::where('banksoal_id', $penugasanpd->banksoal_id)
                                ->inRandomOrder()->get();
                    } else {
                    $datasoal = Soal::where('banksoal_id', $penugasanpd->banksoal_id)
                                    ->get();
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
                if($cekpengerjaan){
                    // echo "sudah ada pengerjaan";
                    return redirect(url('penugasanpd/'.$penugasanpd->id.'/edit'));
                } else {
                    Pengerjaan::create($validated);
                    // echo "belum ada pengerjaan";
                    return redirect(url('penugasanpd/'.$penugasanpd->id.'/edit'));

                }
            }
        }
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Penugasan $penugasanpd)
    {
        $pengerjaan = Pengerjaan::where('penugasan_id', $penugasanpd->id)->where('user_id',auth()->user()->id)->first();
        if($penugasanpd->jenispenugasan_id==1){
            if($request->no == ""){
                $no = 1;
            } else {
                $no = $request->no;
            }
            if ($request->nosoal && $request->opsi && $request->soal){
                $rekaman_lama = $pengerjaan->rekaman;
                $rl = explode("(_#_)", $rekaman_lama);
                $new_ans = array(
                    $request->nosoal => $request->soal . '(-)' . $request->opsi
                );
                $update = array_replace($rl, $new_ans);
                $rek = "";
                for ($i = 1; $i < count($update); $i++) {
                    $rek = $rek . "(_#_)" . $update[$i];
                }
                $data_ans = array(
                    'rekaman' => $rek
                );
                Pengerjaan::where('penugasan_id',$penugasanpd->id)->where('user_id',auth()->user()->id)
                        ->update($data_ans);
                $pengerjaan = Pengerjaan::where('penugasan_id', $penugasanpd->id)->where('user_id',auth()->user()->id)->first();
            }
            if(session('penugasan') == $penugasanpd->id){
                if($request->no == "akhir"){
                    if($request->opsi){
                        $rek = $rek;
                    } else {
                        $rek = $pengerjaan->rekaman;
                    }
                    $betul = 0;
                    $rt = explode("(_#_)", $rek);
                    $jml_soal = count($rt) - 1;
                    for ($i = 1; $i < count($rt); $i++) {
                        $hasil = explode("(-)", $rt[$i]);
                        $kunci = Soal::where('id', $hasil[0])->first()->kunci;
                        if ($kunci == $hasil[1]) {
                            $betul++;
                        }
                    }
                    $nilai = $betul / $jml_soal * 100;
                    $data_akhir = array(
                        'nilai' => $nilai,
                        'status' => '2'
                    );
                    Pengerjaan::where('penugasan_id',$penugasanpd->id)->where('user_id',auth()->user()->id)
                        ->update($data_akhir);
                    session()->forget('penugasan');
                    return redirect('/pembelajaranpd/'.$penugasanpd->pembelajaran_id);
                }
                return view('pengerjaankuis', [
                    'menu' => 'pembelajaran',
                    'tab' => 'penugasan',
                    'tapels' => Tahunpelajaran::orderBy('tapel_code','asc')->get(),
                    'penugasan' => $penugasanpd,
                    'nosoal' => $no,
                    'pengerjaan' => $pengerjaan
                ]);
            } else if (session()->has('penugasan')){
                return redirect('/penugasanpd/'.session('penugasan').'/edit');
            } else {
                return redirect()->back()->with('failed', 'Mohon Input token terlebihdahulu');
            }
        } else {
            if(session('penugasan') == $penugasanpd->id){
                return view('pengerjaantugas', [
                    'menu' => 'pembelajaran',
                    'tab' => 'penugasan',
                    'tapels' => Tahunpelajaran::orderBy('tapel_code','asc')->get(),
                    'penugasan' => $penugasanpd,
                    'pengerjaan' => $pengerjaan
                ]);
            } else if (session()->has('penugasan')){
                return redirect('/penugasanpd/'.session('penugasan').'/edit');
            } else {
                return redirect()->back()->with('failed', 'Mohon Input token terlebihdahulu');
            }
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Penugasan $penugasanpd)
    {
        $cektoken = Penugasan::where('id', $penugasanpd->id)->where('token', $request->token)->count();
        if($cektoken!=0){
            session(['penugasan' => $penugasanpd->id]);
            $validated['penugasan_id'] = $penugasanpd->id;
            if($penugasanpd->jenispenugasan_id==1){
                if($penugasanpd->acaksoal == '1'){
                $datasoal = Soal::where('banksoal_id', $penugasanpd->banksoal_id)
                            ->inRandomOrder()->get();
                } else {
                $datasoal = Soal::where('banksoal_id', $penugasanpd->banksoal_id)
                                ->get();
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
            $cekpengerjaan = Pengerjaan::where('penugasan_id', $penugasanpd->id)->where('user_id', auth()->user()->id)->get();
            if($cekpengerjaan->count() == 0){
                Pengerjaan::create($validated);
            }
            return redirect(url('penugasanpd/'.$penugasanpd->id.'/edit'));
        } else {
            return redirect()->back()->with('failed', 'Token Salah');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Penugasan $penugasan)
    {
        //
    }
}
