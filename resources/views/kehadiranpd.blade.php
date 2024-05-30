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
                            @include('layouts.tabpd')
                            <div class="card-header">
                                <h1 class="card-title pl-1">
                                    Daftar Hadir Peserta Didik                                
                                    <hr>
                                </h1>
                            </div>
                            <div class="card">
                                <div class="card-body">
                                    <div class="table-responsive">
                                      <table class="table table-striped mb-0">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Tanggal</th>
                                                <th>Kehadiran</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                            $no = 1;
                                            $h = 0;
                                            $i = 0;
                                            $s = 0;
                                            $a = 0;
                                            @endphp
                                            @foreach($kehadirans as $kehadiran)
                                            <tr>
                                                <td class="align-top">{{ $no++ }}</td>
                                                <td>{{ $kehadiran->tanggal }}</td>
                                                <td>
                                                    @php
                                                    $kehadiran = App\Models\Kehadirandetail::where('kehadiran_id', $kehadiran->id)->where('user_id', auth()->user()->id)->first()->kehadiran;
                                                    if($kehadiran == 'H'){
                                                        $h++;
                                                    } else if($kehadiran == 'I'){
                                                        $i++;
                                                    } else if($kehadiran == 'S'){
                                                        $s++;
                                                    }else if($kehadiran == 'A'){
                                                        $a++;
                                                    }
                                                    echo $kehadiran
                                                    @endphp
                                                </td>
                                            </tr>
                                            @endforeach
                                            <tr>
                                                <td colspan="2"> Total </td>
                                                <td>
                                                    <table class="table">
                                                        <tr>
                                                            <th class="text-center">Keterangan</td>
                                                            <th class="text-center">Jumlah</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Hadir</td>
                                                            <td class="text-center">{{ $h }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Izin</td>
                                                            <td class="text-center">{{ $i }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Sakit</td>
                                                            <td class="text-center">{{ $s }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Tanpa Keterangan</td>
                                                            <td class="text-center">{{ $a }}</td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>
                                        </tbody>
                                      </table>
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