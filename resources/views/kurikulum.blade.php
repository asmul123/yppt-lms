@extends('layouts.main')

@section('content')

<div class="main-content container-fluid">
    <div class="page-title">
        <h3>Daftar Kurikulum</h3>
    </div>
    <section class="section">
        <div class="card">
            <div class="card-header">
                <a href="#" class="btn icon icon-left btn-primary" data-toggle="modal" data-target="#tambah-kurikulum"><i data-feather="plus"></i> Tambah Kurikulum</a>
                    <!--BorderLess Modal Modal -->
                    <div class="modal fade text-left modal-borderless" id="tambah-kurikulum" tabindex="-1" role="dialog" aria-labelledby="modalTambah" aria-hidden="true">
                        <div class="modal-dialog modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Tambah Kurikulum</h5>
                                    <button type="button" class="close rounded-pill" data-dismiss="modal" aria-label="Close">
                                    <i data-feather="x"></i>
                                    </button>
                                </div>
                                <form action="{{ url('/') }}/kurikulum" method="post">
                                    @csrf
                                <div class="modal-body">
                                        <div class="row">
                                            <div class="col-md-12 col-12">
                                                <div class="form-group">
                                                    <label for="first-name-column">Nama Kurikulum</label>
                                                    <input type="text" class="form-control"  name="kurikulum">
                                                </div>
                                            </div>
                                        </diV>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-light-primary" data-dismiss="modal">
                                            <i class="bx bx-x d-block d-sm-none"></i>
                                            <span class="d-none d-sm-block">Close</span>
                                        </button>
                                        <input type="submit" class="btn btn-primary ml-1" value="Simpan">
                                            <i class="bx bx-check d-block d-sm-none"></i>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
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
                            <th>Kurikulum</th>
                            <th>Jumlah Dokumen</th>
                            <th>Dokumen Administrasi</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($kurikulums as $kurikulum)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $kurikulum->kurikulum }}</td>
                            <td>{{ App\Models\Dokumenkurikulum::where('kurikulum_id', $kurikulum->id)->count() }}</td>
                            <td><a href="{{ url('/kurikulum').'/'.$kurikulum->id }}" class="badge bg-info">Lihat</a></td>
                            <td>
                                <div class="btn-group mb-3" role="group" aria-label="Basic example">
                                    <a href="{{ url('/kurikulum/'.$kurikulum->id.'/edit') }}" class="badge icon bg-warning"><i data-feather="edit"></i></a>
                                    <form action="{{ url('/') }}/kurikulum/{{ $kurikulum->id }}" method="post">
                                        @method('delete')
                                        @csrf
                                        <button class="badge icon bg-danger border-0" onclick="return confirm('Yakin akan menghapus kurikulum ini?')"><i data-feather="trash"></i></button>
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

@endsection