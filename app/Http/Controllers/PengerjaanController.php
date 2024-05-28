<?php

namespace App\Http\Controllers;

use App\Models\Pengerjaan;
use Illuminate\Http\Request;

class PengerjaanController extends Controller
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
        if(session('penugasan') == $request->penugasan_id){
                $data = array(
                    'rekaman' => $request->rekaman,
                    'status' => '2'
                );
                Pengerjaan::where('penugasan_id',$request->penugasan_id)->where('user_id',auth()->user()->id)
                    ->update($data);
                session()->forget('penugasan');
                return redirect('/pembelajaranpd/'.$request->pembelajaran_id);
        } else if (session()->has('penugasan')){
            return redirect('/penugasanpd/'.session('penugasan').'/edit');
        } else {
            return redirect()->back()->with('failed', 'Mohon Input token terlebihdahulu');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Pengerjaan $pengerjaan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pengerjaan $pengerjaan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pengerjaan $pengerjaan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pengerjaan $pengerjaan)
    {
        //
    }
}
