@extends('layouts.main')

@section('content')


<div class="main-content container-fluid">
    <!-- list group with contextual & horizontal start -->
    <section id="list-group-contextual">
        <div class="row match-height">
            <div class="col-md-12 col-sm-12">
                <div class="card">
                    <div class="card-content">
                        <img class="card-img-top img-fluid" src="{{ url('assets/images/samples/aerial-panoramic-image-of-sansonvale-lake-X6TCENW.jpg') }}"
                            alt="Card image cap" />
                        <div class="card-body">
                            <h4 class="card-title">{{ $pembelajaran->rombonganbelajar->rombongan_belajar }}</h4>
                            <p class="card-text">
                                {{ $pembelajaran->matapelajaran }}
                            </p>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                            @if (session('failed'))
                            <div class="alert alert-light-danger color-warning">{{ session('failed') }}</div>
                            @endif

                            <form>
                                <div class="row justify-content-end">
                                        <div class="col-md-4 col-4">
                                            <div class="form-group">
                                                <input type="text" class="form-control"  name="search" placeholder="Cari Tugas" value="{{ request('search') }}">
                                            </div>
                                        </div>
                                </div>
                            </form>
                    </div>
                    <div class="card-content">
                        <div class="card-body">                                                      
                            @include('layouts.tabpd')
                            <div class="card border border-light">
                                <div class="card-header">
                                    <h1 class="card-title pl-1">Status Tugas</h1>
                                </div>
                                <div class="card-content">
                                    <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-12 col-12">
                                                    <div class="panel-body">
                                                        <table width="100%" cellpadding="2" cellspasing="2">
                                                            <tr>
                                                                <td>Mata Pelajaran</td>
                                                                <td>:</td>
                                                                <td><?= $pembelajaran->matapelajaran ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td>Durasi</td>
                                                                <td>:</td>
                                                                <td><?= $penugasan->durasi ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td>Status</td>
                                                                <td>:</td>
                                                                <td>{{ $status }}</td>
                                                            </tr>
                                                            @if(isset($pengerjaan))
                                                            <tr>
                                                                <td>Nilai</td>
                                                                <td>:</td>
                                                                <td>{{ number_format($pengerjaan->nilai,2) }}</td>
                                                            </tr>
                                                            @endif
                                                        </table>
                                                </div>
                                                <div class="col-12 d-flex mt-3">
                                                    <a href="{{ url('pembelajaranpd/'.$pembelajaran->id) }}" class="btn btn-warning mr-1 mb-1">Kembali</a>
                                                </div>
                                            </div>
                                    </div>
                                </div>                           
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection