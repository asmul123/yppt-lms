<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Tahunpelajaran;
use App\Models\Pembelajaran;
use Illuminate\Http\Request;

class RekappembelajaranController extends Controller
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
    public function show(User $rekappembelajaran)
    {
        $tapelaktif = Tahunpelajaran::where('is_active', '1')->first();
        $tapel_id = $tapelaktif->id;
        $pembelajarans = Pembelajaran::where('user_id', $rekappembelajaran->id)->where('tahunpelajaran_id', $tapel_id);
        if (request('tapel_id')) {
            $pembelajarans = Pembelajaran::where('user_id', $rekappembelajaran->id)->where('tahunpelajaran_id', request('tapel_id'));
            $tapel_id = request('tapel_id');
        }
        if (request('search')) {
            $pembelajarans->where('name', 'like', '%' . request('search') . '%')
                ->orWhere('matapelajaran', 'like', '%' . request('search') . '%');
        }
        
        return view('rekappembelajaranguru', [
            'menu' => 'administrasi',
            'smenu' => '',
            'tapel_id' => $tapel_id,
            'pembelajarans' => $pembelajarans->paginate(10)->withQueryString(),
            'tapels' => Tahunpelajaran::all()
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }
}
