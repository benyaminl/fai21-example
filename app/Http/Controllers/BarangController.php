<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BarangController extends Controller
{
    public function index(Request $request) {
        $dataJson = json_decode($request->cookie("data") ?? "[]", true);
        return view("barang.index", [
            "user" => "Saya",
            "data" => $dataJson
        ]);
    }

    public function formTambah() {
        return view("barang.tambah", [
            "user" => "Saya"
        ]);
    }

    public function tambahData(Request $request) {
        $dataJson = json_decode($request->cookie("data") ?? "[]", true);
        $d = ["id" => $request->id, "nama" => $request->nama,
                "harga" => $request->harga, "stok" => $request->stok];
        $dataJson[] = $d;

        return response(view("barang.tambah", ["user" => "Saya",
            "msg" => "Berhasil tambah data!"]))
            ->cookie("data", json_encode($dataJson), "1000");
    }

    public function formUbah($id, Request $request) {
        $dataJson = json_decode($request->cookie("data") ?? "[]", true);
        $d = array_filter($dataJson, function($d) use($id) {
            return $d["id"] == $id;
        });

        if (count($d) <= 0) {
            $msg = "DATA TIDAK DITEMUKAN!";
            return response($msg, 404);
        }

        return view("barang.ubah", [
            "user" => "Saya",
            "d" => $d[0]
        ]);
    }

    public function ubahData($id, Request $request) {
        $dataJson = json_decode($request->cookie("data") ?? "[]", true);
        $index = -1;
        for ($i=0; $i < count($dataJson); $i++) {
            if ($dataJson[$i]["id"] == $id) {
                $index = $i;
            }
        }

        if ($index < 0) {
            return response("Barang tidak ditemukan!", 404);
        }

        $dataJson[$index] = [
            "id" => $request->id,
            "nama" => $request->nama,
            "harga" => $request->harga,
            "stok" => $request->stok
        ];
        return response(view("barang.ubah", [
            "user" => "Saya",
            "msg" => "Berhasil Update Data $id",
            "d" => $dataJson[$index]
        ]))->cookie("data", json_encode($dataJson), "1000");
    }

    public function hapusData($id, Request $request) {
        $dataJson = json_decode($request->cookie("data") ?? "[]", true);
        $index = -1;
        for ($i=0; $i < count($dataJson); $i++) {
            if ($dataJson[$i]["id"] == $id) {
                $index = $i;
            }
        }

        if ($index < 0) {
            return response("Barang tidak ditemukan!", 404);
        }

        array_splice($dataJson, $index, 1);

        return response("Berhasil di hapus!", 200)
            ->cookie("data", json_encode($dataJson), "1000");
    }

    public function cobaCOba(){
        //coba doang
    }
}
