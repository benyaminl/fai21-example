<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{

    public function list() {
        $data = User::select(["id", "user", "created_at", "updated_at"])
            ->get();
        $user = Session::get("user", "saya");
        return view("user.list", [
            "data" => $data,
            "user" => $user
        ]);
    }

    public function formTambah() {
        $user = Session::get("user", "saya");
        return view("user.tambah", [
            "user" => $user,
        ]);
    }

    public function tambahData(Request $request) {
        $in = $request->validate([
            "user" => "string|min:3",
            "pass" => "alpha_num|min:3"
        ]);

        $user = new User();
        $user->user = $in["user"];
        $user->pass = password_hash($in["pass"], PASSWORD_DEFAULT);
        $user->save();
        return redirect("/master/user")
            ->with("success", "Berhasil Tambah User");
    }

    public function formUpdate(int $id) {
        $u = User::findOrFail($id);
        $user = Session::get("user", "saya");
        return view("user.ubah", [
            "d" => $u,
            "user" => $user
        ]);
    }

    public function ubahData(int $id, Request $request) {
        $user = User::findOrFail($id);
        $request->validate([
            "user" => "string|min:3"
        ]);

        $user->user = $request->input("user");
        $user->pass = password_hash($request
            ->input("pass"),PASSWORD_DEFAULT) ?? $user->pass;
        $user->save();

        return redirect("/master/user")
            ->with("success", "Berhasil Ubah User");
    }

    public function hapusData(int $id) {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect("/master/user")
            ->with("success", "Berhasil Hapus User");
    }

    public function login(Request $request) {
        $in = $request->validate([
            "user" => "required",
            "pass" => "required"
        ]);

        $result = User::tryLogin($in["user"], $in["pass"]);
        if ($result == false) return redirect()
            ->back()->with("error", "user atau pass salah!");

        $request->session()
            ->put("user", User::where("user", $in["user"])->first()->user);
        return redirect("/master/user")->with("success", "Berhasil login");
    }

    public function logout(Request $request) {
        $request->session()->forget('user');
        return redirect("/login")->with("success", "Sudah keluar!");
    }
}
