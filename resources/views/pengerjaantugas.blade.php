@extends('layouts.main')

@section('content')

<script src="https://www.youtube.com/iframe_api"></script>

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
                        <div id="pemutar"></div>
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
                            <a href="{{ url('pengerjaan') }}" class="btn btn-warning btn-sm">Batal</a>
                            <input type="submit" class="btn btn-primary btn-sm" value="Kirim" id="myButton" disabled>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </form>
</div>
@if($penugasan->youtube != "")
@php
$url = $penugasan->youtube;
preg_match('/(?:\/|=)(.{11})(?:$|&|\?)/', $url, $matches);
@endphp
<script>
    var player;
  
    function onYouTubeIframeAPIReady() {
      player = new YT.Player("pemutar", {
        height: "360",
        width: "640",
        videoId: "{{ $matches[1] }}", // Ganti VIDEO_ID dengan ID video YouTube yang ingin dimainkan
        playerVars: {
          controls: 0, // Sembunyikan kontrol video
          disablekb: 1, // Nonaktifkan tombol keyboard
          modestbranding: 1, // Sembunyikan logo YouTube
          playsinline: 1, // Putar video di dalam iframe
        },
        events: {
          onReady: onPlayerReady,
          onStateChange: onPlayerStateChange,
        },
      });
    }
  
    function onPlayerReady(event) {
      event.target.playVideo();
    }
  
    // Fungsi ini akan dipanggil saat status pemutaran berubah
    function onPlayerStateChange(event) {
      if (event.data == YT.PlayerState.ENDED) {
        // Ketika video selesai diputar
        var myButton = document.getElementById("myButton");
        // Menonaktifkan tombol
        myButton.disabled = false;
        // Tambahkan tindakan di sini untuk mendeteksi bahwa video telah selesai diputar
      }
    }
  </script>
  <script>
    document.addEventListener("DOMContentLoaded", function () {
      var iframe = document.querySelector("iframe");
      iframe.setAttribute("allow", "autoplay; encrypted-media");
  
      iframe.addEventListener("load", function () {
        var doc = iframe.contentDocument || iframe.contentWindow.document;
        var script = doc.createElement("script");
        script.src = "https://www.youtube.com/iframe_api";
        doc.head.appendChild(script);
  
        var style = doc.createElement("style");
        style.innerHTML =
          ".ytp-chrome-top{display:none !important;} .ytp-chrome-bottom{display:none !important;}";
        doc.head.appendChild(style);
      });
    });
  </script>
  <script>
    function refreshPage() {
      window.location.reload();
    }
  
    // Tambahkan event listener untuk event 'visibilitychange'
    document.addEventListener("visibilitychange", function () {
      if (document.visibilityState === "hidden") {
        // Jika halaman tidak terlihat (pengguna berpindah tab atau meninggalkan halaman)
        refreshPage(); // Segarkan halaman
      }
    });
  
    // Tambahkan event listener untuk event 'beforeunload'
    window.addEventListener("beforeunload", function (event) {
      // Jika pengguna meninggalkan halaman, tampilkan pesan konfirmasi
      event.preventDefault();
      event.returnValue = "";
      refreshPage(); // Segarkan halaman
    });
  </script>
  @endif
@endsection