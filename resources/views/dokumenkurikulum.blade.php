@extends('layouts.main')

@section('content')

<div class="main-content container-fluid">
    <div class="page-title">
        <h3>Daftar Dokumen Administrasi {{ $kurikulum->kurikulum }}</h3>
    </div>
    <section class="section">
        <div class="card">
            <div class="card-header">
                <a href="#" class="btn icon icon-left btn-primary" data-toggle="modal" data-target="#tambah-dokumen"><i data-feather="plus"></i> Tambah Dokumen Administrasi</a>
                    <!--BorderLess Modal Modal -->
                    <div class="modal fade text-left modal-borderless" id="tambah-dokumen" tabindex="-1" role="dialog" aria-labelledby="modalTambah" aria-hidden="true">
                        <div class="modal-dialog modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Tambah Dokumen Administrasi</h5>
                                    <button type="button" class="close rounded-pill" data-dismiss="modal" aria-label="Close">
                                    <i data-feather="x"></i>
                                    </button>
                                </div>
                                <form action="{{ url('/') }}/dokumenkurikulum" method="post">
                                    @csrf
                                <div class="modal-body">
                                        <div class="row">
                                            <div class="col-md-12 col-12">
                                                <div class="form-group">
                                                    <label for="country-floating">Tahun Pejaran</label>
                                                    <select class="form-control" name="tahunpelajaran_id">
                                                        <option value="">Pilih Tahun Pelajaran</option>
                                                        @foreach ($tapels as $tapel)
                                                        <option value="{{ $tapel->id }}" {{ ($tapel->is_active == 1 ? 'selected' : false) }}>{{ $tapel->tahunpelajaran }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-12 col-12">
                                                <div class="form-group">
                                                    <label for="first-name-column">Judul Dokumen</label>
                                                    <input type="text" class="form-control" name="juduldokumen">
                                                    <input type="hidden" name="kurikulum_id" value="{{ $kurikulum->id }}">
                                                </div>
                                            </div>
                                            <div class="col-md-12 col-12">
                                                <div class="form-group">
                                                    <label for="first-name-column">Jenis Berkas</label>
                                                    <input type="text" class="form-control" name="jenisdokumen" placeholder="Masukan extensi berkas yang diizinkan pisah dengan koma mis. (pdf,docx)">
                                                </div>
                                            </div>
                                            <div class="col-md-12 col-12">
                                                <div class="form-group">
                                                    <label for="first-name-column">Ukuran Maksimal Berkas</label>
                                                    <input type="number" class="form-control" name="ukurandokumen" placeholder="Dalam satuan Byte">
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
                            <th>Judul Dokumen</th>
                            <th>Jenis Berkas</th>
                            <th>Ukuran Maksimal Berkas(Byte)</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($dokumenkurikulums as $dokumenkurikulum)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $dokumenkurikulum->tahunpelajaran->tahunpelajaran }}</td>
                            <td>{{ $dokumenkurikulum->juduldokumen }}</td>
                            <td>{{ $dokumenkurikulum->jenisdokumen }}</td>
                            <td>{{ $dokumenkurikulum->ukurandokumen }}</td>
                            <td>
                                <div class="btn-group mb-3" role="group" aria-label="Basic example">
                                    <a href="{{ url('/') }}/dokumenkurikulum/{{ $dokumenkurikulum->id }}/edit" class="badge bg-warning"><i data-feather="edit"></i></a>
                                    <form action="{{ url('/') }}/dokumenkurikulum/{{ $dokumenkurikulum->id }}" method="post">
                                        @method('delete')
                                        @csrf
                                        <button class="badge icon bg-danger border-0" onclick="return confirm('Yakin akan menghapus dokumen ini?')"><i data-feather="trash"></i></button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                  </table>
                  <div class="row mt-3">
                    <div class="col-md-12 col-12">
                        {{ $dokumenkurikulums->links() }}
                    </div>
                  </div>
                </div>
            </div>
        </div>
    </section>
</div>

@endsection