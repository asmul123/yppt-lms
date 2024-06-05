<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Aksesuser;
use App\Models\Tahunpelajaran;
use App\Models\Rombonganbelajar;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        if(auth()->user()->role_id == 2){     
            $tapelaktif = Tahunpelajaran::where('is_active', '1')->first()->id;       
            $aksesuser = Aksesuser::where('user_id',auth()->user()->id)->where('tahunpelajaran_id', $tapelaktif)->first();
            if($aksesuser and $aksesuser->hakakses_id == 1){
                
            } else {
                return redirect(url('/pembelajaran'));
            }
        } else if (auth()->user()->role_id == 3){
            return redirect(url('/pembelajaranpd'));
        }
        $tahunaktif = Tahunpelajaran::where('is_active', '1')->first();
        $jumlahkepsek = Aksesuser::where('tahunpelajaran_id',$tahunaktif->id)->where('hakakses_id','1')->count();
        $jumlahkuri = Aksesuser::where('tahunpelajaran_id',$tahunaktif->id)->where('hakakses_id','2')->count();
        $jumlahwali = Aksesuser::where('tahunpelajaran_id',$tahunaktif->id)->where('hakakses_id','3')->count();
        $jumlahkaprog = Aksesuser::where('tahunpelajaran_id',$tahunaktif->id)->where('hakakses_id','4')->count();
        $jumlahrombel = Rombonganbelajar::where('tahunpelajaran_id',$tahunaktif->id);
        return view('dashboard', [
            'menu' => 'dashboard',
            'jumlahadmin' => User::where('role_id','1')->count(),
            'jumlahguru' => User::where('role_id','2')->count(),
            'jumlahsiswa' => User::where('role_id','3')->count(),
            'jumlahtu' => User::where('role_id','4')->count(),
            'jumlahkepsek' => $jumlahkepsek,
            'jumlahkuri' => $jumlahkuri,
            'jumlahwali' => $jumlahwali,
            'jumlahkaprog' => $jumlahkaprog,
            'jumlahrombel' => $jumlahrombel->count(),
            'smenu' => ''
        ]);
    }
}
