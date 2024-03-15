@extends('layouts.main')

@section('content')

<div class="main-content container-fluid">
    <div class="page-title">
        <h3>Daftar Akses User</h3>
    </div>
    <section class="section">
        <div class="card">
            <div class="card-header">
                Pengelolaan Akses User {{ $hakakses->hakakses }}
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
                                            <select class="form-control" onchange="this.form.submit()" name="tapel_id">
                                                <option value="">Filter Tahun Pelajaran</option>
                                                @foreach ($tapels as $tapel)
                                                <option value="{{ $tapel->id }}" {{ (request('tapel_id') == $tapel->id ? 'selected' : false) }}>{{ $tapel->tahunpelajaran }}</option>
                                                @endforeach
                                            </select>
                                    </div>
                                </div>
                                <div class="col-md-6 col-6"></div>
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
                            <th>Nama Guru</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($aksesusers as $aksesuser)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $aksesuser->tahunpelajaran->tahunpelajaran }}</td>
                            <td>{{ $aksesuser->user->name }}</td>
                            <td>
                                <div class="btn-group mb-3" role="group" aria-label="Basic example">
                                    <form action="{{ url('/') }}/aksesuser/{{ $aksesuser->id }}" method="post">
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
                        {{ $aksesusers->links() }}
                    </div>
                  </div>
                </div>
            </div>
        </div>
    </section>
</div>

@endsection