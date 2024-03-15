@extends('layouts.main')

@section('content')


<div class="main-content container-fluid">
    <div class="page-title">
        <h3>Daftar Pembelajaran</h3>
    </div>
    <section class="section">
        <div class="card">
            <div class="card-header">
                <a href="#" class="btn icon icon-left btn-primary" data-toggle="modal" data-target="#tambah-tapel"><i data-feather="plus"></i> Tambah Pembelajaran</a>
                <!--BorderLess Modal Modal -->
                    <div class="modal fade text-left modal-borderless" id="tambah-tapel" tabindex="-1" role="dialog" aria-labelledby="modalTambah" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-scrollable" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Tambah Pembelajaran</h5>
                                    <button type="button" class="close rounded-pill" data-dismiss="modal" aria-label="Close">
                                    <i data-feather="x"></i>
                                    </button>
                                </div>
                                <form action="{{ url('/') }}/pembelajaran" method="post">
                                    @csrf
                                <div class="modal-body">
                                        <div class="row">
                                            <div class="col-md-12 col-12">
                                                <div class="form-group">
                                                    <label for="first-name-column">Nama Pelajaran</label>
                                                    <input type="text" id="first-name-column" class="form-control" name="nama_pelajaran">
                                                </div>
                                            </div>
                                            <div class="col-md-12 col-12">
                                                <div class="form-group">
                                                    <label for="username-column">Rombongan Belajar</label>
                                                    <select class="form-control" name="rombonganbelajar">
                                                        <option value="1">X TKJ 1</option>
                                                    </select>
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
                            <th>Tahun Pelajaran</th>
                            <th>Nama Mata Pelajaran</th>
                            <th>Kelas</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pembelajarans as $pembelajaran)
                        <tr>
                            <td>{{ $pembelajarans->firstItem() + $loop->index }}</td>
                            <td>{{ $pembelajaran->tahunpelajaran->tahunpelajaran }}</td>
                            <td>{{ $pembelajaran->matapelajaran }}</td>
                            <td>{{ $pembelajaran->rombonganbelajar->rombongan_belajar }}</td>
                            <td>
                                <div class="btn-group mb-3" role="group" aria-label="Basic example">
                                    <a href="{{ url('/') }}/pembelajarandetail/{{ $pembelajaran->id }}" class="badge bg-info"><i data-feather="list"></i></a>
                                    <a href="{{ url('/') }}/pembelajaran/{{ $pembelajaran->id }}" class="badge bg-info"><i data-feather="edit"></i></a>
                                    <form action="{{ url('/') }}/pembelajaran/{{ $pembelajaran->id }}" method="post">
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
                        {{ $pembelajarans->links() }}
                    </div>
                  </div>
                </div>
            </div>
        </div>
    </section>
</div>

@endsection