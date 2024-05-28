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
    <form action="{{ url('pengerjaan') }}" method="POST">
        @csrf
        <section class="section">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">{!! $penugasan->deskripsitugas !!}</h4>
                        </div>
                        <div class="card-body">
                            <div id="full">
                            </div>
                            <input type="hidden" name="penugasan_id" value="{{ $penugasan->id }}">
                            <input type="hidden" name="pembelajaran_id" value="{{ $penugasan->pembelajaran_id }}">
                            <textarea class="rekaman" name="rekaman" class="form-control"></textarea>
                                                                                  
                            <script type="text/javascript">
                                
                                $(document).ready(function() {
                                    $('.rekaman').summernote({
                                        placeholder: 'Tuliskan Jawaban',
                                        tabsize: 1,
                                        height: 150
                                    });
                                });
                            </script>
                            <hr>
                            <input type="submit" class="btn btn-primary btn-sm" value="Kirim">
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </form>
</div>
@endsection