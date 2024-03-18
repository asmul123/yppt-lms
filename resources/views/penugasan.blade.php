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
                            <div class="list-group list-group-horizontal-sm mb-1 text-center" role="tablist">
                                <a class="list-group-item list-group-item-action active" id="list-sunday-list"
                                 href="{{ url('/pembelajaran/'.$pembelajaran->id) }}" role="tab">Penugasan</a>
                                <a class="list-group-item list-group-item-action" id="list-monday-list"
                                    href="{{ url('/pembelajaran/'.$pembelajaran->id."?tab=diskusi") }}" role="tab">Diskusi Kelas</a>
                                <a class="list-group-item list-group-item-action" id="list-tuesday-list"
                                    href="{{ url('/pembelajaran/'.$pembelajaran->id."?tab=kehadiran") }}" role="tab">Kehadiran</a>
                                <a class="list-group-item list-group-item-action" id="list-tuesday-list"
                                    href="{{ url('/pembelajaran/'.$pembelajaran->id."?tab=banksoal") }}" role="tab">Bank Soal</a>
                                <a class="list-group-item list-group-item-action" id="list-tuesday-list"
                                    href="{{ url('/pembelajaran/'.$pembelajaran->id."?tab=administrasi") }}" role="tab">Administrasi</a>
                            </div>
                            <div class="card-header">
                                <h1 class="card-title pl-1">Daftar Tugas</h1>
                            </div>

                            <div class="card border border-light">
                                <div class="card-header">
                                    <span class="collapsed collapse-title">Tanggal Penugasan : 17 Maret 2024 15:00:03</span>
                                    <br>
                                    <sup>Oleh : Asep Ulumudin, S.Kom.</sup>
                                </div>
                                <div class="card-body">
                                    <div class="card border border-light">
                                            <div class="card-header">
                                                <h3>Judul Tugas</h3>
                                                Jatuh Tempo pada : 20 Maret 2024                                                
                                            </div>
                                            <div class="card-body">
                                                <a href="#" class="btn btn-outline-primary">Lihat Tugas</a>
                                            </div>
                                            <div class="card-body">
                                                <form id="form" method="get" action="{{ url('/pembelajaran/'.$pembelajaran->id.'/edit') }}"  id="identifier">
                                                <a href="#" id="add-div-link">Tulis Komentar</a>

                                                
                                                <link rel="stylesheet" href="{{ url('/assets/vendors/quill/quill.bubble.css') }}">
                                                <link rel="stylesheet" href="{{ url('/assets/vendors/quill/quill.snow.css') }}">                                   
                                                <script src="{{ url('/assets/vendors/quill/quill.min.js') }}"></script>
                                                <script src="{{ url('/assets/js/pages/form-editor.js') }}"></script>
                                                <script>
                                                    document.getElementById('add-div-link').addEventListener('click', function(event) {
                                                        event.preventDefault(); // Mencegah perilaku default link
                                                        var scriptHTML = '<div id="full">isi</div><input type="hidden" name="komentar" id="hiddenInput"><hr><input type="submit" class="btn btn-success btn-sm" value="Simpan">';
                                                        document.getElementById('form').innerHTML = scriptHTML;
                                                    });
                                                </script>
                                                </form>
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
                                <form action="{{ url('/penugasan/create') }}" method="post">
                                    @csrf
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