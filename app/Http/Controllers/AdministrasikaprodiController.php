<?php

namespace App\Http\Controllers;

use App\Models\Administrasikaprodi;
use App\Models\Dokumenkaprodi;
use App\Models\Tahunpelajaran;
use App\Models\Aksesuser;
use App\Models\User;
use Illuminate\Http\Request;

class AdministrasikaprodiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tapelaktif = Tahunpelajaran::where('is_active', '1')->first();
        $tapel_id = $tapelaktif->id;
        $kaprodis = Aksesuser::where('tahunpelajaran_id', $tapel_id)->where('hakakses_id', '4');
        
        if (request('tapel_id')) {
            $kaprodis->where('tahunpelajaran_id', request('tapel_id'));
            $tapel_id = request('tapel_id');
            $kaprodis = Aksesuser::where('tahunpelajaran_id', $tapel_id)->where('hakakses_id', '4');
        }

        return view('rekapadministrasikaprodi', [
            'menu' => 'administrasikaprodi',
            'smenu' => '',
            'tapel_id' => $tapel_id,
            'kaprodis' => $kaprodis->paginate(10)->withQueryString(),
            'tapels' => Tahunpelajaran::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $tapelaktif = Tahunpelajaran::where('is_active', '1')->first();
        $tapel_id = $tapelaktif->id;
        $dokumenkaprodis = Dokumenkaprodi::where('tahunpelajaran_id', $tapel_id);
            return view('administrasikaprodi', [
                'menu' => 'administrasikaprodi',
                'tab' => '',
                'tapel_id' => $tapel_id,
                'tapels' => Tahunpelajaran::all(),
                'dokumenkaprodis' => $dokumenkaprodis->paginate(10)->withQueryString()
            ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $formatberkas = Dokumenkaprodi::where('id', $request->dokumenkaprodi_id)->first();
        $request->validate([
            'dokumen_file' => 'required|mimes:'.$formatberkas->jenisdokumen.'|max:'.$formatberkas->ukurandokumen, // Max 2MB
        ]);

        if ($request->file('dokumen_file')->isValid()) {
            $nama_dokumen = uniqid() . '_' . time() . '.' . $request->file('dokumen_file')->getClientOriginalExtension();
            $request->file('dokumen_file')->storeAs('dokumen', $nama_dokumen);
            $data = array(
                'tahunpelajaran_id' => $request->tahunpelajaran_id,
                'dokumenkaprodi_id' => $request->dokumenkaprodi_id,
                'file_administrasi' => $nama_dokumen,
                'keterangan' => $request->keterangan,
                'status' => '1',
                'user_id' => auth()->user()->id
            );            
            Administrasikaprodi::create($data);
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
    public function show(User $administrasikaprodi)
    {
        $tapelaktif = Tahunpelajaran::where('is_active', '1')->first();
        $tapel_id = $tapelaktif->id;
        $dokumenkaprodis = Administrasikaprodi::where('user_id', $administrasikaprodi->id)->where('tahunpelajaran_id', $tapel_id);
        if (request('tapel_id')) {
            $dokumenkaprodis = Administrasikaprodi::where('user_id', $administrasikaprodi->id)->where('tahunpelajaran_id', request('tapel_id'));
            $tapel_id = request('tapel_id');
        }
        
        return view('rekapdokumenkaprodi', [
            'menu' => 'administrasikaprodi',
            'smenu' => '',
            'tapel_id' => $tapel_id,
            'dokumenkaprodis' => $dokumenkaprodis->paginate(10)->withQueryString(),
            'tapels' => Tahunpelajaran::all()
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Dokumenkaprodi $administrasikaprodi)
    {
        $tapelaktif = Tahunpelajaran::where('is_active', '1')->first();
        $tapel_id = $tapelaktif->id;
        $dokumenkaprodis = Administrasikaprodi::where('user_id', auth()->user()->id)->where('dokumenkaprodi_id', $administrasikaprodi->id)->where('tahunpelajaran_id', $tapel_id);
        
        return view('administrasikaprodidetail', [
            'menu' => 'administrasikaprodi',
            'smenu' => '',
            'dokumenkaprodi' => $administrasikaprodi,
            'tapelaktif' => $tapelaktif,
            'administrasikaprodis' => $dokumenkaprodis->paginate(10)->withQueryString(),
            'tapels' => Tahunpelajaran::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Administrasikaprodi $administrasikaprodi)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Administrasikaprodi $administrasikaprodi)
    {
        //
    }
}
