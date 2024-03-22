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
                            <div class="alert alert-light-danger color-warning">{{ session('failed') }}<br>
                                @if ($errors->any())
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                @endif    
                            </div>
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
                                <h1 class="card-title pl-1">Detail Administrasi Pembelajaran</h1>
                                <br>
                                Tahun Pelajaran : {{ $pembelajaran->tahunpelajaran->tahunpelajaran }}<br>
                                {{ $pembelajaran->rombonganbelajar->kurikulum->kurikulum }}<br>
                                {{ $dokumenkurikulum->juduldokumen }}<hr>
                                <a href="#" class="badge bg-primary" data-toggle="modal" data-target="#unggah"><i data-feather="upload"></i> Unggah</a>
                                <!--BorderLess Modal Modal -->
                                <div class="modal fade text-left modal-borderless" id="unggah" tabindex="-1" role="dialog" aria-labelledby="modalTambah" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-scrollable" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Unggah Dokumen Administrasi</h5>
                                                <button type="button" class="close rounded-pill" data-dismiss="modal" aria-label="Close">
                                                <i data-feather="x"></i>
                                                </button>
                                            </div>
                                            <form action="{{ url('/administrasi') }}" method="post" enctype="multipart/form-data">
                                                @csrf
                                            <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col-md-12 col-12">
                                                            <div class="form-group">
                                                                <label for="first-name-column">Jenis Dokumen</label>
                                                                <input type="text" class="form-control" name="juduldokumen" value="{{ $dokumenkurikulum->juduldokumen }}" readonly>
                                                                <input type="hidden" class="form-control" name="tahunpelajaran_id" value="{{ $pembelajaran->tahunpelajaran_id }}">
                                                                <input type="hidden" class="form-control" name="dokumenkurikulum_id" value="{{ $dokumenkurikulum->id }}">
                                                                <input type="hidden" class="form-control" name="pembelajaran_id" value="{{ $pembelajaran->id }}">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12 col-12">
                                                            <div class="form-group">
                                                                <label for="first-name-column">Keterangan</label>
                                                                <input type="text" class="form-control" name="keterangan">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12 col-12">
                                                            <div class="form-group">
                                                                <label for="first-name-column">Berkas</label>
                                                                <input type="file" id="first-name-column" class="form-control"  name="dokumen_file">
                                                            </div>
                                                            <sup>Format Berkas : <span id="jenis"></span>, Max. <span id="ukuran"></span> Byte</sup>
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
                            <table class="table table-striped mb-0">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Keterangan</th>
                                            <th>Status</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                        $i = 'a';
                                        @endphp
                                        @foreach($administrasis as $administrasi)
                                        <tr>
                                            <td>{{ $administrasis->firstItem() + $loop->index }}</td>
                                            <td>{{ $administrasi->keterangan }}</td>
                                            <td>
                                            @if($administrasi->status == 1)
                                             <span class="badge bg-warning">diajukan</span>
                                            @elseif($administrasi->status == 2)
                                                <span class="badge bg-success">diterima</span>
                                            @elseif($administrasi->status == 3)
                                                <span class="badge bg-danger">ditolak</span>
                                            @endif
                                            </td>
                                            <td>
                                                <div class="btn-group mb-3" role="group" aria-label="Basic example">
                                                    <a href="#" class="badge bg-warning" data-toggle="modal" data-target="#unggah" onclick="apData{{ $i }}()"><i data-feather="edit"></i> Edit</a>
                                                    <a href="{{ url('administrasi/'.$administrasi->id) }}" class="badge bg-primary"><i data-feather="download"></i> Unduh</a>
                                                    <a href="#" class="badge bg-danger"><i data-feather="trash"></i> Hapus</a>
                                                    <script>
                                                        function apData{{ $i }}() {
                                                            // let judul{{ $i }} = "{{ $administrasi->juduldokumen }}";
                                                            // let dokumen{{ $i }} = "{{ $administrasi->id }}";
                                                            // let jenis{{ $i }} = "{{ $administrasi->jenisdokumen }}";
                                                            // let ukuran{{ $i }} = "{{ $administrasi->ukurandokumen }}";
                                                            
                                                            document.getElementById("juduldokumen").value = judul{{ $i }};
                                                            document.getElementById("administrasi_id").value = dokumen{{ $i }};
                                                            document.getElementById("jenis").innerText = jenis{{ $i }};
                                                            document.getElementById("ukuran").innerText = ukuran{{ $i }};
                                                        }
                                                        </script>
                                                    @php
                                                    $i++;
                                                    @endphp
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                  </table>
                                  <div class="row mt-3">
                                    <div class="col-md-12 col-12">
                                        {{ $administrasis->links() }}
                                    </div>
                                  </div>
                                </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-12 col-md-12">
                <!--BorderLess Modal Modal -->
                <div class="modal fade text-left modal-borderless" id="unggah" tabindex="-1" role="dialog" aria-labelledby="modalTambah" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-scrollable" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Unggah Dokumen Administrasi</h5>
                                <button type="button" class="close rounded-pill" data-dismiss="modal" aria-label="Close">
                                <i data-feather="x"></i>
                                </button>
                            </div>
                            <form action="{{ url('/administrasi') }}" method="post" enctype="multipart/form-data">
                                @csrf
                            <div class="modal-body">
                                    <div class="row">
                                        <div class="col-md-12 col-12">
                                            <div class="form-group">
                                                <label for="first-name-column">Jenis Dokumen</label>
                                                <input type="text" class="form-control" id="juduldokumen" name="juduldokumen" readonly>
                                                <input type="hidden" class="form-control" name="tahunpelajaran_id" value="{{ $pembelajaran->tahunpelajaran_id }}">
                                                <input type="hidden" class="form-control" id="dokumenkurikulum_id" name="dokumenkurikulum_id">
                                                <input type="hidden" class="form-control" name="pembelajaran_id" value="{{ $pembelajaran->id }}">
                                            </div>
                                        </div>
                                        <div class="col-md-12 col-12">
                                            <div class="form-group">
                                                <label for="first-name-column">Keterangan</label>
                                                <input type="text" class="form-control" name="keterangan">
                                            </div>
                                        </div>
                                        <div class="col-md-12 col-12">
                                            <div class="form-group">
                                                <label for="first-name-column">Berkas</label>
                                                <input type="file" id="first-name-column" class="form-control"  name="dokumen_file">
                                            </div>
                                            <sup>Format Berkas : <span id="jenis"></span>, Max. <span id="ukuran"></span> Byte</sup>
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
        </div>
    </section>
    <!-- list group with contextual & horizontal ends -->
</div>

@endsection