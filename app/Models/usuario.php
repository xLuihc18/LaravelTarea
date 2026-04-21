<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class usuario extends Model
{
    protected $table = 'usuarios';
    public $timestamps = false;
    protected $fillable = ['nombre', 'apellido', 'dni', 'correo', 'password'];

    public static function spLogin($cor, $pass)
    {
        return DB::select('call sp_login(?, ?)', [$cor, $pass]);
    }

    public static function spRegistrar($nom, $ape, $dni, $cor, $pass)
    {
        return DB::statement('call sp_registrar(?, ?, ?, ?, ?)', [
            $nom, $ape, $dni, $cor, $pass
        ]);
    }

    public static function spRecuperar($cor, $nueva_pass)
    {
        return DB::statement('call sp_recuperar(?, ?)', [$cor, $nueva_pass]);
    }
}