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
                    <div class="page-title">
                        <h3>Daftar Administrasi Pembelajaran</h3>
                    </div>
                    <section class="section">
                        <div class="card">
                            <div class="card-header">
                                Daftar Tagihan Administrasi
                            </div>
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
                                            <th>Tahun Pelajaran</th>
                                            <th>Jenis Dokumen</th>
                                            <th>Status</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($administrasis as $administrasi)
                                        <tr>
                                            <td>{{ $administrasis->firstItem() + $loop->index }}</td>
                                            <td>{{ $administrasi->tahunpelajaran->tahunpelajaran }}</td>
                                            <td>{{ $administrasi->dokumen->jenisdokumen }}</td>
                                            <td></td>
                                            <td>
                                                <div class="btn-group mb-3" role="group" aria-label="Basic example">
                                                    <a href="/administrasi/{{ $administrasi->id }}" class="badge bg-info"><i data-feather="upload"></i></a>
                                                    <a href="/administrasi/{{ $administrasi->id }}" class="badge bg-waring"><i data-feather="download"></i></a>
                                                    <form action="/administrasi/{{ $administrasi->id }}" method="post">
                                                        @method('delete')
                                                        @csrf
                                                        <button class="badge icon bg-danger border-0" onclick="return confirm('Yakin akan menghapus tahun pelajaran ini?')"><i data-feather="trash"></i></button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                  </table>
                                  <div class="row mt-3">
                                    <div class="col-md-12 col-12">
                                        {{ $administrasis->links() }}
                                    </div>
                                  </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
            <div class="col-lg-12 col-md-12">
                
            </div>
        </div>
    </section>
    <!-- list group with contextual & horizontal ends -->
    <section id="bg-variants">
        <div class="row">
            <div class="col-xl-12 col-sm-12 col-12">
                <div class="card">
                    <div class="card-content">
                        <div class="row no-gutters">
                            <div class="col-lg-12 col-12 text-center">
                                <div class="card-body">
                                    @if ($penugasans->count()==0)
                                    <p class="card-text text-ellipsis">
                                        Anda belum membuat tugas pada kelas ini
                                    </p>
                                    @endif
                                    <a href="#" class="btn btn-info" data-toggle="modal" data-target="#tambah-tapel">Tambah Tugas</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Background variants section end -->
    <!--BorderLess Modal Modal -->
                    <div class="modal fade text-left modal-borderless" id="tambah-tapel" tabindex="-1" role="dialog" aria-labelledby="modalTambah" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-scrollable" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Tambah Tugas</h5>
                                    <button type="button" class="close rounded-pill" data-dismiss="modal" aria-label="Close">
                                    <i data-feather="x"></i>
                                    </button>
                                </div>
                                <form action="{{ url('/penugasan') }}" method="get">
                                <div class="modal-body">
                                        <div class="row">
                                            <div class="col-md-12 col-12">
                                                <div class="form-group">
                                                    <label for="first-name-column">Jenis Penugasan</label>
                                                    <select class="form-control" name="jenispenugasan_id">
                                                        @foreach($jenispenugasans as $jenispenugasan)
                                                        <option value="{{ $jenispenugasan->id }}">{{ $jenispenugasan->jenispenugasan }}</option>
                                                        @endforeach
                                                    </select>
                                                    <input type="hidden" name="pembelajaran_id" value="{{ $pembelajaran->id }}">
                                                </div>
                                            </div>
                                        </diV>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-light-primary" data-dismiss="modal">
                                            <i class="bx bx-x d-block d-sm-none"></i>
                                            <span class="d-none d-sm-block">Batal</span>
                                        </button>
                                        <input type="submit" class="btn btn-primary ml-1" value="Buat">
                                            <i class="bx bx-check d-block d-sm-none"></i>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>    
</div>

@endsection