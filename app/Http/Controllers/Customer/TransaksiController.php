<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    public function doTransaksi() {
        // Some Transaction happen!
        return response("HALO Ini Perubahan");
    }
}
