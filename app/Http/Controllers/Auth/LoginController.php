<?php

namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Cliente;  // Asegúrate de importar el modelo Cliente

class LoginController extends Controller
{
    public function login(Request $request)
{
    $credentials = $request->only('email', 'password');
    
    if (Auth::attempt($credentials)) {
        return redirect()->route('menu');
    }

    return back()->withErrors(['email' => 'Credenciales inválidas'])->withInput();
}

}


