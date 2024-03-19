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
                                <h1 class="card-title pl-1">Riwayat Diskusi</h1>
                            </div>

                            <div class="card border border-light">
                                <div class="card-body">
                                    <div class="card border border-light">
                                            <div class="card-header">
                                                <h3>Topik Baru</h3>                                              
                                            </div>
                                            <div class="card-body">
                                                <form id="form" method="get" action="{{ url('/diskusi') }}"  id="identifier">
                                                <div id="full">
                                                </div>
                                                <input type="hidden" name="komentar" id="hiddenInput">
                                                <link rel="stylesheet" href="{{ url('/assets/vendors/quill/quill.bubble.css') }}">
                                                <link rel="stylesheet" href="{{ url('/assets/vendors/quill/quill.snow.css') }}">                                   
                                                <script src="{{ url('/assets/vendors/quill/quill.min.js') }}"></script>
                                                <script src="{{ url('/assets/js/pages/form-editor.js') }}"></script>
                                                <hr>
                                                <input type="submit" class="btn btn-success btn-sm" value="Post">
                                                </form>
                                            </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card border border-light">
                                <div class="card-body text-center">
                                    Belum ada topik diskusi
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

@endsection