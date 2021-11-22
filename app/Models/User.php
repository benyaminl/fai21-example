<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;
    protected $table = "user";
    protected $primaryKey = "id";

    public $incrementing = true;
    public $timestamps = true;

    public static function tryLogin(string $username,string $password) : bool {
        /** @var Collection $user */
        $user = User::where("user", $username)->get();
        if ($user->count() <= 0) return false;
        $user = $user->first();
        $result = password_verify($password, $user->pass);
        return $result;
    }
}
