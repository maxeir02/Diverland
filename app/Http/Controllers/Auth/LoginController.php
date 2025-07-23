<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Cliente;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        
        if (!Auth::attempt($credentials)) {
            return back()->with('error', 'Correo o contraseña incorrectos');
        }

        return redirect()->route('menu');
    }
}


