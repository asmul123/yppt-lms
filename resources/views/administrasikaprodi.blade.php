@extends('layouts.main')

@section('content')


<div class="main-content container-fluid">
    <div class="page-title">
        <h3>Daftar Administrasi Kaprodi</h3>
    </div>
    <section class="section">
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
                    <div class="card-header">
                        <h1 class="card-title pl-1">Daftar Administrasi Pembelajaran</h1>
                    </div>
                    <table class="table table-striped mb-0">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Jenis Dokumen</th>
                                    <th>Format File</th>
                                    <th>Jumlah Dokumen</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $i = 'a';
                                @endphp
                                @foreach($dokumenkaprodis as $dokumenkaprodi)
                                <tr>
                                    <td>{{ $dokumenkaprodis->firstItem() + $loop->index }}</td>
                                    <td>{{ $dokumenkaprodi->juduldokumen }}</td>
                                    <td>{{ $dokumenkaprodi->jenisdokumen }}</td>
                                    <td>{{  App\Models\Administrasikaprodi::where('dokumenkaprodi_id', $dokumenkaprodi->id)->where('user_id',auth()->user()->id)->count() }}</td>
                                    <td>
                                        <div class="btn-group mb-3" role="group" aria-label="Basic example">
                                            <a href="{{ url('/administrasikaprodi/'.$dokumenkaprodi->id.'/edit') }}" class="badge bg-info"><i data-feather="list"></i> Lihat</a>
                                            <a href="#" class="badge bg-primary" data-toggle="modal" data-target="#unggah" onclick="apData{{ $i }}()"><i data-feather="upload"></i> Unggah</a>
                                            <script>
                                                function apData{{ $i }}() {
                                                    let judul{{ $i }} = "{{ $dokumenkaprodi->juduldokumen }}";
                                                    let dokumen{{ $i }} = "{{ $dokumenkaprodi->id }}";
                                                    let jenis{{ $i }} = "{{ $dokumenkaprodi->jenisdokumen }}";
                                                    let ukuran{{ $i }} = "{{ $dokumenkaprodi->ukurandokumen }}";

                                                    document.getElementById("juduldokumen").value = judul{{ $i }};
                                                    document.getElementById("dokumenkaprodi_id").value = dokumen{{ $i }};
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
                                {{ $dokumenkaprodis->links() }}
                            </div>
                          </div>
                        </div>
                </div>
            </div>
        </div>
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
                    <form action="{{ url('/administrasikaprodi') }}" method="post" enctype="multipart/form-data">
                        @csrf
                    <div class="modal-body">
                            <div class="row">
                                <div class="col-md-12 col-12">
                                    <div class="form-group">
                                        <label for="first-name-column">Jenis Dokumen</label>
                                        <input type="text" class="form-control" id="juduldokumen" name="juduldokumen" readonly>
                                        <input type="hidden" class="form-control" name="tahunpelajaran_id" value="{{ $tapel_id }}">
                                        <input type="hidden" class="form-control" id="dokumenkaprodi_id" name="dokumenkaprodi_id">
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
    </section>
</div>

@endsection