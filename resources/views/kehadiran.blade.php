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
                    <div class="card-content">
                        <div class="card-body">                                                      
                            @include('layouts.tab')
                            <div class="card-header">
                                <h1 class="card-title pl-1">
                                    Daftar Hadir Peserta Didik                                
                                    <hr>
                                </h1>
                            </div>
                            <div class="card">
                                <div class="card-header">                                    
                                    <a href="#" class="btn icon icon-left btn-primary" data-toggle="modal" data-target="#tambah-kehadiran"><i data-feather="plus"></i> Tambah Kehadiran</a>
                                    <!--BorderLess Modal Modal -->
                                    <div class="modal fade text-left modal-borderless" id="tambah-kehadiran" tabindex="-1" role="dialog" aria-labelledby="modalTambah" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-scrollable modal-full" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Tambah Kehadiran</h5>
                                                    <button type="button" class="close rounded-pill" data-dismiss="modal" aria-label="Close">
                                                    <i data-feather="x"></i>
                                                    </button>
                                                </div>
                                                <form action="{{ url('/kehadiran') }}" method="post">
                                                    @csrf
                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <div class="col-md-12 col-12">
                                                                <div class="form-group">
                                                                    <label for="first-name-column">Keterangan</label>
                                                                    <input type="text" class="form-control"  name="keterangan" autofocus>
                                                                    <input type="hidden" class="form-control"  name="pembelajaran_id" value="{{ $pembelajaran->id }}">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12 col-12">
                                                                <div class="form-group">
                                                                    <label for="first-name-column">Tanggal</label>
                                                                    <input type="date" class="form-control"  name="tanggal" value="{{ date('Y-m-d') }}">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12 col-12">
                                                                <table class="table table-striped mb-0">
                                                                    <thead>
                                                                        <tr>
                                                                            <th rowspan="2">#</th>
                                                                            <th rowspan="2">Nama Peserta Didik</th>
                                                                            <th colspan="4">Kehadiran</th>
                                                                        </tr>
                                                                        <tr>
                                                                            <th>H</th>
                                                                            <th>S</th>
                                                                            <th>I</th>
                                                                            <th>A</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        @foreach($kehadirans as $kehadiran)
                                                                        <tr>
                                                                            <td class="align-top">{{ $loop->iteration }}</td>
                                                                            <td>{{ $kehadiran->user->name }}</td>
                                                                            <td><input type="radio" class="form-check-input form-check-success" name="kehadiran{{ $kehadiran->id }}" value="H" checked></td>
                                                                            <td><input type="radio" class="form-check-input form-check-primary" name="kehadiran{{ $kehadiran->id }}" value="S"></td>
                                                                            <td><input type="radio" class="form-check-input form-check-warning" name="kehadiran{{ $kehadiran->id }}" value="I"></td>
                                                                            <td><input type="radio" class="form-check-input form-check-danger" name="kehadiran{{ $kehadiran->id }}" value="A"></td>
                                                                        </tr>
                                                                        @endforeach
                                                                    </tbody>
                                                                  </table>
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
                                      <table class="table table-striped mb-0">
                                        <thead>
                                            <tr>
                                                <th rowspan="2">#</th>
                                                <th rowspan="2">Nama Peserta Didik</th>
                                                @php
                                                    $detailkehadirans = App\Models\Kehadiran::where('pembelajaran_id', $pembelajaran->id)->orderBy('tanggal','asc')->get();
                                                    $jml = $detailkehadirans->count();
                                                @endphp
                                                <th colspan="{{ $jml }}" class="collapse" id="collapseExample">Kehadiran</th>
                                                <th colspan="4"><a data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample"><i data-feather="menu"></i> Total</a></th>
                                            </tr>
                                            <tr>
                                                @foreach($detailkehadirans as $dk)
                                                <th class="text-center collapse" id="collapseExample">
                                                    @php
                                                    $tgl = strtotime($dk->tanggal);
                                                    @endphp
                                                    <a data-toggle="tooltip" data-placement="bottom" title="{{ $dk->keterangan }}">
                                                    {{ date('d/m',$tgl) }}</a><br>
                                                    <div class="btn-group float-right" role="group" aria-label="Basic example">
                                                        <a href="javascript:void(0)" class="btn btn-default btn-sm border-0" data-toggle="modal" data-target="#edit-kehadiran" id="btn-edit-kehadiran" data-id="{{ $dk->id }}"><i data-feather="edit"></i></a>
                                                        <form action="{{ url('kehadiran/'.$dk->id) }}" method="POST">
                                                            @method('delete')
                                                            @csrf
                                                            <button class="btn btn-default btn-sm border-0" type="submit" onclick="return confirm('Yakin akan menghapus data ini?')"><i data-feather="trash"></i></button>
                                                        </form>
                                                    </div>
                                                    
                                                </th>
                                                @endforeach
                                                <th>H</th>
                                                <th>I</th>
                                                <th>S</th>
                                                <th>A</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($anggotarombels as $anggotarombel)
                                            @php
                                            $h = 0;
                                            $i = 0;
                                            $s = 0;
                                            $a = 0;
                                            @endphp
                                            <tr>
                                                <td class="align-top">{{ $anggotarombels->firstItem() + $loop->index }}</td>
                                                <td>{{ $anggotarombel->user->name }}</td>
                                                @foreach($detailkehadirans as $dk)
                                                <td class="text-center collapse" id="collapseExample">
                                                    @php
                                                    $kehadiran = App\Models\Kehadirandetail::where('kehadiran_id', $dk->id)->where('user_id', $anggotarombel->user_id)->first()->kehadiran;
                                                    if($kehadiran == 'H'){
                                                        $class="success";
                                                        $h++;
                                                    } else if($kehadiran == 'I'){
                                                        $class="warning";
                                                        $i++;
                                                    } else if($kehadiran == 'S'){
                                                        $class="primary";
                                                        $s++;
                                                    }else if($kehadiran == 'A'){
                                                        $class="danger";
                                                        $a++;
                                                    }
                                                    echo "<button class='badge bg-".$class." border-0'>".$kehadiran."</button>";
                                                    @endphp
                                                </td>
                                                @endforeach
                                                <td>{{ $h }}</td>
                                                <td>{{ $i }}</td>
                                                <td>{{ $s }}</td>
                                                <td>{{ $a }}</td>
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
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-12 col-md-12">
                
            </div>
        </div>
    </section>
    <div class="modal fade text-left modal-borderless" id="edit-kehadiran" tabindex="-1" role="dialog" aria-labelledby="modalTambah" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-full" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Kehadiran</h5>
                    <button type="button" class="close rounded-pill" data-dismiss="modal" aria-label="Close">
                    <i data-feather="x"></i>
                    </button>
                </div>
                <form action="{{ url('/kehadiran') }}" method="post">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12 col-12">
                                <div class="form-group">
                                    <label for="first-name-column">Keterangan</label>
                                    <input type="text" class="form-control" id="ketedit" name="keterangan" autofocus>
                                    <input type="hidden" id="idedit" name="kehadiran_id">
                                </div>
                            </div>
                            <div class="col-md-12 col-12">
                                <div class="form-group">
                                    <label for="first-name-column">Tanggal</label>
                                    <input type="date" class="form-control" id="tgledit" name="tanggal" value="{{ date('Y-m-d') }}">
                                </div>
                            </div>
                            <div class="col-md-12 col-12">
                                <table class="table table-striped mb-0">
                                    <thead>
                                        <tr>
                                            <th rowspan="2">#</th>
                                            <th rowspan="2">Nama Peserta Didik</th>
                                            <th colspan="4">Kehadiran</th>
                                        </tr>
                                        <tr>
                                            <th>H</th>
                                            <th>S</th>
                                            <th>I</th>
                                            <th>A</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($kehadirans as $kehadiran)
                                        <tr>
                                            <td class="align-top">{{ $loop->iteration }}</td>
                                            <td>{{ $kehadiran->user->name }}</td>
                                            <td><input type="radio" id="h{{ $kehadiran->user_id }}edit" class="form-check-input form-check-success" name="kehadiran{{ $kehadiran->id }}" value="H"></td>
                                            <td><input type="radio" id="s{{ $kehadiran->user_id }}edit" class="form-check-input form-check-primary" name="kehadiran{{ $kehadiran->id }}" value="S"></td>
                                            <td><input type="radio" id="i{{ $kehadiran->user_id }}edit" class="form-check-input form-check-warning" name="kehadiran{{ $kehadiran->id }}" value="I"></td>
                                            <td><input type="radio" id="a{{ $kehadiran->user_id }}edit" class="form-check-input form-check-danger" name="kehadiran{{ $kehadiran->id }}" value="A"></td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                  </table>
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
    <!-- list group with contextual & horizontal ends -->
    <script>
        $(function () {
        $('[data-toggle="tooltip"]').tooltip()
        })
    </script>
    <script>
        $('body').on('click', '#btn-edit-kehadiran', function () {
                let kehadiran_id = $(this).data('id');
                
                //fetch detail tanggapan with ajax
                $.ajax({
                    url: "{{ url('/kehadiran') }}/"+kehadiran_id,
                    type: "GET",
                    cache: false,
                    success:function(response){
                        $('#ketedit').val(response.data.keterangan);
                        $('#tgledit').val(response.data.tanggal);
                        $('#idedit').val(response.data.id);
                        const obj = response.detail;
                        for (i=0; i<obj.length; i++) {
                            for(let key in obj[i]){
                                if(obj[i]['kehadiran']=='H'){
                                    document.getElementById('h'+obj[i]['user_id']+'edit').checked = true;
                                } else if(obj[i]['kehadiran']=='I'){
                                    document.getElementById('i'+obj[i]['user_id']+'edit').checked = true;
                                } else if(obj[i]['kehadiran']=='S'){
                                    document.getElementById('s'+obj[i]['user_id']+'edit').checked = true;
                                } else if(obj[i]['kehadiran']=='A'){
                                    document.getElementById('a'+obj[i]['user_id']+'edit').checked = true;
                                }
                            }
                        }
                    }
                });
        });
    </script>
@endsection