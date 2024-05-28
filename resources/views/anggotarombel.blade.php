@extends('layouts.main')

@section('content')


<div class="main-content container-fluid">
    <div class="page-title">
        <h3>Daftar Anggota Rombel {{ $rombonganbelajar->rombongan_belajar }}</h3>
    </div>
    <section class="section">
        <div class="card">
            <div class="card-header">
                <a href="#" class="btn icon icon-left btn-primary" data-toggle="modal" data-target="#tambah-rombel"><i data-feather="plus"></i> Tambah Anggota Rombongan Belajar</a>
                <!--BorderLess Modal Modal -->
                    <div class="modal fade text-left modal-borderless" id="tambah-rombel" tabindex="-1" role="dialog" aria-labelledby="modalTambah" aria-hidden="true">
                        <div class="modal-dialog modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Tambah Anggota Rombongan Belajar</h5>
                                    <button type="button" class="close rounded-pill" data-dismiss="modal" aria-label="Close">
                                    <i data-feather="x"></i>
                                    </button>
                                </div>
                                <form action="{{ url('/') }}/anggotarombel" method="post">
                                    @csrf
                                <div class="modal-body">
                                        <div class="row">
                                            <div class="col-md-12 col-12">
                                                <div class="form-group">
                                                    <label for="country-floating">Masukan Peserta Didik</label>
                                                    <select class="choices form-select" multiple="multiple" name="user_id[]">
                                                        <option value="">Pilih Peserta Didik</option>
                                                        @foreach ($users as $user)
                                                        @php
                                                        $cekanggota = App\Models\Anggotarombel::where('tahunpelajaran_id', $rombonganbelajar->tahunpelajaran_id)->where('user_id',$user->id)->count();            
                                                        @endphp
                                                        @if($cekanggota==0)
                                                        <option value="{{ $user->id }}">{{ $user->username." | ".$user->name }}</option>
                                                        @endif
                                                        @endforeach
                                                    </select>
                                                    <input type="hidden" name="tahunpelajaran_id" value="{{ $rombonganbelajar->tahunpelajaran_id }}">
                                                    <input type="hidden" name="rombonganbelajar_id" value="{{ $rombonganbelajar->id }}">
                                                </div>
                                            </div>
                                        </diV>
                                        <div class="row mt-20"></div>
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
                <a href="#" class="btn icon icon-left btn-success float-right" data-toggle="modal" data-target="#import-rombel"><i data-feather="upload"></i> Import Anggota Rombongan Belajar</a>
                <div class="modal fade text-left modal-borderless" id="import-rombel" tabindex="-1" role="dialog" aria-labelledby="modalimport" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-scrollable" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Import Anggota Rombongan Belajar</h5>
                                <button type="button" class="close rounded-pill" data-dismiss="modal" aria-label="Close">
                                <i data-feather="x"></i>
                                </button>
                            </div>
                            <form action="{{ url('/') }}/anggotarombel/import" method="post" enctype="multipart/form-data">
                                @csrf
                            <div class="modal-body">
                                    <div class="row">
                                        <div class="col-md-12 col-12">
                                            <div class="form-group">
                                                <label for="first-name-column">File</label>
                                                <input type="hidden" name="rombonganbelajar_id" value="{{ $rombonganbelajar->id }}">
                                                <input type="hidden" name="tahunpelajaran_id" value="{{ $rombonganbelajar->tahunpelajaran_id }}">
                                                <input type="file" id="first-name-column" class="form-control"  name="excel_file">
                                            </div>
                                            <a href="{{ url('/') }}/assets/file/format_anggota_rombel.xlsx">Download Format</a>
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
                            <th>Nama Peserta Didik</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($anggotarombels as $anggotarombel)
                        <tr>
                            <td>{{ $anggotarombels->firstItem() + $loop->index }}</td>
                            <td>{{ $anggotarombel->user->name }}</td>
                            <td>
                                <div class="btn-group mb-3" role="group" aria-label="Basic example">
                                    <form action="{{ url('/') }}/anggotarombel/{{ $anggotarombel->id }}" method="post">
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
    </section>
</div>

@endsection