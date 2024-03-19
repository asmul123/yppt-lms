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
                            @include('layouts.tab')
                            <div class="card-header">
                                <h1 class="card-title pl-1">
                                    Daftar Tugas Peserta Didik                                
                                    <hr>
                                </h1>
                                    Judul Tugas : {{ $penugasan->judultugas }}
                            </div>
                            <div class="card">
                                <div class="card-body">
                                    @if (session('success'))
                                    <div class="alert alert-light-success color-warning">{{ session('success') }}</div>
                                    @endif
                                    
                                    @if (session('failed'))
                                    <div class="alert alert-light-danger color-warning">{{ session('failed') }}</div>
                                    @endif
                                    <div class="table-responsive">
                                        <form>
                                            <div class="row justify-content-end">
                                                    <div class="col-md-9 col-9">
                                                        <div class="btn-group" role="group" aria-label="Basic example">
                                                            <button class="btn btn-sm btn-outline-dark">
                                                                Token : {{ $penugasan->token }}
                                                            </button>
                                                            <a href="{{ url('penugasan/release_token/'.$penugasan->id) }}" class="btn btn-sm btn-warning">
                                                                <i data-feather="refresh-cw"></i>
                                                            </a>
                                                            <a href="{{ url('penugasan/hapus_token/'.$penugasan->id) }}" class="btn btn-sm btn-danger">
                                                                <i data-feather="trash"></i>
                                                            </a> 
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3 col-3">
                                                        <div class="form-group">
                                                            <input type="text" class="form-control"  name="search" placeholder="Cari" value="{{ request('search') }}">
                                                        </div>
                                                    </div>
                                            </div>
                                        </form>
                                      <table class="table table-striped mb-0">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Nama Peserta Didik</th>
                                                <th>Status Pengerjaan</th>
                                                <th>Nilai</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($anggotarombels as $anggotarombel)
                                            <tr>
                                                <td class="align-top">{{ $anggotarombels->firstItem() + $loop->index }}</td>
                                                <td>{{ $anggotarombel->user->name }}</td>
                                                <td>
                                                    @php
                                                    $pengerjaan = App\Models\Pengerjaan::where('user_id', $anggotarombel->user->id)->where('penugasan_id', $penugasan->id)->first();
                                                    if($pengerjaan){
                                                        if ($pengerjaan->status == '1'){
                                                            echo "<span class='badge bg-primary'>Sedang Dikerjakan</span>";
                                                        } else if ($pengerjaan->status == '2'){
                                                            echo "<span class='badge bg-success'>Selesai</span>";
                                                        } else if ($pengerjaan->status == '3'){
                                                            echo "<span class='badge bg-danger'>Diblokir</span>";
                                                            }
                                                        } else {
                                                        echo "<span class='badge bg-warning'>Belum Mengerjakan</span>";
                                                    }
                                                    @endphp
                                                </td>
                                                <td>{{ ($pengerjaan ? $pengerjaan->nilai : false) }}</td>
                                                <td>
                                                    <div class="btn-group mb-3" role="group" aria-label="Basic example">
                                                        <a href="{{ url('/') }}/banksoal/{{ $anggotarombel->id }}/edit" class="badge icon bg-primary"><i data-feather="list"></i></a>
                                                        <form action="{{ url('/') }}/soal/{{ $anggotarombel->id }}" method="post">
                                                            @method('delete')
                                                            @csrf
                                                            <button class="badge icon bg-danger border-0" onclick="return confirm('Yakin akan menghapus user ini?')"><i data-feather="trash"></i></button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                      </table>
                                      <div class="row mt-3">
                                        <div class="col-md-12 col-12">
                                            {{ $anggotarombels->links() }}
                                        </div>
                                      </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-12 col-md-12">
                
            </div>
        </div>
    </section>
    <!-- list group with contextual & horizontal ends -->

@endsection