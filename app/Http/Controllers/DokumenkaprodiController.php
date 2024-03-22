<?php

namespace App\Http\Controllers;

use App\Models\Dokumenkaprodi;
use App\Models\Tahunpelajaran;
use App\Models\Aksesuser;
use Illuminate\Http\Request;

class DokumenkaprodiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
            $tapelaktif = Tahunpelajaran::where('is_active', '1')->first();
            if (request('tapel_id')) {
                $dokumenkaprodis = Dokumenkaprodi::where('tahunpelajaran_id', request('tapel_id'));
            } else {
                $dokumenkaprodis = Dokumenkaprodi::where('tahunpelajaran_id', $tapelaktif->id);
            }

            if (request('search')) {
                $dokumenkaprodis->where('juduldokumen', 'like', '%'. request('search').'%' );
            }
    
            return view('dokumenkaprodi', [
                'menu' => 'referensi',
                'smenu' => 'user',
                'tapels' => Tahunpelajaran::all(),
                'dokumenkaprodis' => $dokumenkaprodis->paginate(10)->withQueryString()
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
            'tahunpelajaran_id' => 'required',
            'juduldokumen' => 'required',
            'jenisdokumen' => 'required',
            'ukurandokumen' => 'required'
            ]);
            $existingDokumen = Dokumenkaprodi::where('tahunpelajaran_id', $validated['tahunpelajaran_id'])
                                            ->where('juduldokumen', $validated['juduldokumen'])->first();
            if ($existingDokumen) {
                return redirect()->back()->with('failed', 'Gagal, Judul Berkas telah ada');
            } else {
                Dokumenkaprodi::create($validated);
                return redirect()->back()->with('success', 'Berhasil menambahkan dokumen administrasi');//
            }
    }

    /**
     * Display the specified resource.
     */
    public function show(Dokumenkaprodi $dokumenkaprodi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Dokumenkaprodi $dokumenkaprodi)
    {
        return view('dokumenkaprodiedit', [
            'menu' => 'referensi',
            'smenu' => 'kaprodi',
            'tapels' => Tahunpelajaran::all(),
            'dokumenkaprodi' => $dokumenkaprodi
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Dokumenkaprodi $dokumenkaprodi)
    {
        $validated = $request->validate([
            'tahunpelajaran_id' => 'required',
            'juduldokumen' => 'required',
            'jenisdokumen' => 'required',
            'ukurandokumen' => 'required'
            ]);
            $existingDokumen = Dokumenkaprodi::where('tahunpelajaran_id', $validated['tahunpelajaran_id'])
                                            ->where('juduldokumen', $validated['juduldokumen'])
                                            ->where('id', '!=', $dokumenkaprodi->id)->first();
            if ($existingDokumen) {
                return redirect(url('dokumenkaprodi'))->with('failed', 'Gagal, Judul Berkas telah ada');
            } else {
                Dokumenkaprodi::where('id', $dokumenkaprodi->id)
                ->update($validated);
                return redirect(url('dokumenkaprodi'))->with('success', 'Berhasil mengubah dokumen administrasi');//
            }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Dokumenkaprodi $dokumenkaprodi)
    {
        //
    }
}
