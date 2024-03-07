@extends('layouts.main')

@section('content')


<link rel="stylesheet" href="assets/vendors/simple-datatables/style.css">
<div class="main-content container-fluid">
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

    
<script src="assets/vendors/simple-datatables/simple-datatables.js"></script>
<script src="assets/js/vendors.js"></script>
@endsection