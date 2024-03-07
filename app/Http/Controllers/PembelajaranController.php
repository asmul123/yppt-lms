<?php

namespace App\Http\Controllers;

use App\Models\Pembelajaran;
use Illuminate\Http\Request;

class PembelajaranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pembelajarans = Pembelajaran::orderBy('tahunpelajaran_id', 'asc')->orderBy('matapelajaran', 'asc');
        if (request('tapel_id')) {
            $pembelajarans->where('tahunpelajaran_id', request('tapel_id'));
        }
        if (request('search')) {
            $pembelajarans->where('matapelajaran', 'like', '%' . request('search') . '%');
        }
        return view('pembelajaran', [
            'menu' => 'pembelajaran',
            'pembelajarans' => $pembelajarans->paginate(10)->withQueryString()
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
    public function show(Pembelajaran $pembelajaran)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pembelajaran $pembelajaran)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pembelajaran $pembelajaran)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pembelajaran $pembelajaran)
    {
        //
    }
}
