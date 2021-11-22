@extends("master")

@section("title", "Tambah Transaksi")

@section("content")
<form method="POST">
    @csrf
    Nama Pelanggan : <input type="text" name="nama"> <br/>
    Tanggal : <input type="date" name="tanggal"> <br/>
    <hr>
    <select id="selectBarang">
    @foreach ($dataBarang as $b)
        <option value="{{ $b["id"] }}" harga="{{ $b["harga"] }}">
            {{ $b["nama"] }}
        </option>
    @endforeach
    </select>
    <button type=button id=btnTambah>Tambah Barang</button>
    <table id="tableDetail" border=1>
        <tr><th>ID</th><th>Nama</th><th>Jumlah</th>
            <th>Harga</th><th>Total</th><th>Action</th></tr>
    </table>
    <br/>
    <br/>
    <label><b>Voucher</b><label></br>
    <select name="voucher" id="voucher">
        <option disabled selected value tipe=0 jumlah=0>Tidak ada</option>
        @foreach ($dataVoucher as $v)
        <option value="{{ $v->id_voucher }}" tipe="{{ $v->tipe_voucher }}"
            jumlah="{{ $v->jumlah_diskon }}"
            >{{ $v->nama_voucher }}</option>
        @endforeach
    </select>
    <h4>Diskon : Rp.<span id="txtDiskon">0</span></h4>
    <h4>Total : Rp.<span id="txtTotal">0</span></h4>
    <button type="submit">Simpan Transaksi</button>
</form>

<script src="{{ url("/js/transaksi.js") }}"></script>
@endsection
