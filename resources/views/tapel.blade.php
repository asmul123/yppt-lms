@extends('layouts.main')

@section('content')

<div class="main-content container-fluid">
    <div class="page-title">
        <h3>Daftar Tahun Pelajaran</h3>
    </div>
    <section class="section">
        <div class="card">
            <div class="card-header">
                <a href="#" class="btn icon icon-left btn-primary" data-toggle="modal" data-target="#tambah-tapel"><i data-feather="plus"></i> Tambah Tahun Pelajaran</a>
                <!--BorderLess Modal Modal -->
                    <div class="modal fade text-left modal-borderless" id="tambah-tapel" tabindex="-1" role="dialog" aria-labelledby="modalTambah" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-scrollable" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Tambah Tahun Pelajaran</h5>
                                    <button type="button" class="close rounded-pill" data-dismiss="modal" aria-label="Close">
                                    <i data-feather="x"></i>
                                    </button>
                                </div>
                                <form action="{{ url('/') }}/tahunpelajaran" method="post">
                                    @csrf
                                <div class="modal-body">
                                        <div class="row">
                                            <div class="col-md-12 col-12">
                                                <div class="form-group">
                                                    <label for="first-name-column">Tahun Awal</label>
                                                    <input type="year" id="first-name-column" class="form-control" name="year" id="datepicker">
                                                    <script>
                                                        $("#datepicker").datepicker({
                                                            format: "yyyy",
                                                            viewMode: "years", 
                                                            minViewMode: "years"
                                                        });
                                                    </script>
                                                </div>
                                            </div>
                                            <div class="col-md-12 col-12">
                                                <div class="form-group">
                                                    <label for="username-column">Semester</label>
                                                    <select class="form-control" name="semester">
                                                        <option value="1">Ganjil</option>
                                                        <option value="2">Genap</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-12 col-12">
                                                <div class="form-group">
                                                    <div class='form-check'>
                                                        <div class="checkbox">
                                                            <input type="checkbox" name="is_active" class='form-check-input' value="1">
                                                            <label for="checkbox1">Aktifkan</label>
                                                        </div>
                                                    </div>
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
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($tapels as $tapel)
                        <tr>
                            <td>{{ $tapels->firstItem() + $loop->index }}</td>
                            <td>{{ $tapel->tahunpelajaran }}</td>
                            <td>
                                @if ($tapel->is_active == 1)
                                <span class="badge bg-success">Aktif</span>
                                @endif
                            </td>
                            <td>
                                <div class="btn-group mb-3" role="group" aria-label="Basic example">
                                    <form action="{{ url('/') }}/tahunpelajaran/{{ $tapel->id }}" method="post">
                                        @method('put')
                                        @csrf
                                        <button class="badge icon bg-primary border-0"><i data-feather="check"></i></button>
                                    </form>
                                    <form action="{{ url('/') }}/tahunpelajaran/{{ $tapel->id }}" method="post">
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
                        {{ $tapels->links() }}
                    </div>
                  </div>
                </div>
            </div>
        </div>
    </section>
</div>

@endsection