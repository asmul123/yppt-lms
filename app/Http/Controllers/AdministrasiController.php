<?php

namespace App\Http\Controllers;

use App\Models\Administrasi;
use App\Models\Dokumenkurikulum;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

class AdministrasiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $administrasis = Administrasi::orderBy('tahunpelajaran_id', 'asc');
        if (request('tapel_id')) {
            $administrasis->where('tahunpelajaran_id', request('tapel_id'));
        }
        return view('administrasi', [
            'menu' => 'administrasi',
            'administrasis' => $administrasis->paginate(10)->withQueryString()
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
    public function store(Request $request): RedirectResponse
    {
        $formatberkas = Dokumenkurikulum::where('id', $request->dokumenkurikulum_id)->first();
        $request->validate([
            'dokumen_file' => 'required|mimes:'.$formatberkas->jenisdokumen.'|max:'.$formatberkas->ukurandokumen, // Max 2MB
        ]);

        if ($request->file('dokumen_file')->isValid()) {
            $nama_dokumen = uniqid() . '_' . time() . '.' . $request->file('dokumen_file')->getClientOriginalExtension();
            $request->file('dokumen_file')->storeAs('dokumen', $nama_dokumen);
            $data = array(
                'tahunpelajaran_id' => $request->tahunpelajaran_id,
                'dokumenkurikulum_id' => $request->dokumenkurikulum_id,
                'file_administrasi' => $nama_dokumen,
                'pembelajaran_id' => $request->pembelajaran_id,
                'keterangan' => $request->keterangan,
                'status' => '1',
                'user_id' => auth()->user()->id
            );            
            Administrasi::create($data);
            // return "Berhasil";
            return redirect()->back()->with('success', 'Berhasil menambahkan Mengunggah Berkas');
        } else {
            // return "Gagal";
            return redirect()->back()->with('failed', 'Format/Ukuran Berkas tidak sesuai');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Administrasi $administrasi)
    {
        $path = Storage::path('dokumen/'.$administrasi->file_administrasi);

        // Get the file extension
        $extension = pathinfo($path, PATHINFO_EXTENSION);

        return Storage::download('dokumen/'.$administrasi->file_administrasi, $administrasi->keterangan.".".$extension);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Administrasi $administrasi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Administrasi $administrasi)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Administrasi $administrasi)
    {
        //
    }
}
