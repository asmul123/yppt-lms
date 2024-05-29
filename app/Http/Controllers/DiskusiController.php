<?php

namespace App\Http\Controllers;


use App\Models\Diskusi;
use App\Models\Tanggapan;
use Illuminate\Http\Request;

class DiskusiController extends Controller
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
            'diskusi' => 'required'
            ]);
        if($request->pembelajaran_id){
            $validated['user_id'] = auth()->user()->id;
            $validated['pembelajaran_id'] = $request->pembelajaran_id;
            Diskusi::create($validated);
            return redirect()->back()->with('success', 'Berhasil manambahkan topik diskusi');
        } else if($request->diskusi_id){
            // echo $request->diskusi_id;
            Diskusi::where('id',$request->diskusi_id)->update($validated);
            return redirect()->back()->with('success', 'Berhasil mangubah topik diskusi');
        }   
    }

    /**
     * Display the specified resource.
     */
    public function show(Diskusi $diskusi)
    {
         //return response
         return response()->json([
            'success' => true,
            'message' => 'Detail Data Post',
            'data'    => $diskusi  
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
    public function destroy(Diskusi $diskusi)
    {
        $cekuser = Diskusi::where('id', $diskusi->id)->first()->user_id;
        if($cekuser == auth()->user()->id){
            Diskusi::destroy($diskusi->id);
            Tanggapan::where('diskusi_id',$diskusi->id)->delete();
            return redirect()->back()->with('success', 'Topik berhasil dihapus');
        } else{
            return redirect()->back()->with('failed', 'Anda tidak dapat menghapus Topik ini');
        }
    }
}
