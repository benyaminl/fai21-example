<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// Ini untuk DB Facade! SEPERTI IMPORT DI JAVA!
use Illuminate\Support\Facades\DB;

class VoucherController extends Controller
{
    public function list() {
        $dataVoucher = DB::select('select * from voucher');
        return view("voucher.index", [
            "data" => $dataVoucher,
            "user" => "saya"
        ]);
    }

    public function formTambah() {
        return view("voucher.tambah", [
            "user" => "saya",
        ]);
    }

    public function formUpdate($id) {
        // dd($id);
        $data = DB::table('voucher')->find($id);
        // $data = DB::table('voucher')
        //     ->where("id_voucher", "=" , $id)->get();

        // dd($data);
        if ($data == null) return redirect('/voucher/not-found');
        // Literrally sama dengan yang di bawah!
        // $data = DB::select('select * from voucher where id = ?', [$id])[0];
        return view("voucher.update", [
            "user" => "saya",
            "d" =>$data
        ]);
    }

    public function formHapus($id) {
        $data = DB::table('voucher')->find($id);
        if ($data == null) return redirect('/voucher/not-found');
        // Literrally sama dengan yang di bawah!
        // $data = DB::select('select * from voucher where id = ?', [$id])[0];
        return view("voucher.hapus", [
            "user" => "saya",
            "d" =>$data
        ]);
    }

    public function tambahData(Request $request) {
        $request->validate([
            "nama" => "required|string",
            "jumlah" => "required|numeric",
            "tipe" => "required|string",
        ]);

        $result = DB::insert('INSERT INTO voucher(nama_voucher,tipe_voucher, jumlah_diskon,insert_by)
        VALUES (:nama, :tipe, :jumlah, :oleh)', [
            "nama" => $request->input("nama"),
            "jumlah" => $request->input("jumlah"),
            "tipe" => ($request->input("tipe") == "persen") ? 1 : 2,
            "oleh" => "saya", // ini boleh ga ada koma? BOLEH
        ]);

        if ($result){
            return redirect()
                ->back()->with("success", "Berhasil Tambah Voucher");
        } else {
            return redirect()->back()
                ->withErrors("Gagal Tambah Data");
        }
    }

    public function updateData(Request $request, $id) {
        $request->validate([
            "nama" => "required|string",
            "jumlah" => "required|numeric",
            "tipe" => "required|string",
        ]);

        $result = DB::update('UPDATE voucher SET
        nama_voucher = :nama, tipe_voucher = :tipe,
        jumlah_diskon = :jumlah
        WHERE id = :id', [
            "nama" => $request->input("nama"),
            "jumlah" => $request->input("jumlah"),
            "tipe" => ($request->input("tipe") == "persen") ? 1 : 2,
            "id" => $id
        ]);

        if ($result){
            return redirect()
                ->back()->with("success", "Berhasil Update Voucher");
        } else {
            return redirect()->back()
                ->withErrors("Gagal Update Data");
        }
    }

    public function hapusData($id) {
        $data = DB::table('voucher')->find($id);
        if ($data == null) return redirect('/voucher/not-found');
        $result = DB::delete("DELETE FROM voucher WHERE id = ?", [$id]);
        if ($result) {
            return redirect("/master/voucher")
                ->with("success", "Behasil hapus Voucher ".$data->nama_voucher);
        } else {
            return redirect()->back()
                ->withErrors("Gagal Delete Voucher");
        }
    }
}
