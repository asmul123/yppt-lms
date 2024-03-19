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
                                                <input type="text" class="form-control"  name="search" placeholder="Cari Tugas" value="{{ request('search') }}">
                                            </div>
                                        </div>
                                </div>
                            </form>
                    </div>
                    <div class="card-content">
                        <div class="card-body">                                                      
                            @include('layouts.tab')
                            <div class="card-header">
                                <h1 class="card-title pl-1">Tambah Tugas</h1>
                            </div>
                            <div class="card-content">
                                <div class="card-body">
                                    <form class="form" method="post" action="{{ url('/penugasan') }}">
                                        @csrf
                                        <div class="row">
                                            <div class="col-md-12 col-12">
                                                <div class="form-group">
                                                    <label for="first-name-column">Judul Tugas</label>
                                                    <input type="text" class="form-control" placeholder="Judul Tugas" name="judultugas" autofocus>
                                                    <input type="hidden" name="jenispenugasan_id" value={{ $jenispenugasan_id }}>
                                                </div>
                                            </div>
                                            <div class="col-md-12 col-12">
                                                <div class="form-group">
                                                    <label for="last-name-column">Deskripsi Tugas</label>
                                                    <textarea class="deskripsi" placeholder="Deskripsi Tugas"
                                                        name="deskripsitugas"></textarea>
                                                </div>
                                            </div>
                                            <div class="col-md-12 col-12">
                                                <div class="form-group">
                                                    <label for="last-name-column">Tugaskan Untuk Kelas<sub> (Boleh pilih lebih dari satu)</sub> </label>
                                                    <select name="pembelajaran_id[]" class="choices form-select" multiple="multiple">
                                                        <option value="">Pilih Kelas</option>
                                                        @foreach($rombels as $rombel)
                                                        <option value="{{ $rombel->id }}" {{ ($pembelajaran->id == $rombel->id ? 'selected' : false) }}>{{ $rombel->rombonganbelajar->rombongan_belajar." | ".$rombel->matapelajaran }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            @if($jenispenugasan_id == 1)
                                            <div class="col-md-12 col-12">
                                                <div class="form-group">
                                                    <label for="last-name-column">Pilih Soal</label>
                                                    <select name="banksoal_id" class="choices form-select">
                                                        <option value="">Pilih Soal</option>
                                                        @foreach($soals as $soal)
                                                        <option value="{{ $soal->id }}">{{ $soal->kodesoal." | ".$soal->pembelajaran->matapelajaran }} ({{  App\Models\Soal::where('banksoal_id', $soal->id)->count() }} soal)</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group col-md-6 col-12">
                                                <div class='form-check'>
                                                    <div class="checkbox">
                                                        <label for="checkbox5">Acak Soal</label>
                                                        <input type="checkbox" name="acaksoal" class='form-check-input' value="1">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group col-md-6 col-12">
                                                <div class='form-check'>
                                                    <div class="checkbox">
                                                        <label for="checkbox5">Acak Jawaban</label>
                                                        <input type="checkbox" name="acakjawaban" class='form-check-input' value="1">
                                                    </div>
                                                </div>
                                            </div>
                                            @endif
                                            <div class="col-md-12 col-12">
                                                <div class="form-group">
                                                    <label for="city-column">Durasi <sub>(kosongkan untuk menonaktifkan)</sub></label>
                                                    <input type="time" class="form-control" placeholder="Kosongkan untuk mematikan waktu" name="durasi">
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="country-floating">Tanggal Mulai</label>
                                                    <div class="input-group">
                                                    <input type="date" class="form-control" name="tanggalmulai" placeholder="Tanggal Mulai">
                                                    <input type="time" class="form-control" name="waktumulai" placeholder="Waktu Mulai">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="company-column">Tanggal Penutupan</label>
                                                    <div class="input-group">
                                                        <input type="date" class="form-control" name="tanggalselesai" placeholder="Tanggal Penutupan">
                                                        <input type="time" class="form-control" name="waktuselesai" placeholder="Waktu Penutupan">
                                                    </div>
                                                       
                                                </div>
                                            </div>
                                            <div class="form-group col-md-6 col-12">
                                                <div class='form-check'>
                                                    <div class="checkbox">
                                                        <label for="checkbox5">Aktifkan Token</label>
                                                        <input type="checkbox" name="token" class='form-check-input' value="1">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group col-md-6 col-12">
                                                <div class='form-check'>
                                                    <div class="checkbox">
                                                        <label for="checkbox5">Ijinkan Terlambat</label>
                                                        <input type="checkbox" name="terlambat" class='form-check-input' value="1">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 d-flex justify-content-end">
                                                <button type="reset" class="btn btn-light-secondary mr-1 mb-1">Reset</button>
                                                <button type="submit" class="btn btn-primary mr-1 mb-1">Simpan</button>
                                            </div>
                                        </div>
                                    </form>
                                    <script type="text/javascript">                                    
                                        $(document).ready(function() {
                                            $('.deskripsi').summernote({
                                                placeholder: 'Tuliskan Deskripsi',
                                                tabsize: 1,
                                                height: 100
                                            });
                                        });
                                    </script>
                                </div>
                            </div>                           
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection