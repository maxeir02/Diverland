<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Str;

class ForgotCustomController extends Controller
{
    public function enviarSolicitud(Request $request)
    {
        $request->validate([
            'email' => 'required|email'
        ]);

        // Busca el usuario por correo
        $usuario = User::where('email', $request->email)->first();

        if (!$usuario) {
            return back()->with('status', 'No existe un usuario con ese correo.');
        }

        // Genera una nueva contraseña temporal
        $nuevaPassword = Str::random(8);
        $usuario->password = Hash::make($nuevaPassword);
        $usuario->save();

        // Envía el correo al administrador con la nueva contraseña
        Mail::raw(
            "El usuario con correo {$request->email} ha solicitado recuperar su contraseña.\n".
            "La nueva contraseña temporal es: {$nuevaPassword}",
            function ($message) {
                $message->to('palaciojuanjose@gmail.com')
                        ->subject('Solicitud de recuperación de contraseña');
            }
        );

        return back()->with('status', 'La solicitud fue enviada al administrador. Pronto recibirás respuesta.');
    }
}