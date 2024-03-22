<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Tahunpelajaran;
use App\Models\Administrasi;
use Illuminate\Http\Request;

class RekapadministrasiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function show(User $rekapadministrasi)
    {
        $tapelaktif = Tahunpelajaran::where('is_active', '1')->first();
        $tapel_id = $tapelaktif->id;
        $administrasis = Administrasi::where('user_id', $rekapadministrasi->id)->where('tahunpelajaran_id', $tapel_id);
        if (request('tapel_id')) {
            $administrasis = Administrasi::where('user_id', $rekapadministrasi->id)->where('tahunpelajaran_id', request('tapel_id'));
            $tapel_id = request('tapel_id');
        }
        
        return view('rekapdokumenguru', [
            'menu' => 'administrasi',
            'smenu' => '',
            'tapel_id' => $tapel_id,
            'administrasis' => $administrasis->paginate(10)->withQueryString(),
            'tapels' => Tahunpelajaran::all()
        ]);
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
