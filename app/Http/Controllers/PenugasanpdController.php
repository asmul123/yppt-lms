<?php

namespace App\Http\Controllers;

use App\Models\Penugasan;
use App\Models\Pembelajaran;
use App\Models\Tahunpelajaran;
use Illuminate\Http\Request;

class PenugasanpdController extends Controller
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
    public function show(Penugasan $penugasanpd)
    {
        if($penugasanpd->token != NULL){
            return view('inputtoken', [
                'menu' => 'pembelajaran',
                'tab' => 'penugasan',
                'tapels' => Tahunpelajaran::orderBy('tapel_code','asc')->get(),
                'penugasan' => $penugasanpd,
                'pembelajaran' => Pembelajaran::where('id', $penugasanpd->pembelajaran_id)->first()
            ]);
        } else {
            echo "token nonaktif";
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Penugasan $penugasan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Penugasan $penugasan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Penugasan $penugasan)
    {
        //
    }
}
