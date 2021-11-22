<?php

namespace App\Http\Controllers;

use App\Models\DetailTransaksi;
use App\Models\Transaksi;
use App\Models\Voucher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class TransaksiController extends Controller
{
    public function index() {
        $dataTrans = Transaksi::orderByDesc("tanggal_transaksi")
                    ->get();
        // dd(Session::get("transaksi"));
        return view("transaksi.list", [
            "user" => "Saya",
            "data" => $dataTrans
        ]);
    }

    public function formTambah(Request $request) {
        $data = json_decode($request->cookie("data") ?? "[]", true);
        $voucher = Voucher::get();
        return view("transaksi.tambah", [
            "user" => "Saya",
            "dataBarang" => $data,
            "dataVoucher" => $voucher
        ]);
    }

    public function tambahDataBack(Request $request) {
        // Validasi data!
        $request->validate([
            "nama" => "required|string",
            "tanggal" => "required|date",
            "id" => "array",
            "jumlah" => "array|required"
        ]);

        $ids = $request->input("id");
        $jumlahs = $request->input("jumlah");
        $detail = [];

        for ($i=0; $i < count($ids); $i++) {
            $detail[] = [ "id" => $ids[$i], "jumlah" => $jumlahs[$i]];
        }

        $newData = [
            "nama" => $request->input("nama"),
            "tanggal" => $request->input("tanggal"),
            "detail" => $detail
        ];

        $data = Session::get("transaksi") ?? [];
        $data[] = $newData;
        Session::put("transaksi", $data);
        return redirect()->back()->with("success", "Berhasil tambah trans!");
    }

    public function tambahData(Request $request) {
        // Validasi data!
        $request->validate([
            "nama" => "required|string",
            "tanggal" => "required|date",
            "id" => "array",
            "jumlah" => "array|required"
        ]);

        DB::beginTransaction();
        $ids = $request->input("id");
        $jumlahs = $request->input("jumlah");
        $hargas = $request->input("harga");
        // lakukan Begin Trans sebelum Query
        $header = new Transaksi();
        $header->nama_pelanggan = $request->input("nama");
        $header->tanggal_transaksi = $request->input("tanggal");
        $header->voucher = $request->input("voucher");
        $header->total_diskon = $request->input("potongan");
        $header->total_akhir = $request->input("total");
        $result = $header->save();

        foreach ($ids as $key => $i) {
            $detail = new DetailTransaksi();
            // Ini karena sudah save, id nya ada
            $detail->id_trans = $header->id_trans;
            $detail->id_barang = $i; $detail->harga = $hargas[$key];
            $detail->jumlah = $jumlahs[$key];
            $detail->subtotal = $jumlahs[$key] * $hargas[$key];
            $result = $result && $detail->save();
            if ($result == false) {
                DB::rollBack();
                abort(400, "Ada Transaksi yang gagal simpan!");
            }
        }

        DB::commit();

        return redirect("/master/transaksi")
            ->with("success", "Berhasil Tambah Transaksi");
    }
}
