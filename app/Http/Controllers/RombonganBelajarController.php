<?php

namespace App\Http\Controllers;

use App\Models\Rombonganbelajar;
use App\Models\Tahunpelajaran;
use Illuminate\Http\Request;

class RombonganBelajarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $rombels = Rombonganbelajar::orderBy('tahunpelajaran_id', 'asc')->orderBy('rombongan_belajar', 'asc');
        if (request('tapel_id')) {
            $rombels->where('tahunpelajaran_id', request('tapel_id'));
        }
        if (request('search')) {
            $rombels->where('rombongan_belajar', 'like', '%' . request('search') . '%');
        }


        return view('rombel', [
            'menu' => 'referensi',
            'smenu' => 'user',
            'rombels' => $rombels->paginate(10)->withQueryString(),
            'tapels' => Tahunpelajaran::all()
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
            'rombongan_belajar' => 'required',
            'tahunpelajaran_id' => 'required'
        ]);

        Rombonganbelajar::create($validated);
        return redirect()->back()->with('success', 'Rombongan belajar berhasil disimpan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Rombonganbelajar $rombonganbelajar)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Rombonganbelajar $rombonganbelajar)
    {
        return view('rombeledit', [
            'menu' => 'referensi',
            'smenu' => 'user',
            'rombel' => $rombonganbelajar,
            'tapels' => Tahunpelajaran::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Rombonganbelajar $rombonganbelajar)
    {
        $validated = $request->validate([
            'rombongan_belajar' => 'required',
            'tahunpelajaran_id' => 'required'
        ]);

        Rombonganbelajar::where('id', $rombonganbelajar->id)
            ->update($validated);
        return redirect(url('/rombonganbelajar'))->with('success', 'Rombel berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Rombonganbelajar $rombonganbelajar)
    {
        Rombonganbelajar::destroy($rombonganbelajar->id);
        return redirect()->back()->with('success', 'Rombongan belajar berhasil dihapus');
    }
}
