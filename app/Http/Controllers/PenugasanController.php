<?php

namespace App\Http\Controllers;

use App\Models\Anggotarombel;
use App\Models\Penugasan;
use App\Models\Banksoal;
use App\Models\Pembelajaran;
use App\Models\Tahunpelajaran;
use Illuminate\Http\Request;

class PenugasanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $pembelajaran = Pembelajaran::where('id', $request->pembelajaran_id)->first();
            return view('tambahtugas', [
                'menu' => 'pembelajaran',
                'tab' => 'penugasan',
                'rombels' => Pembelajaran::where('user_id', auth()->user()->id)->where('tahunpelajaran_id', $pembelajaran->tahunpelajaran_id)->get(),
                'soals' => Banksoal::where('user_id', auth()->user()->id)->get(),
                'pembelajaran' => Pembelajaran::where('id', $request->pembelajaran_id)->first(),
                'jenispenugasan_id' => $request->jenispenugasan_id,
                'tapels' => Tahunpelajaran::orderBy('tapel_code','asc')->get()
            ]);
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
            'judultugas' => 'required',
            'jenispenugasan_id' => 'required'
        ]);
        $validated['user_id'] = auth()->user()->id;
        $gagal = 0;
        $berhasil = 0;
        $pembelajarans_id = $request->pembelajaran_id;
        $count = count($pembelajarans_id);
		for ($i = 0; $i < $count; $i++) {
			$validated['pembelajaran_id'] = $pembelajarans_id[$i];
			$validated['deskripsitugas'] = $request->deskripsitugas;
			$validated['banksoal_id'] = $request->banksoal_id;
			($request->acaksoal == "" ?
                $acaksoal = '0' : $acaksoal = $request->acaksoal
            );
			$validated['acaksoal'] = $acaksoal;
			($request->acakjawaban == "" ?
                $acakjawaban = '0' : $acakjawaban = $request->acakjawaban
            );
			$validated['acakjawaban'] = $acakjawaban;
			($request->durasi == "" ?
                $durasi = '00:00:00' : $durasi = $request->durasi
            );
            $validated['durasi'] = $durasi;
            
			$validated['waktumulai'] = $request->tanggalmulai." ".$request->waktumulai;
			$validated['waktuselesai'] = $request->tanggalselesai." ".$request->waktuselesai;
            ($request->terlambat == "" ?
                $terlambat = '0' : $terlambat = $request->terlambat
            );
			$validated['terlambat'] = $terlambat;
			if($request->token == 1){
                $validated['token'] = substr(str_shuffle(str_repeat($x = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil(6 / strlen($x)))), 1, 6);
            }
                Penugasan::create($validated);
                $berhasil++;
        }
        return redirect(url('pembelajaran/'.$pembelajarans_id[0]))->with('success', 'Berhasil menambahkan '.$berhasil.' Tugas');
    }

    /**
     * Display the specified resource.
     */
    public function show(Penugasan $penugasan)
    {
        $pembelajaran = Pembelajaran::where('id', $penugasan->pembelajaran_id)->first();
        $anggotarombels = Anggotarombel::where('rombonganbelajar_id', $pembelajaran->rombonganbelajar_id);
        if (request('search')) {
            $anggotarombels->whereRelation('user','name', 'like', '%'. request('search').'%' );
        }
        return view('detailtugas', [
            'menu' => 'pembelajaran',
            'tab' => 'penugasan',
            'penugasan' => $penugasan,
            'pembelajaran' => $pembelajaran,
            'anggotarombels' => $anggotarombels->paginate(10)->withQueryString()
            ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Penugasan $penugasan)
    {
        //
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
