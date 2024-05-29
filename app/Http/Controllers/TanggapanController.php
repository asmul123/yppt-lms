<?php

namespace App\Http\Controllers;


use App\Models\Tanggapan;
use Illuminate\Http\Request;

class TanggapanController extends Controller
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
        $validated = $request->validate([
            'diskusi_id' => 'required',
            'tanggapan' => 'required'
            ]);
        $validated['user_id'] = auth()->user()->id;
        
        Tanggapan::create($validated);
        return redirect()->back()->with('success', 'Berhasil manambahkan tanggapan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Tanggapan $tanggapan)
    {
        //return response
        return response()->json([
            'success' => true,
            'message' => 'Detail Data Post',
            'data'    => $tanggapan  
        ]); 
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
