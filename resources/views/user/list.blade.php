@extends("master")

@section("title", "List User")

@section("content")
<a href="{{ url("/master/user/tambah") }}">(+) Buat User</a> <br/><br/>
<table border=1>
    <tr>
        <th>ID</th><th>Username</th>
        <th>Create At</th><th>Update At</th><th>Action</th>
    </tr>
    @if (count($data) > 0)
        @foreach ($data as $d)
        <tr>
            <th>{{ $d->id }}</th>
            <th>{{ $d->user }}</th>
            <th>{{ $d->created_at }}</th>
            <th>{{ $d->updated_at }}</th>
            <th><a href="{{ url("/master/user/".$d->id) }}">Ubah</a>
                <button type="button" class="btnDelete"
                id="{{ $d->id }}">Delete</button></th>
        </tr>
        @endforeach
    @else
        <tr><td colspan="5">Tidak ada data ditemukan</td></tr>
    @endif
</table>
<script>
var del = document.getElementsByClassName("btnDelete");
for (let i = 0; i < del.length; i++) {
    // del[i].attributes.getNamedItem("id").value;
    del[i].onclick = function(e) {
        let result = confirm("Apakah mau hapus user?");
        if (result == false) return;
        let btn = e.target;
        let id = btn.attributes.getNamedItem("id").value;
        let form = new FormData();
        form.append("_token", "{{ csrf_token() }}");
        form.append("_method", "DELETE");
        var request = new XMLHttpRequest();
        request.open("POST", "{{ url('/master/user/') }}/"+id);
        request.onload = function(e) {
            if (request.status == 200) {
                window.location.reload();
            }
        }

        request.send(form);
    }
}
</script>
@endsection
