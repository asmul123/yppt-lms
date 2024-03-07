<?php

namespace App\Http\Controllers;

use App\Models\Administrasi;
use Illuminate\Http\Request;

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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Administrasi $administrasi)
    {
        //
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
