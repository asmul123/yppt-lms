<?php

namespace App\Http\Controllers;

use App\Models\Hakakses;
use Illuminate\Http\Request;

class HakaksesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('hakakses', [
            'menu' => 'pengaturan',
            'smenu' => 'tahunpelajaran',
            'hakaksess' => Hakakses::all()
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
    public function show(Hakakses $hakakses)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Hakakses $hakakses)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Hakakses $hakakses)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Hakakses $hakakses)
    {
        //
    }
}
