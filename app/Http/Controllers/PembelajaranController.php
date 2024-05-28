<?php

namespace App\Http\Controllers;

use App\Models\Pembelajaran;
use App\Models\Dokumenkurikulum;
use App\Models\Penugasan;
use App\Models\Banksoal;
use App\Models\Jenispenugasan;
use App\Models\Tahunpelajaran;
use App\Models\Rombonganbelajar;
use App\Models\Anggotarombel;
use Illuminate\Http\Request;

class PembelajaranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tapelaktif = Tahunpelajaran::where('is_active', '1')->first();
        $pembelajarans = Pembelajaran::where('user_id', auth()->user()->id)->orderBy('matapelajaran', 'asc');
        if (request('tapel_id')) {
            $pembelajarans->where('tahunpelajaran_id', request('tapel_id'));
            $tapel_id = request('tapel_id');
        } else {
            $pembelajarans->where('tahunpelajaran_id', $tapelaktif->id);
            $tapel_id = $tapelaktif->id;
        }
        if (request('search')) {
            $pembelajarans->where('matapelajaran', 'like', '%' . request('search') . '%');
        }
        return view('pembelajaran', [
            'menu' => 'pembelajaran',
            'tapels' => Tahunpelajaran::orderBy('tapel_code','asc')->get(),
            'tapel_id' => $tapel_id,
            'rombels' => Rombonganbelajar::where('tahunpelajaran_id', $tapel_id)->get(),
            'pembelajarans' => $pembelajarans->paginate(12)->withQueryString()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'tahunpelajaran_id' => 'required',
            'rombonganbelajar_id' => 'required',
            'matapelajaran' => 'required'
        ]);
        $validated['user_id'] = auth()->user()->id;
        $gagal = 0;
        $berhasil = 0;
        $rombonganbelajars_id = $request->rombonganbelajar_id;
        $count = count($rombonganbelajars_id);
		for ($i = 0; $i < $count; $i++) {
			$rombonganbelajar_id = $rombonganbelajars_id[$i];
            $existingMapel = Pembelajaran::where('tahunpelajaran_id', $validated['tahunpelajaran_id'])
                                            ->where('matapelajaran', $request->matapelajaran)
                                            ->where('rombonganbelajar_id', $rombonganbelajar_id)
                                            ->where('user_id', auth()->user()->id)
                                            ->first();
            $validated['rombonganbelajar_id'] = $rombonganbelajar_id;
            if ($existingMapel) {
                $gagal++;
            } else {
                Pembelajaran::create($validated);
                $berhasil++;
            }
        }
        return redirect()->back()->with('success', 'Berhasil menambahkan '.$berhasil.' Kelas dan '.$gagal.' Kelas gagal ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Pembelajaran $pembelajaran)
    {
        if($request->tab==""){            
            return view('penugasan', [
                'menu' => 'pembelajaran',
                'tab' => 'penugasan',
                'jenispenugasans' => Jenispenugasan::all(),
                'tapels' => Tahunpelajaran::orderBy('tapel_code','asc')->get(),
                'pembelajaran' => $pembelajaran,
                'penugasans' => Penugasan::where('pembelajaran_id', $pembelajaran->id)->orderBy('waktumulai', 'desc')->get()
            ]);
        } else if ($request->tab=="diskusi"){
            return view('diskusi', [
                'menu' => 'pembelajaran',
                'tab' => 'diskusi',
                'tapels' => Tahunpelajaran::orderBy('tapel_code','asc')->get(),
                'pembelajaran' => $pembelajaran,
                'penugasans' => Penugasan::where('pembelajaran_id', $pembelajaran->id)->get()
            ]);
        } else if ($request->tab=="banksoal"){
            return view('banksoal', [
                'menu' => 'pembelajaran',
                'tab' => 'banksoal',
                'mapels' => Pembelajaran::where('user_id', auth()->user()->id)->groupBy('matapelajaran')->get(),
                'banksoals' => Banksoal::where('user_id', auth()->user()->id)->paginate(10)->withQueryString(),
                'pembelajaran' => $pembelajaran
            ]);
        } else if ($request->tab=="administrasi"){
            $dokumenkurikulums = Dokumenkurikulum::where('tahunpelajaran_id', $pembelajaran->tahunpelajaran_id)
                                                    ->where('kurikulum_id', $pembelajaran->rombonganbelajar->kurikulum_id);
            return view('administrasiguru', [
                'menu' => 'administrasi',
                'tab' => 'administrasi',
                'pembelajaran' => $pembelajaran,
                'dokumenkurikulums' => $dokumenkurikulums->paginate(10)->withQueryString()
            ]);
        } else if ($request->tab=="kehadiran"){
            $anggotarombels = Anggotarombel::where('rombonganbelajar_id', $pembelajaran->rombonganbelajar_id);
            $kehadirans = Anggotarombel::where('rombonganbelajar_id', $pembelajaran->rombonganbelajar_id);
            return view('kehadiran', [
                'menu' => 'pembelajaran',
                'tab' => 'kehadiran',
                'pembelajaran' => $pembelajaran,
                'anggotarombels' => $anggotarombels->paginate(10)->withQueryString(),
                'kehadirans' => $kehadirans->get()
                ]);
            }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pembelajaran $pembelajaran)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pembelajaran $pembelajaran)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pembelajaran $pembelajaran)
    {
        //
    }
}
