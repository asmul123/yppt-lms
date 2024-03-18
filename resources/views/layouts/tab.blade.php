<div class="list-group list-group-horizontal-sm mb-1 text-center" role="tablist">
    <a class="list-group-item list-group-item-action active" id="list-sunday-list"
     href="{{ url('/pembelajaran/'.$pembelajaran->id) }}" role="tab">Penugasan</a>
    <a class="list-group-item list-group-item-action" id="list-monday-list"
        href="{{ url('/pembelajaran/'.$pembelajaran->id."?tab=diskusi") }}" role="tab">Diskusi Kelas</a>
    <a class="list-group-item list-group-item-action" id="list-tuesday-list"
        href="{{ url('/pembelajaran/'.$pembelajaran->id."?tab=kehadiran") }}" role="tab">Kehadiran</a>
    <a class="list-group-item list-group-item-action" id="list-tuesday-list"
        href="{{ url('/pembelajaran/'.$pembelajaran->id."?tab=banksoal") }}" role="tab">Bank Soal</a>
    <a class="list-group-item list-group-item-action" id="list-tuesday-list"
        href="{{ url('/pembelajaran/'.$pembelajaran->id."?tab=administrasi") }}" role="tab">Administrasi</a>
</div>