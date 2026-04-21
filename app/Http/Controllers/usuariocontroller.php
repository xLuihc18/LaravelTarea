<?php

namespace App\Http\Controllers;

use App\Models\usuario; 
use Illuminate\Http\Request;

class usuariocontroller extends Controller
{
    public function login(Request $request)
    {
        
        $res = usuario::spLogin($request->correo, $request->password);

        if (count($res) > 0) {
            return response()->json([
                'success' => true,
                'message' => 'Login exitoso',
                'data' => $res[0],
                'status' => 200,
            ], 200);
        }

        return response()->json([
            'success' => false,
            'message' => 'Credenciales incorrectas',
            'data' => null,
            'status' => 401,
        ], 401);
    }

    public function registrar(Request $request)
    {
        $res = usuario::spRegistrar(
            $request->nombre,
            $request->apellido,
            $request->dni,
            $request->correo,
            $request->password
        );

        if ($res) {
            return response()->json([
                'success' => true,
                'message' => 'Registro exitoso',
                'status' => 201,
            ], 201);
        }

        return response()->json([
            'success' => false,
            'message' => 'Error al registrar',
            'status' => 500,
        ], 500);
    }

    public function recuperar(Request $request)
    {
        $res = usuario::spRecuperar($request->correo, $request->nueva_password);

        if ($res) {
            return response()->json([
                'success' => true,
                'message' => 'Contraseña actualizada',
                'status' => 200,
            ], 200);
        }

        return response()->json([
            'success' => false,
            'message' => 'Error al actualizar contraseña',
            'status' => 500,
        ], 500);
    }

    public function mostrar($id)
    {
        $res = usuario::where('id', $id)->first(['id', 'nombre', 'apellido', 'dni', 'correo']);
        
        if ($res) {
            return response()->json([
                'success' => true,
                'message' => 'Usuario encontrado',
                'data' => $res,
                'status' => 200,
            ], 200);
            
        }

        return response()->json(['message' => 'Usuario no encontrado'], 404);
    }

    public function listado()
    {
        $res = usuario::all(['id', 'nombre', 'apellido', 'dni', 'correo']);
        
        return response()->json([
            'success' => true,
            'message' => 'Listado de usuarios',
            'data' => $res,
            'status' => 200,
        ], 200);
    }
}