<?php

namespace App\Http\Controllers;

use App\Models\Kurikulum;
use App\Models\Dokumenkurikulum;
use App\Models\Tahunpelajaran;
use Illuminate\Http\Request;

class KurikulumController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kurikulums = Kurikulum::orderBy('kurikulum', 'asc');
        if (request('search')) {
            $kurikulums->where('kurikulum', 'like', '%' . request('search') . '%');
        }
        return view('kurikulum', [
            'menu' => 'referensi',
            'smenu' => 'user',
            'kurikulums' => $kurikulums->paginate(10)->withQueryString()
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
            'kurikulum' => 'required'
        ]);
        $cekNama = Kurikulum::where('kurikulum', $validated['kurikulum'])
                                    ->first();
        if($cekNama){            
            return redirect()->back()->with('failed', 'Gagal, Nama Kurikulum telah ada');
        } else {
            Kurikulum::create($validated);
        return redirect()->back()->with('success', 'Kurikulum berhasil disimpan');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Kurikulum $kurikulum)
    {
        $dokumenkurikulums = Dokumenkurikulum::where('kurikulum_id', $kurikulum->id);
        if (request('search')) {
            $dokumenkurikulums->where('juduldokumen', 'like', '%'. request('search').'%' );
        }
        if (request('tapel_id')) {
            $dokumenkurikulums->where('tahunpelajaran_id', request('tapel_id'));
        }

        return view('dokumenkurikulum', [
            'menu' => 'referensi',
            'smenu' => 'user',
            'tapels' => Tahunpelajaran::all(),
            'kurikulum' => $kurikulum,
            'dokumenkurikulums' => $dokumenkurikulums->paginate(10)->withQueryString()
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Kurikulum $kurikulum)
    {
        return view('kurikulumedit', [
            'menu' => 'referensi',
            'smenu' => 'user',
            'kurikulum' => $kurikulum
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Kurikulum $kurikulum)
    {
        $validated = $request->validate([
            'kurikulum' => 'required'
        ]);

        $cekNama = Kurikulum::where('kurikulum', $validated['kurikulum'])
                                    ->first();
        if($cekNama){            
            return redirect(url('/kurikulum'))->with('failed', 'Gagal, Nama Kurikulum telah ada');
        } else {
            Kurikulum::where('id',$kurikulum->id)
                    ->update($validated);
            return redirect(url('/kurikulum'))->with('success', 'Kurikulum berhasil diubah');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kurikulum $kurikulum)
    {
        Kurikulum::destroy($kurikulum->id);
        return redirect()->back()->with('success', 'Kurikulum berhasil dihapus');
    }
}
