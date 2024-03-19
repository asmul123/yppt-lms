<?php

namespace App\Http\Controllers;

use App\Models\Banksoal;
use App\Models\Soal;
use App\Models\Pembelajaran;
use Illuminate\Http\Request;

class BanksoalController extends Controller
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
            'pembelajaran_id' => 'required',
            'kodesoal' => 'required'
            ]);
            $validated['user_id'] = auth()->user()->id;
            $existingKodeSoal = Banksoal::where('kodesoal', $validated['kodesoal'])
                                            ->where('user_id', auth()->user()->id)->first();
            if ($existingKodeSoal) {
                return redirect()->back()->with('failed', 'Gagal, Kode Soal telah ada');
            } else {
                Banksoal::create($validated);
                return redirect()->back()->with('success', 'Berhasil menambahkan bank soal');
            }
    }

    /**
     * Display the specified resource.
     */
    public function show(Banksoal $banksoal)
    {
        return view('soal', [
            'menu' => 'pembelajaran',
            'tab' => 'banksoal',
            'banksoal' => $banksoal,
            'mapels' => Pembelajaran::where('user_id', auth()->user()->id)->groupBy('matapelajaran')->get(),
            'soals' => Soal::where('banksoal_id', $banksoal->id)->paginate(10)->withQueryString(),
            'pembelajaran' => Pembelajaran::where('id', $banksoal->pembelajaran_id)->first()
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Banksoal $banksoal)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Banksoal $banksoal)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Banksoal $banksoal)
    {
        //
    }
}
