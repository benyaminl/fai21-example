<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Voucher extends Model
{
    use HasFactory;

    protected $table = "voucher";
    protected $primaryKey = "id_voucher";
    // Jika Bukan Integer primary key nya
    // BUAT incrementing jadi false!
    // public $incrementing = false;
}
