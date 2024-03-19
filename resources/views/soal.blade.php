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
                                <h1 class="card-title pl-1">
                                    Daftar Soal
                                    <hr>
                                    <p>
                                    <sup>Kode Soal : {{ $banksoal->kodesoal }}</sup><br>
                                    <sup>Mata Pelajaran : {{ $banksoal->pembelajaran->matapelajaran }}</sup>
                                    </p>
                                </h1>
                            </div>
                            <div class="card">
                                <div class="card-header">
                                        <a href="#" class="btn icon icon-left btn-primary" data-toggle="modal" data-target="#tambah-banksoal"><i data-feather="plus"></i> Tambah Soal</a>
                                        <!--BorderLess Modal Modal -->
                                        <div class="modal fade text-left modal-borderless" id="tambah-banksoal" tabindex="-1" role="dialog" aria-labelledby="modalTambah" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-scrollable modal-full" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Tambah Soal</h5>
                                                        <button type="button" class="close rounded-pill" data-dismiss="modal" aria-label="Close">
                                                        <i data-feather="x"></i>
                                                        </button>
                                                    </div>
                                                    <form action="{{ url('/soal') }}" method="post">
                                                        @csrf
                                                    <div class="modal-body">
                                                            <div class="row">
                                                                <div class="col-md-12 col-12">
                                                                    <div class="card collapse-icon accordion-icon-rotate">
                                                                        <div class="card-header">                                                                            
                                                                            <div class="form-group">
                                                                                <label for="first-name-column">Soal</label>
                                                                                <textarea class="soal" name="soal" class="form-control"></textarea>
                                                                                <input type="hidden" name="banksoal_id" value={{ $banksoal->id }}>
                                                                            </div>
                                                                        </div>
                                                                        <div class="card-content">
                                                                            <div class="card-body">
                                                                                <div class="accordion" id="cardAccordion">
                                                                                    @for ($i = 'A'; $i < 'F'; $i++)
                                                                                    <div class="card">
                                                                                        <div class="card-header" id="heading{{ $i }}" data-toggle="collapse" data-target="#collapse{{ $i }}"
                                                                                            aria-expanded="false" aria-controls="collapse{{ $i }}" role="button">
                                                                                                    <span class="collapsed collapse-title">
                                                                                                        <div class="row  justify-content-end">
                                                                                                            <div class="col-lg-10">Pilihan {{ $i }}</div>
                                                                                                            <div class="col-lg-2">
                                                                                                                <label>
                                                                                                                    Jadikan Kunci :
                                                                                                                </label>
                                                                                                                <input class="form-check-input" type="radio" name="kunci" value="{{ $i }}">
                                                                                                            </div>
                                                                                                        </div>
                                                                                        </div>
                                                                                        <div id="collapse{{ $i }}" class="collapse pt-1" aria-labelledby="heading{{ $i }}"
                                                                                            data-parent="#cardAccordion">
                                                                                            <div class="card-body">                                                                                                                                                                            
                                                                                                <div class="form-group">
                                                                                                    <textarea class="jawaban" name="jawaban{{ $i }}" class="form-control"></textarea>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>                                                                                    
                                                                                    @endfor
                                                                                </div>
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
                                                    <script type="text/javascript">
                                                        $(document).ready(function() {
                                                            $('.soal').summernote({
                                                                placeholder: 'Tuliskan Soal',
                                                                tabsize: 1,
                                                                height: 100
                                                            });
                                                        });
                                                        
                                                        $(document).ready(function() {
                                                            $('.jawaban').summernote({
                                                                placeholder: 'Tuliskan Pilihan',
                                                                tabsize: 1,
                                                                height: 50
                                                            });
                                                        });
                                                    </script>
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
                                                                    <option value="">Filter Soal</option>
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
                                                <th>Soal</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($soals as $soal)
                                            <tr>
                                                <td class="align-top">{{ $soals->firstItem() + $loop->index }}</td>
                                                <td>
                                                    Soal :<br>
                                                    {!! $soal->soal !!}<hr>
                                                    <ol type="A">
                                                        @php
                                                        $op = explode("[#_#]", $soal->jawaban);
                                                        for ($i = 0; $i <= 5; $i++) {
                                                            if($op[$i]!=""){
                                                                $isiop = explode("[_#_]", $op[$i]);
                                                                echo "<li>" . $isiop[1];
                                                                echo "</li>";
                                                            }
                                                        } 
                                                        @endphp
                                                    </ol>
                                                    {{ 'Kunci : '.$soal->kunci }}
                                                </td>
                                                <td>
                                                    <div class="btn-group mb-3" role="group" aria-label="Basic example"><a href="{{ url('/') }}/banksoal/{{ $banksoal->id }}/edit" class="badge icon bg-warning"><i data-feather="edit"></i></a>
                                                        <form action="{{ url('/') }}/soal/{{ $soal->id }}" method="post">
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
                                            {{ $soals->links() }}
                                        </div>
                                      </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-12 col-md-12">
                
            </div>
        </div>
    </section>
    <!-- list group with contextual & horizontal ends -->

@endsection