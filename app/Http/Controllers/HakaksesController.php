<?php

namespace App\Http\Controllers;

use App\Models\Hakakses;
use App\Models\Aksesuser;
use App\Models\Tahunpelajaran;
use App\Models\User;
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
            'tapel' => Tahunpelajaran::where('is_active', '1')->first(),
            'tahunpelajarans' => Tahunpelajaran::all(),
            'users' => User::where('role_id', '2')->get(),
            'hakaksess' => Hakakses::all(),
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
    public function show(Hakakses $hakakse)
    {
        $aksesusers = Aksesuser::where('hakakses_id', $hakakse->id);
        if (request('search')) {
            $aksesusers->whereRelation('user','name', 'like', '%'. request('search').'%' );
        }
        if (request('tapel_id')) {
            $aksesusers->where('tahunpelajaran_id', request('tapel_id'));
        }

        return view('aksesuser', [
            'menu' => 'pengaturan',
            'smenu' => 'tahunpelajaran',
            'tapels' => Tahunpelajaran::all(),
            'hakakses' => $hakakse,
            'aksesusers' => $aksesusers->paginate(10)->withQueryString()
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Hakakses $hakakses)
    {
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
