@extends('layouts.main')

@section('content')


<div class="main-content container-fluid">
    <!-- list group with contextual & horizontal start -->
    <section id="list-group-contextual">
        <div class="row match-height">
            <div class="col-md-12 col-sm-12">
                <div class="card">
                    <div class="card-content">
                        <img class="card-img-top img-fluid" src="{{ url('assets/images/samples/aerial-panoramic-image-of-sansonvale-lake-X6TCENW.jpg') }}"
                            alt="Card image cap" />
                        <div class="card-body">
                            <h4 class="card-title">{{ $pembelajaran->rombonganbelajar->rombongan_belajar }}</h4>
                            <p class="card-text">
                                {{ $pembelajaran->matapelajaran }}
                            </p>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">                           
                            @if (session('success'))
                            <div class="alert alert-light-success color-warning">{{ session('success') }}</div>
                            @endif
                            
                            @if (session('failed'))
                            <div class="alert alert-light-danger color-warning">{{ session('failed') }}</div>
                            @endif

                            <form>
                                <div class="row justify-content-end">
                                        <div class="col-md-4 col-4">
                                            <div class="form-group">
                                                <input type="text" class="form-control"  name="search" placeholder="Cari Tugas" value="{{ request('search') }}">
                                            </div>
                                        </div>
                                </div>
                            </form>
                    </div>
                    <div class="card-content">
                        <div class="card-body">                                                      
                            @include('layouts.tabpd')
                            <div class="card-header">
                                <h1 class="card-title pl-1">Daftar Tugas</h1>
                                @if ($penugasans->count()==0)
                                    <p class="card-text text-ellipsis">
                                        Belum ada tugas saat ini !
                                    </p>
                                @endif
                            </div>
                            @foreach($penugasans as $penugasan)
                            <div class="card border border-light">
                                <div class="card-header">
                                    <span class="collapsed collapse-title">Tanggal Penugasan : {{ $penugasan->waktumulai }}</span>
                                    <br>
                                    <sup>Oleh : {{ $penugasan->user->name }}</sup>
                                </div>
                                <div class="card-body">
                                    <div class="card border border-light">
                                            <div class="card-header">
                                                <h3>{{ $penugasan->judultugas }}</h3>
                                                <sup>Jatuh Tempo pada : {{ $penugasan->waktuselesai }}</sup><br>
                                                @php
                                                $pengerjaan = App\Models\Pengerjaan::where('user_id', auth()->user()->id)->where('penugasan_id', $penugasan->id)->first();
                                                    if($pengerjaan){
                                                        if ($pengerjaan->status == '1'){
                                                            echo "<span class='badge bg-primary'>Status Pengerjaan : Sedang Dikerjakan</span>";
                                                        } else if ($pengerjaan->status == '2'){
                                                            echo "<span class='badge bg-success'>Status Pengerjaan : Selesai</span>";
                                                        } else if ($pengerjaan->status == '3'){
                                                            echo "<span class='badge bg-danger'>Status Pengerjaan : Diblokir</span>";
                                                        }
                                                    } else if($penugasan->waktuselesai < date('Y-m-d H:i:s')){
                                                        echo "<span class='badge bg-danger'>Status Pengerjaan : Tugas Ditutup</span>";
                                                    } else {
                                                        echo "<span class='badge bg-warning'>Status Pengerjaan : Belum Mengerjakan</span>";
                                                    }
                                                @endphp                                                
                                            </div>
                                            <div class="card-body">
                                                <a href="{{ url('/penugasanpd/'.$penugasan->id) }}" class="btn btn-outline-primary">Lihat Tugas</a>
                                            </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-12 col-md-12">
                
            </div>
        </div>
    </section>
@endsection