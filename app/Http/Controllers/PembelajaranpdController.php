<?php

namespace App\Http\Controllers;

use App\Models\Pembelajaran;
use App\Models\Tahunpelajaran;
use App\Models\Anggotarombel;
use App\Models\Penugasan;
use App\Models\Jenispenugasan;
use Illuminate\Http\Request;

class PembelajaranpdController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tapelaktif = Tahunpelajaran::where('is_active', '1')->first();
        $rombel = Anggotarombel::where('tahunpelajaran_id', $tapelaktif->id)->where('user_id', auth()->user()->id)->first();
        $pembelajarans = Pembelajaran::where('rombonganbelajar_id', $rombel->rombonganbelajar_id)->orderBy('matapelajaran', 'asc');
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
        return view('pembelajaranpd', [
            'menu' => 'pembelajaranpd',
            'tapels' => Tahunpelajaran::orderBy('tapel_code','asc')->get(),
            'tapel_id' => $tapel_id,
            'pembelajarans' => $pembelajarans->paginate(12)->withQueryString()
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Pembelajaran $pembelajaranpd)
    {
        if($request->tab==""){    
            $now = date('Y-m-d H:i:s');        
            return view('penugasanpd', [
                'menu' => 'pembelajaran',
                'tab' => 'penugasan',
                'jenispenugasans' => Jenispenugasan::all(),
                'tapels' => Tahunpelajaran::orderBy('tapel_code','asc')->get(),
                'pembelajaran' => $pembelajaranpd,
                'penugasans' => Penugasan::where('pembelajaran_id', $pembelajaranpd->id)->where('waktumulai', '>=', $now)->get()
            ]);
        } else if ($request->tab=="diskusi"){
            return view('diskusi', [
                'menu' => 'pembelajaran',
                'tab' => 'diskusi',
                'tapels' => Tahunpelajaran::orderBy('tapel_code','asc')->get(),
                'pembelajaran' => $pembelajaranpd,
                'penugasans' => Penugasan::where('pembelajaran_id', $pembelajaranpd->id)->get()
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
