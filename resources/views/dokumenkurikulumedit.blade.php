@extends('layouts.main')

@section('content')

<div class="main-content container-fluid">
    <div class="page-title">
        <h3>Edit Dokumen Kurikulum</h3>
    </div>
    <section class="section">
        <div class="card">
            <div class="card-header">
                Ubah Dokumen Kurikulum
            </div>
            <div class="card-body">
                <form action="{{ url('/') }}/dokumenkurikulum/{{ $dokumenkurikulum->id }}" method="post">
                    @method('put')
                    @csrf
                    <div class="row">
                        <div class="col-md-12 col-12">
                            <div class="form-group">
                                <label for="country-floating">Tahun Pejaran</label>
                                <select class="form-control" name="tahunpelajaran_id">
                                    <option value="">Pilih Tahun Pelajaran</option>
                                    @foreach ($tapels as $tapel)
                                    <option value="{{ $tapel->id }}" {{ ($tapel->id == $dokumenkurikulum->tahunpelajaran_id ? 'selected' : false) }}>{{ $tapel->tahunpelajaran }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12 col-12">
                            <div class="form-group">
                                <label for="first-name-column">Judul Dokumen</label>
                                <input type="text" class="form-control" name="juduldokumen" value="{{ $dokumenkurikulum->juduldokumen }}">
                                <input type="hidden" name="kurikulum_id" value="{{ $dokumenkurikulum->kurikulum_id }}">
                            </div>
                        </div>
                        <div class="col-md-12 col-12">
                            <div class="form-group">
                                <label for="first-name-column">Jenis Berkas</label>
                                <input type="text" class="form-control" name="jenisdokumen" value="{{ $dokumenkurikulum->jenisdokumen }}">
                            </div>
                        </div>
                        <div class="col-md-12 col-12">
                            <div class="form-group">
                                <label for="first-name-column">Ukuran Maksimal Berkas</label>
                                <input type="number" class="form-control" name="ukurandokumen" value="{{ $dokumenkurikulum->ukurandokumen }}">
                            </div>
                        </div>
                        <div class="col-md-12 col-12">
                            <input type="submit" class="btn btn-primary ml-1" value="Simpan">
                        </div>
                    </diV>
                </form>
            </div>
        </div>
    </section>
</div>
@endsection