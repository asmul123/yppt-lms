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
                    </div>
                    <div class="card-content">
                        <div class="card-body">                                                      
                            @include('layouts.tab')
                            <div class="card-header">
                                <h1 class="card-title pl-1">
                                    Daftar Pekerjaan
                                </h1>
                            </div>
                            <div class="card">
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
                                                <th>#</th>
                                                <th>Soal</th>
                                                <th>Keterangan</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if($penugasan->jenispenugasan_id == 1)
                                            @php
                                                $betul = 0;
                                                $rt = explode("(_#_)", $pengerjaan->rekaman);
                                                $jml_soal = count($rt) - 1;
                                                for ($i = 1; $i < count($rt); $i++) {
                                                    $ia = explode('(-)', $rt[$i]);
                                                    $jmluraian = count($ia);
                                                    $soal = App\Models\Soal::where('id', $ia[0])->first();
                                                    $jw = explode('[#_#]', $soal->jawaban);
                                            @endphp
                                            <tr>
                                                <td class="align-top">{{ $i }}</td>
                                                <td>
                                                    Soal :<br>
                                                    {!! $soal->soal !!}<hr>
                                                    <ol type="A">
                                                        @php
                                                        $op = explode("[#_#]", $soal->jawaban);                                                        
                                                        $jmlop = count($op);
                                                        for ($j = 0; $j < $jmlop; $j++) {
                                                            if($op[$j]!=""){
                                                                $isiop = explode("[_#_]", $op[$j]);
                                                                echo "<li>" . $isiop[1];
                                                                echo "</li>";
                                                            }
                                                        }
                                                        if($ia[1]==0){
                                                            $jawaban = "Tidak Menjawab";
                                                        } else {
                                                            $jawaban = $ia[1];
                                                        }
                                                        @endphp
                                                    </ol>
                                                    {{ 'Jawaban : '.$jawaban }}<br>
                                                    {{ 'Kunci : '.$soal->kunci }}
                                                </td>
                                                <td>
                                                    @php
                                                    if ($soal->kunci == $ia[1]) {
                                                        $betul++;
                                                        echo "<button class='badge icon bg-success border-0'>Jawaban Benar</button>";
                                                    } else {
                                                        echo "<button class='badge icon bg-danger border-0'>Jawaban Salah</button>";
                                                    }
                                                    @endphp                                                  
                                                </td>
                                            </tr>
                                            @php
                                                }
                                            @endphp
                                            <tr>
                                                <td colspan="3">
                                                    <form action="{{ url('pengerjaan/'.$pengerjaan->id) }}" method="post">
                                                        @csrf
                                                        @method('put')
                                                    Jumlah Benar : {{ $betul }}<br>
                                                    Nilai Saat ini : {{ number_format($pengerjaan->nilai,2) }}<br>
                                                    Ubah Nilai : <input type="text" name="nilai" autofocus required size="8">
                                                    <button type="submit" class="badge bg-primary border-0">Simpan</button>
                                                    </form>
                                                </td>
                                            </tr>
                                            @else
                                            <tr>
                                                <td>1</td>
                                                <td>
                                                    Soal :<br>
                                                    {!! $penugasan->deskripsitugas !!}
                                                    <hr>
                                                    Jawaban :<br>
                                                    {!! $pengerjaan->rekaman !!}
                                                </td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <td colspan="3">
                                                    <form action="{{ url('pengerjaan/'.$pengerjaan->id) }}" method="post">
                                                        @csrf
                                                        @method('put')
                                                    Nilai Saat ini : {{ number_format($pengerjaan->nilai,2) }}<br>
                                                    Ubah Nilai : <input type="text" name="nilai" autofocus required size="8">
                                                    <button type="submit" class="badge bg-primary border-0">Simpan</button>
                                                    </form>
                                                </td>
                                            </tr>
                                            @endif
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