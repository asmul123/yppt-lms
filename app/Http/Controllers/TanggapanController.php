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
            'tanggapan' => 'required'
            ]);
            
        if($request->diskusi_id){
            $validated['user_id'] = auth()->user()->id;
            $validated['diskusi_id'] = $request->diskusi_id;
            Tanggapan::create($validated);
            return redirect()->back()->with('success', 'Berhasil manambahkan tanggapan');
        } else if($request->tanggapan_id){
            // echo $request->diskusi_id;
            Tanggapan::where('id',$request->tanggapan_id)->update($validated);
            return redirect()->back()->with('success', 'Berhasil mangubah tanggapan');
        }
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
    public function destroy(Tanggapan $tanggapan)
    {
        $cekuser = Tanggapan::where('id', $tanggapan->id)->first()->user_id;
        if($cekuser == auth()->user()->id){
            Tanggapan::destroy($tanggapan->id);
            return redirect()->back()->with('success', 'Tanggapan berhasil dihapus');
        } else{
            return redirect()->back()->with('failed', 'Anda tidak dapat menghapus Tanggapan ini');
        }
    }
}
