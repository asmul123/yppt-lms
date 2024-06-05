<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use App\Models\Administrasi;
use App\Models\Administrasikaprodi;
use App\Models\Aksesuser;
use App\Models\Pembelajaran;
use App\Models\Penugasan;
use App\Models\Pengerjaan;
use App\Models\Anggotarombel;
use App\Models\Rombonganbelajar;
use App\Models\Diskusi;
use App\Models\Kehadiran;
use App\Models\Kehadirandetail;
use App\Models\Tanggapan;
use App\Models\Banksoal;
use App\Models\Soal;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Illuminate\Support\Facades\Hash;

class AllUserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::orderBy('role_id', 'asc')->orderBy('name', 'asc');
        if (request('role_id')) {
            $users->where('role_id', request('role_id'));
        }
        if (request('search')) {
            $users->where('name', 'like', '%' . request('search') . '%')
                ->orWhere('username', 'like', '%' . request('search') . '%');
        }


        return view('user', [
            'menu' => 'referensi',
            'smenu' => 'user',
            'users' => $users->paginate(10)->withQueryString(),
            'roles' => Role::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    public function import(Request $request)
    {
        if ($request->hasFile('excel_file')) {
            $path = $request->file('excel_file')->getRealPath();

            $spreadsheet = IOFactory::load($path);
            $sheet = $spreadsheet->getActiveSheet();
            $berhasil = 0;
            $gagal = 0;
            foreach ($sheet->getRowIterator() as $row) {
                $cellIterator = $row->getCellIterator();
                $cellIterator->setIterateOnlyExistingCells(false); // Loop semua sel

                // Mengambil nilai dari setiap sel dalam baris
                $data = [];
                foreach ($cellIterator as $cell) {
                    $data[] = $cell->getValue();
                }

                // Simpan data ke dalam database menggunakan model
                $dataisi = ([
                    'name' => $data[0],
                    'username' => $data[1],
                    'password' => Hash::make($data[2]),
                    'role_id' => $data[3]
                    // Tambahkan kolom lain sesuai kebutuhan
                ]);
                $existingUser = User::where('username', $dataisi['username'])->first();

                if ($existingUser) {
                    $gagal++;
                } else if ($dataisi['role_id'] != 'role_id') {
                    User::create($dataisi);
                    $berhasil++;
                }
            }
            return redirect()->back()->with('success', $berhasil . ' User berhasil disimpan ' . $gagal . ' User gagal disimpan');
        }

        return redirect()->back()->with('failed', 'Silahkan Unggah Berkas!');
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'username' => 'required', 'unique:username',
            'password' => 'required',
            'role_id' => 'required'
        ]);

        $existingUser = User::where('username', $validated['username'])->first();

        if ($existingUser) {
            return redirect()->back()->with('failed', 'Gagal, Nama pengguna sudah ada');
        }

        if ($validated['password'] !== $request->password_confirmation) {
            return redirect()->back()->with('failed', 'Gagal, Konfirmasi Kata Sandi tidak sesuai');
        } else {
            User::create($validated);
            return redirect()->back()->with('success', 'User berhasil disimpan');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        return view('useredit', [
            'menu' => 'referensi',
            'smenu' => 'user',
            'user' => $user,
            'roles' => Role::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => 'required',
            'role_id' => 'required'
        ]);

        if ($request->username != $user->username) {
            $validated['username'] = $request->username;
            $existingUser = User::where('username', $validated['username'])->first();

            if ($existingUser) {
                return redirect()->back()->with('failed', 'Gagal, Nama pengguna sudah ada');
            }
        }
        if ($request->password !== "") {
            if ($request->password !== $request->password_confirmation) {
                return redirect()->back()->with('failed', 'Gagal, Konfirmasi Kata Sandi tidak sesuai');
            } else {
                $validated['password'] = Hash::make($request->password);
            }
        }
        User::where('id', $user->id)
            ->update($validated);
        return redirect(url('/users'))->with('success', 'User berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        if($user->role_id == 2){            
            Administrasikaprodi::where('user_id',$user->id)->delete();
            Administrasi::where('user_id',$user->id)->delete();
            Aksesuser::where('user_id',$user->id)->delete();
            $banksoals = Banksoal::where('user_id',$user->id)->get();
            foreach($banksoals as $banksoal){
                Soal::where('banksoal_id',$banksoal->id)->delete();
            }
            Banksoal::where('user_id',$user->id)->delete();
            $pembelajarans = Pembelajaran::where('user_id',$user->id)->get();
            foreach($pembelajarans as $pembelajaran){
                $penugasans = Penugasan::where('pembelajaran_id', $pembelajaran->id)->get();
                foreach($penugasans as $penugasan){
                    Pengerjaan::where('penugasan_id', $penugasan->id)->delete();
                }
                Penugasan::where('pembelajaran_id',$pembelajaran->id)->delete();
                $kehadirans = Kehadiran::where('pembelajaran_id', $pembelajaran->id)->get();
                foreach($kehadirans as $kehadiran){
                    Kehadirandetail::where('kehadiran_id', $kehadiran->id)->delete();
                }
                Kehadiran::where('pembelajaran_id',$pembelajaran->id)->delete();
            }
            Pembelajaran::where('user_id', $user->id)->delete();
            $data['user_id'] = NULL;
                Rombonganbelajar::where('user_id',$user->id)->update($data);
        } else if($user->role_id == 3){            
            Pengerjaan::where('user_id', $user->id)->delete();
            Kehadirandetail::where('user_id', $user->id)->delete();
            Anggotarombel::where('user_id', $user->id)->delete();
        }
        $diskusis = Diskusi::where('user_id', $user->id)->get();
        foreach($diskusis as $diskusi){
            Tanggapan::where('diskusi_id',$diskusi->id)->delete();
        }
        Diskusi::where('user_id',$user->id)->delete();
        Tanggapan::where('user_id',$user->id)->delete();
        User::destroy($user->id);
        return redirect()->back()->with('success', 'User berhasil dihapus');
    }
}
