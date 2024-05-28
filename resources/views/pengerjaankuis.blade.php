@extends('layouts.main')

@section('content')


<div class="main-content container-fluid">
    <section class="section">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-6">                                
                                Soal No : <button class="btn btn-outline-primary">{{ $nosoal }}</button>
                            </div>
                            <div class="col-6 d-flex flex-row-reverse">
                                <button type="button" class="btn btn-outline-primary">02:00:00</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @php
        $es = explode('(_#_)', $pengerjaan->rekaman);
        $akhir = count($es);
        $ia = explode('(-)', $es[$nosoal]);
        $jmluraian = count($ia);
        $soal = App\Models\Soal::where('id', $ia[0])->first();
        $jw = explode('[#_#]', $soal->jawaban);
    @endphp    
    <form action="{{ url('penugasanpd/'.$penugasan->id.'/edit') }}" method="GET">
    <section class="section">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">                        
                        <input type="hidden" name="soal" value="{{ $ia[0] }}">
                        <input type="hidden" name="nosoal" value="{{ $nosoal }}">
                        <h4 class="card-title">{!! $soal->soal !!}</h4>
                    </div>
                    <div class="card-body">
                        @php
                        for ($i = 0; $i <= 5; $i++) {
                            if($jw[$i]!=""){
                                $isiop = explode("[_#_]", $jw[$i]);
                        @endphp
                        <div class="form-check form-check-success">
                            <input class="form-check-input" type="radio" name="opsi" value="{{ $isiop[0] }}" {{ ($isiop[0] == $ia[1]) ? "checked" : false }}>
                            <label class="form-check-label" for="Success">
                                {!! $isiop[1] !!}
                            </label>
                        </div>
                        @php                        
                            }
                        } 
                        @endphp
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-6">
                                <button type="submit" class="btn icon icon-left btn-primary" value="{{ $nosoal-1 }}" name="no" {{ ($nosoal==1) ? "disabled" : false }}><i data-feather="arrow-left"></i> Sebelumnya</button>
                            </div>
                            <div class="col-6 d-flex flex-row-reverse">
                                @if($nosoal==(count($es)-1))
                                <button type="submit" class="btn icon icon-right btn-danger" value="akhir" name="no" onclick="return confirm('Yakin akan mengakhiri kuis ini?')">Akhiri <i data-feather="check-square"></i></button>
                                @else
                                <button type="submit" class="btn icon icon-right btn-primary" value="{{ $nosoal+1 }}" name="no">Selanjutnya <i data-feather="arrow-right"></i></button>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="section">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body d-flex justify-content-center">
                        <button type="button" class="btn icon icon-left btn-success" data-toggle="modal"
                        data-target="#exampleModalCenter"><i data-feather="grid"></i> Daftar Soal</button>
                    <!-- Vertically Centered modal Modal -->
                        <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
                        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-dialog-centered modal-dialog-scrollable"
                            role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalCenterTitle">Daftar Soal</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <i data-feather="x"></i>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <table width="100%" cellpadding="4" cellspacing="4">
                                        <tr>
                                            @php
                                            for ($i = 1; $i < count($es); $i++) {
                                                $cia = explode('(-)', $es[$i]);
                                                $btn = "light";
                                                if ($nosoal == $i) {
                                                    $btn = "info";
                                                } else if ($cia[1] != 0) {
                                                    $btn = "success";
                                                }
                                            @endphp
                                                <td>
                                                    <button type="submit" name="no" value="<?= $i ?>" class="btn btn-<?= $btn ?> btn-xs btn-block"><?= $i ?></button>
                                                </td>
                                                @php
                                                if ($i % 5 == 0) {
                                                    echo "</tr><tr>";
                                                }
                                            } 
                                            @endphp
                                        </tr>
                                    </table>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">
                                    <i class="bx bx-x d-block d-sm-none"></i>
                                    <span class="d-none d-sm-block">Tutup</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    </form>
</div>
@endsection