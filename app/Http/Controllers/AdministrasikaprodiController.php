<?php

namespace App\Http\Controllers;

use App\Models\Administrasikaprodi;
use App\Models\Tahunpelajaran;
use App\Models\Aksesuser;
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
            'menu' => 'kaprodi',
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
    public function show(Administrasikaprodi $administrasikaprodi)
    {
        return "Administrasi Kaprodi";
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Administrasikaprodi $administrasikaprodi)
    {
        //
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
