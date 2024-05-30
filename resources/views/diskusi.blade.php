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
                            @if(auth()->user()->role_id == 2)                                             
                            @include('layouts.tab')
                            @elseif (auth()->user()->role_id == 3)
                            @include('layouts.tabpd')
                            @endif
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
                                                <form id="form" method="post" action="{{ url('/diskusi') }}"  id="identifier">
                                                    @csrf
                                                    <div id="full"></div>
                                                    <input type="hidden" name="diskusi" id="hiddenInput">
                                                    <input type="hidden" name="pembelajaran_id" value="{{ $pembelajaran->id }}">
                                                    <input type="submit" class="btn btn-outline-primary mt-1" value="Post">
                                                </form>
                                            </div>
                                    </div>
                                </div>
                            </div>
                            @if($diskusis->count()!=0)
                                @foreach($diskusis as $diskusi)
                                    <div class="card border border-light">
                                        <div class="card-body">
                                            <strong>{{ $diskusi->user->name }}</strong>
                                            @if($diskusi->user_id == auth()->user()->id)
                                            <div class="btn-group float-right" role="group" aria-label="Basic example">
                                                <a href="javascript:void(0)" class="btn btn-sm btn-default border-0 icon" data-toggle="modal" data-target="#editModal" id="btn-edit-post" data-id="{{ $diskusi->id }}"><i data-feather="edit"></i></a><br>
                                                <form action="{{ url('diskusi/'.$diskusi->id) }}" method="POST">
                                                    @method('delete')
                                                    @csrf
                                                    <button class="btn btn-sm btn-default border-0 icon" type="submit" onclick="return confirm('Yakin akan menghapus data ini?')"><i data-feather="trash"></i></button><br>
                                                </form>
                                            </div>
                                            @endif
                                            <sup>diposting pada : {{ $diskusi->created_at }}</sup><hr>
                                            {!! $diskusi->diskusi !!}
                                            <hr>
                                            <div class="card-body">
                                                @php
                                                    $komens = App\Models\Tanggapan::where('diskusi_id', $diskusi->id)->orderBy('created_at', 'asc')->get();                                                    
                                                @endphp
                                                @if($komens->count()==0)
                                                    Belum ada tanggapan
                                                @else
                                                    @foreach($komens as $komen)
                                                    <strong>{{ $komen->user->name }}</strong> <sup>pada : {{ $komen->created_at }}</sup>                                                    
                                                    @if($komen->user_id == auth()->user()->id)
                                                    <div class="btn-group float-right" role="group" aria-label="Basic example">
                                                        <a href="javascript:void(0)" class="btn btn-sm btn-default border-0 icon" data-toggle="modal" data-target="#editTanggapan" id="btn-edit-tanggapan" data-id="{{ $komen->id }}"><i data-feather="edit"></i></a>
                                                        <form action="{{ url('tanggapan/'.$komen->id) }}" method="POST">
                                                            @method('delete')
                                                            @csrf
                                                            <button class="btn btn-sm btn-default border-0 icon" type="submit" onclick="return confirm('Yakin akan menghapus data ini?')"><i data-feather="trash"></i></button>
                                                        </form>
                                                    </div>
                                                    @endif
                                                    <br>
                                                    {!! $komen->tanggapan !!}
                                                    @endforeach
                                                @endif
                                                <hr>
                                                <form id="form{{ $diskusi->id }}" method="post" action="{{ url('/tanggapan') }}"  id="form-komen">
                                                    @csrf
                                                    <div id="komen{{ $diskusi->id }}"></div>
                                                    <input type="hidden" name="tanggapan" id="tanggapan{{ $diskusi->id }}">
                                                    <input type="hidden" name="diskusi_id" value="{{ $diskusi->id }}">
                                                    <input type="submit" class="btn btn-outline-primary float-right mt-1" value="Post">                                                    
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach                                    
                                    @else
                                    <div class="card border border-light">
                                        <div class="card-body text-center">
                                            Belum ada postingan saat ini
                                        </div>
                                    </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-12 col-md-12">
                
            </div>
        </div>
    </section>
    <!-- Edit Diskusi -->
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog"
    aria-labelledby="editModalTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-centered modal-dialog-scrollable"
            role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalTitle">Edit Postingan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i data-feather="x"></i>
                    </button>
                </div>
                <div class="modal-body">            
                    <form method="post" action="{{ url('/diskusi') }}" id="editdiskusiform">
                        @csrf
                        <div id="editDiskusi"></div>
                        <input type="hidden" name="diskusi" id="diskusidata">
                        <input type="hidden" name="diskusi_id" id="diskusiid">
                        <input type="submit" class="btn btn-outline-primary mt-1" value="Simpan">
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Edit Tanggapan -->
    <div class="modal fade" id="editTanggapan" tabindex="-1" role="dialog" aria-labelledby="editTanggapanTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-centered modal-dialog-scrollable"
            role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalTitle">Edit Tanggapan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i data-feather="x"></i>
                    </button>
                </div>
                <div class="modal-body">            
                    <form method="post" action="{{ url('/tanggapan') }}" id="edittanggapanform">
                        @csrf
                        <div id="editTanggapanf"></div>
                        <input type="hidden" name="tanggapan" id="tanggapandata">
                        <input type="hidden" name="tanggapan_id" id="tanggapanid">
                        <input type="submit" class="btn btn-outline-primary mt-1" value="Simpan">
                    </form>
                </div>
            </div>
        </div>
    </div>
    <link rel="stylesheet" href="{{ url('/assets/vendors/quill/quill.bubble.css') }}">
    <link rel="stylesheet" href="{{ url('/assets/vendors/quill/quill.snow.css') }}">                                   
    <script src="{{ url('/assets/vendors/quill/quill.min.js') }}"></script>
    <script src="{{ url('/assets/js/pages/form-editor.js') }}"></script>
    <script>
        var snow = new Quill("#snow", {
            theme: "snow",
        });
        var bubble = new Quill("#bubble", {
            theme: "bubble",
        });
        @foreach($diskusis as $d)

        var quillkom{{ $d->id }} = new Quill("#komen{{ $d->id }}", {
            bounds: "#komen{{ $d->id }}-container .editor",
            modules: {
                toolbar: [
                    [{ font: [] }, { size: [] }],
                    ["bold", "italic", "underline", "strike"],
                    [{ color: [] }, { background: [] }],
                    [{ script: "super" }, { script: "sub" }],
                    [
                        { list: "ordered" },
                        { list: "bullet" },
                        { indent: "-1" },
                        { indent: "+1" },
                    ],
                    ["direction", { align: [] }],
                    ["link", "image", "video"],
                    ["clean"],
                ],
            },
            placeholder: "Tulis Tanggapan",
            theme: "snow",
            });                                                                                                            
                var form{{ $d->id }} = document.querySelector("form{{ $d->id }}");
                var tanggapan{{ $d->id }} = document.querySelector("#tanggapan{{ $d->id }}");

                document.getElementById("form{{ $d->id }}").onsubmit = function () {
                    tanggapan{{ $d->id }}.value = quillkom{{ $d->id }}.root.innerHTML;
                }
        @endforeach
    </script>
        <script>
        //button create post event        
                    var snow = new Quill("#snow", {
                    theme: "snow",
                    });
                    var bubble = new Quill("#bubble", {
                        theme: "bubble",
                    });
                    var quilltedit = new Quill("#editTanggapanf", {
                        bounds: "#editTanggapanf-container .editor",
                        modules: {
                            toolbar: [
                                [{ font: [] }, { size: [] }],
                                ["bold", "italic", "underline", "strike"],
                                [{ color: [] }, { background: [] }],
                                [{ script: "super" }, { script: "sub" }],
                                [
                                    { list: "ordered" },
                                    { list: "bullet" },
                                    { indent: "-1" },
                                    { indent: "+1" },
                                ],
                                ["direction", { align: [] }],
                                ["link", "image", "video"],
                                ["clean"],
                            ],
                        },
                        placeholder: "Edit Tanggapan",
                        theme: "snow",
                        });
                        var edittanggapanform = document.querySelector("edittanggapanform");
                        var isitanggapan = document.querySelector("#tanggapandata");
                        
                        document.getElementById("edittanggapanform").onsubmit = function () {
                            isitanggapan.value = quilltedit.root.innerHTML;
                        }
                        
        $('body').on('click', '#btn-edit-tanggapan', function () {
                let tanggapan_id = $(this).data('id');
                
                //fetch detail tanggapan with ajax
                $.ajax({
                    url: "{{ url('/tanggapan') }}/"+tanggapan_id,
                    type: "GET",
                    cache: false,
                    success:function(response){
                        
                        //fill data to form
                        
                        quilltedit.clipboard.dangerouslyPasteHTML(response.data.tanggapan);
                        $('#tanggapanid').val(response.data.id);
                    }
                });
        });
    </script>
        <script>
        //button create post event        
                    var snow = new Quill("#snow", {
                    theme: "snow",
                    });
                    var bubble = new Quill("#bubble", {
                        theme: "bubble",
                    });
                    var quilledit = new Quill("#editDiskusi", {
                        bounds: "#editDiskusi-container .editor",
                        modules: {
                            toolbar: [
                                [{ font: [] }, { size: [] }],
                                ["bold", "italic", "underline", "strike"],
                                [{ color: [] }, { background: [] }],
                                [{ script: "super" }, { script: "sub" }],
                                [
                                    { list: "ordered" },
                                    { list: "bullet" },
                                    { indent: "-1" },
                                    { indent: "+1" },
                                ],
                                ["direction", { align: [] }],
                                ["link", "image", "video"],
                                ["clean"],
                            ],
                        },
                        placeholder: "Edit Diskusi",
                        theme: "snow",
                        });
                        var editdiskusiform = document.querySelector("editdiskusiform");
                        var isidiskusi = document.querySelector("#diskusidata");
                        
                        document.getElementById("editdiskusiform").onsubmit = function () {
                            isidiskusi.value = quilledit.root.innerHTML;
                        }
                        
        $('body').on('click', '#btn-edit-post', function () {
                let post_id = $(this).data('id');
                
                //fetch detail post with ajax
                $.ajax({
                    url: "{{ url('/diskusi') }}/"+post_id,
                    type: "GET",
                    cache: false,
                    success:function(response){
                        
                        //fill data to form
                        
                        quilledit.clipboard.dangerouslyPasteHTML(response.data.diskusi);
                        $('#diskusiid').val(response.data.id);
                    }
                });
        });
    </script>
    
    @endsection