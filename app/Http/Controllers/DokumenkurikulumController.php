<?php

namespace App\Http\Controllers;

use App\Models\Dokumenkurikulum;
use App\Models\Administrasi;
use App\Models\Pembelajaran;
use App\Models\Tahunpelajaran;
use App\Models\User;
use Illuminate\Http\Request;

class DokumenkurikulumController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::where('role_id', '2')->orderBy('name', 'asc');
        $tapelaktif = Tahunpelajaran::where('is_active', '1')->first();
        $tapel_id = $tapelaktif->id;
        if (request('tapel_id')) {
            $users->where('tahunpelajaran_id', request('tapel_id'));
            $tapel_id = request('tapel_id');
        }
        if (request('search')) {
            $users->where('name', 'like', '%' . request('search') . '%')
                ->orWhere('username', 'like', '%' . request('search') . '%');
        }

        return view('rekapadministrasiguru', [
            'menu' => 'administrasi',
            'smenu' => '',
            'tapel_id' => $tapel_id,
            'users' => $users->paginate(10)->withQueryString(),
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
        'tahunpelajaran_id' => 'required',
        'kurikulum_id' => 'required',
        'juduldokumen' => 'required',
        'jenisdokumen' => 'required',
        'ukurandokumen' => 'required'
        ]);
        $existingDokumen = Dokumenkurikulum::where('tahunpelajaran_id', $validated['tahunpelajaran_id'])
                                        ->where('juduldokumen', $validated['juduldokumen'])
                                        ->where('kurikulum_id', $validated['kurikulum_id'])->first();
        if ($existingDokumen) {
            return redirect()->back()->with('failed', 'Gagal, Judul Berkas telah ada');
        } else {
            Dokumenkurikulum::create($validated);
            return redirect()->back()->with('success', 'Berhasil menambahkan dokumen administrasi');//
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Dokumenkurikulum $dokumenkurikulum, Request $request)
    {
        $pembelajaran = Pembelajaran::where('id', $request->pembelajaran_id)->first();
        $administrasis = Administrasi::where('dokumenkurikulum_id', $dokumenkurikulum->id)
                            ->where('pembelajaran_id', $request->pembelajaran_id);
        return view('administrasigurudetail', [
        'menu' => 'administrasi',
        'tab' => 'administrasi',
        'administrasis' => $administrasis->paginate(10)->withQueryString(),
        'pembelajaran' => $pembelajaran,
        'dokumenkurikulum' => $dokumenkurikulum
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Dokumenkurikulum $dokumenkurikulum)
    {
        return view('dokumenkurikulumedit', [
            'menu' => 'referensi',
            'smenu' => 'user',
            'tapels' => Tahunpelajaran::all(),
            'dokumenkurikulum' => $dokumenkurikulum
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Dokumenkurikulum $dokumenkurikulum)
    {
        $validated = $request->validate([
            'tahunpelajaran_id' => 'required',
            'juduldokumen' => 'required',
            'jenisdokumen' => 'required',
            'ukurandokumen' => 'required'
            ]);
            $existingDokumen = Dokumenkurikulum::where('tahunpelajaran_id', $validated['tahunpelajaran_id'])
                                            ->where('juduldokumen', $validated['juduldokumen'])
                                            ->where('id', '!=', $dokumenkurikulum->id)
                                            ->where('kurikulum_id', $dokumenkurikulum->kurikulum_id)->first();
            if ($existingDokumen) {
                return redirect(url('kurikulum/'.$request->kurikulum_id))->with('failed', 'Gagal, Judul Berkas telah ada');
            } else {
                Dokumenkurikulum::where('id', $dokumenkurikulum->id)
                ->update($validated);
                return redirect(url('kurikulum/'.$request->kurikulum_id))->with('success', 'Berhasil mengubah dokumen administrasi');//
            }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Dokumenkurikulum $dokumenkurikulum)
    {
        Dokumenkurikulum::destroy($dokumenkurikulum->id);
        return redirect()->back()->with('success', 'Dokumen kurikulum berhasil dihapus');
    }
}
