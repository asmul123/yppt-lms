@extends('layouts.main')

@section('content')


<div class="main-content container-fluid">
    <div class="page-title">
        <h3>Daftar Pembelajaran</h3>
    </div>
    <section class="section">
        <div class="card">
            <div class="card-header">
                
                @if (session('success'))
                <div class="alert alert-light-success color-warning">{{ session('success') }}</div>
                @endif
                
                @if (session('failed'))
                <div class="alert alert-light-danger color-warning">{{ session('failed') }}</div>
                @endif

                <form>
                    <div class="row justify-content-end">
                            <div class="col-md-4 col-4">
                                <div class="form-group">
                                        <select class="form-control" onchange="this.form.submit()" name="tapel_id">
                                            <option value="">Filter Pembelajaran</option>
                                            @foreach ($tapels as $tapel)
                                            <option value="{{ $tapel->id }}" {{ ($tapel_id == $tapel->id ? 'selected' : false )}} >Tahun Pelajaran {{ $tapel->tahunpelajaran }}</option>
                                            @endforeach
                                        </select>
                                </div>
                            </div>
                            <div class="col-md-4 col-4"></div>
                            <div class="col-md-4 col-4">
                                <div class="form-group">
                                    <input type="text" class="form-control"  name="search" placeholder="Cari Pembelajaran" value="{{ request('search') }}">
                                </div>
                            </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
    @if ($pembelajarans->count()==0)
    <section id="bg-variants">
        <div class="row">
            <div class="col-xl-12 col-sm-12 col-12">
                <div class="card">
                    <div class="card-content">
                        <div class="row no-gutters">
                            <div class="col-lg-12 col-12 text-center">
                                <div class="card-body">
                                    <p class="card-text text-ellipsis">
                                        Anda Belum Membuat Kelas Pada Tahun Pelajaran ini
                                    </p>
                                    <a href="#" class="btn btn-info" data-toggle="modal" data-target="#tambah-tapel">Buat Kelas</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Background variants section end -->
    @else
    <section id="card-caps">
        <div class="row">
            @foreach($pembelajarans as $pembelajaran)
            <div class="col-xl-4 col-md-6 col-sm-12">
                <div class="card">
                    <div class="card-content">
                        <img class="card-img img-fluid" src="{{ url('assets/images/sampuls/bg-default.jpg') }}" alt="Card image">
                        <div class="card-img-overlay overlay-dark bg-overlay d-flex justify-content-between flex-column">
                            <div class="overlay-content">
                                <h4 class="card-title mb-50">{{ $pembelajaran->rombonganbelajar->rombongan_belajar }}</h4>
                                <p class="card-text text-ellipsis">
                                    {{ $pembelajaran->matapelajaran }}
                                </p>
                            </div>
                            <div class="overlay-status">
                                <p class="mb-25"><small>Dibuat : {{ date_format($pembelajaran->created_at,"d-m-Y H:i:s") }}</small></p>
                                <a href="{{url('/pembelajaran/'.$pembelajaran->id)}}" class="btn btn-primary btn-sm">Lihat</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>        
        <div class="row mt-3">
            <div class="col-md-12 col-12">
                {{ $pembelajarans->links() }}
            </div>
        </div>
    </section>
    <!-- Card Captions and Overlay section end -->
    <section id="bg-variants">
        <div class="row">
            <div class="col-xl-12 col-sm-12 col-12">
                <div class="card">
                    <div class="card-content">
                        <div class="row no-gutters">
                            <div class="col-lg-12 col-12 text-center">
                                <div class="card-body">
                                    <a href="#" class="btn btn-info" data-toggle="modal" data-target="#tambah-tapel">Buat Kelas</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Background variants section end -->
    
    @endif
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
                                <form action="{{ url('/pembelajaran') }}" method="post">
                                    @csrf
                                <div class="modal-body">
                                        <div class="row">
                                            <div class="col-md-12 col-12">
                                                <div class="form-group">
                                                    <label for="first-name-column">Nama Pelajaran</label>
                                                    <input type="text" id="first-name-column" class="form-control" name="matapelajaran">
                                                    <input type="hidden" class="form-control" name="tahunpelajaran_id" value="{{ $tapel_id }}">
                                                </div>
                                            </div>
                                            <div class="col-md-12 col-12">
                                                <div class="form-group">
                                                    <label for="country-floating">Kelas</label>
                                                    <select class="choices form-select" multiple="multiple" name="rombonganbelajar_id[]">
                                                        <option value="">Pilih Kelas</option>
                                                        @foreach ($rombels as $rombel)
                                                        <option value="{{ $rombel->id }}">{{ $rombel->rombongan_belajar }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </diV>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-light-primary" data-dismiss="modal">
                                            <i class="bx bx-x d-block d-sm-none"></i>
                                            <span class="d-none d-sm-block">Keluar</span>
                                        </button>
                                        <input type="submit" class="btn btn-primary ml-1" value="Simpan">
                                            <i class="bx bx-check d-block d-sm-none"></i>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>    
</div>

@endsection