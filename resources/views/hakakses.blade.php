@extends('layouts.main')

@section('content')


<link rel="stylesheet" href="assets/vendors/simple-datatables/style.css">
<div class="main-content container-fluid">
    <div class="page-title">
        <h3>Daftar Hak Akses</h3>
    </div>
    <section class="section">
        <div class="card">
            <div class="card-header">
                Pengelolaan Akses User
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
                            <th>Hak Akses</th>
                            <th>Jumlah</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($hakaksess as $hakakses)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $hakakses->hakakses }}</td>
                            <td>{{ $hakakses->hakakses }}</td>
                            <td>
                                @if ($hakakses->is_active == 1)
                                <span class="badge bg-success">Aktif</span>
                                @endif
                            </td>
                            <td>
                                <div class="btn-group mb-3" role="group" aria-label="Basic example">
                                    <form action="/hakakses/{{ $hakakses->id }}" method="post">
                                        @method('put')
                                        @csrf
                                        <button class="badge icon bg-success border-0"><i data-feather="list"></i></button>
                                    </form>
                                    <form action="/hakakses/{{ $hakakses->id }}" method="post">
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
                </div>
            </div>
        </div>
    </section>
</div>

    
<script src="assets/vendors/simple-datatables/simple-datatables.js"></script>
<script src="assets/js/vendors.js"></script>
@endsection