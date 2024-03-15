@extends('layouts.main')

@section('content')

<div class="main-content container-fluid">
    <div class="page-title">
        <h3>Edit Kurikulum</h3>
    </div>
    <section class="section">
        <div class="card">
            <div class="card-header">
                Ubah Kurikulum
            </div>
            <div class="card-body">
                <form action="{{ url('/') }}/kurikulum/{{ $kurikulum->id }}" method="post">
                    @method('put')
                    @csrf
                    <div class="row">
                        <div class="col-md-12 col-12">
                            <div class="form-group">
                                <label for="first-name-column">Nama Kurikulum</label>
                                <input type="text" class="form-control"  name="kurikulum" value="{{ $kurikulum->kurikulum }}">
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