<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\Auth\LoginController;  // Asegúrate de tener un controlador para el login
use App\Http\Controllers\InventarioController;
use App\Http\Controllers\ProveedorController;
use App\Http\Controllers\EventoController;
use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;


// Ruta para mostrar la página de bienvenida
Route::get('/', function () {
    return redirect()->route('login');
});
// Rutas para login
Route::get('/login', function () {
    return view('login');
});

Route::get('/menu', function () {
    return view('menu'); // Asegúrate de tener resources/views/menu.blade.php
})->name('menu');
Route::get('/inventario', function () {
    return view('inventario');
});
Route::get('/registroc', function () {
    return view('registroc');
});
Route::get('/proveedores', function () {
    return view('proveedores');
});
Route::get('/clientes', [ClienteController::class, 'clientes.index']);
Route::get('/viveres', [ViveresController::class, 'index']);
Route::get('/eventos', [EventosController::class, 'index']);

// Rutas para acciones de cliente (listar, crear, editar, actualizar, ver factura)
Route::get('/clientes', [ClienteController::class, 'index'])->name('clientes.index');  // Lista de clientes
Route::post('/clientes/store', [ClienteController::class, 'store'])->name('clientes.store'); // Crear cliente
Route::get('/clientes/{id}/factura', [ClienteController::class, 'factura'])->name('clientes.factura'); // Ver factura

// Ruta para agregar tiempo a un cliente
Route::post('/clientes/agregar-tiempo', [ClienteController::class, 'agregarTiempo'])->name('clientes.agregar-tiempo');

// Ruta para eliminar un cliente
Route::delete('/clientes/{id}', [ClienteController::class, 'destroy'])->name('clientes.destroy');

// Ruta adicional para listado de clientes (opcional)
Route::get('/clientes/listado', [ClienteController::class, 'listado'])->name('clientes.listado');

// Rutas para editar un cliente y actualizar datos
// web.php
Route::get('/clientes/{id}/editar', [ClienteController::class, 'edit'])->name('clientes.edit');
Route::put('/clientes/{id}', [ClienteController::class, 'update'])->name('clientes.update');


Route::post('/login', [LoginController::class, 'login'])->name('login');
Route::get('/inventario', [InventarioController::class, 'create']);
Route::post('/inventario/guardar', [InventarioController::class, 'store']);
// Mostrar listado de inventario
Route::get('inventario/listado', [InventarioController::class, 'listado'])->name('inventario.listado');
Route::get('inventario', [InventarioController::class, 'index'])->name('inventario.formulario');
Route::post('inventario/guardar', [InventarioController::class, 'guardar'])->name('inventario.guardar');
Route::get('/inventario', [InventarioController::class, 'index'])->name('inventario.index');
Route::post('/inventario/guardar', [InventarioController::class, 'guardar'])->name('inventario.guardar');
Route::get('/inventario/listado', [InventarioController::class, 'listado'])->name('inventario.listado');
Route::get('/inventario/{id}/editar', [InventarioController::class, 'editar'])->name('inventario.editar');
Route::put('/inventario/{id}', [InventarioController::class, 'actualizar'])->name('inventario.actualizar');
Route::delete('/inventario/{id}', [InventarioController::class, 'eliminar'])->name('inventario.eliminar');


Route::get('/proveedores/editar/{id}', [ProveedorController::class, 'editar'])->name('proveedor.editar');

Route::get('proveedores', [ProveedorController::class, 'index'])->name('proveedor.index');
Route::get('proveedores/crear', [ProveedorController::class, 'crear']);
Route::post('proveedores/guardar', [ProveedorController::class, 'guardar']);
Route::get('proveedores/editar/{id}', [ProveedorController::class, 'editar']);
Route::post('proveedores/actualizar/{id}', [ProveedorController::class, 'actualizar']); // ESTA ES CLAVE


Route::get('/clientes/pdf', [ClienteController::class, 'generarPDF'])->name('clientes.pdf');

Route::get('/inventario/pdf', [InventarioController::class, 'generarPDF'])->name('inventario.pdf');



Route::get('/eventos', [EventoController::class, 'index'])->name('eventos');
Route::get('/eventos/programar', [EventoController::class, 'programar']);
Route::get('/eventos/gestionar', [EventoController::class, 'gestionar']);
Route::get('/eventos/puntos/registrar', [EventoController::class, 'registrarPunto']);
Route::get('/eventos/puntos/desactivar', [EventoController::class, 'desactivarPunto']);
Route::post('/eventos', [EventoController::class, 'store'])->name('eventos.store');
Route::put('/eventos/actualizar', [EventoController::class, 'actualizar'])->name('eventos.actualizar');
Route::delete('/eventos/{id}', [EventoController::class, 'destroy'])->name('eventos.destroy');

// Rutas para registrar nuevos usuarios
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register'])->name('register.store');

Route::get('/olvide-mi-contrasena', function () {
    return view('auth.olvide-contrasena');
})->name('custom.password.request');

Route::post('/olvide-mi-contrasena', [App\Http\Controllers\Auth\ForgotCustomController::class, 'enviarSolicitud'])->name('custom.password.email');

// Ruta protegida solo para el admin
Route::middleware(['auth'])->group(function () {
    Route::get('/admin/cambiar-password', function () {
        if (auth()->user()->email !== 'admin@diverland.com') {
            abort(403, 'No autorizado');
        }
        $usuarios = User::all();
        return view('admin.cambiar-password', compact('usuarios'));
    })->name('admin.cambiar-password');

    Route::post('/admin/cambiar-password', function (Request $request) {
        if (auth()->user()->email !== 'admin@diverland.com') {
            abort(403, 'No autorizado');
        }
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'password' => 'required|min:6|confirmed'
        ]);
        $user = User::where('email', $request->email)->first();
        $user->password = Hash::make($request->password);
        $user->save();
        return back()->with('success', 'Contraseña cambiada correctamente para ' . $user->email);
    })->name('admin.cambiar-password.post');

    Route::post('/admin/crear-usuario', function (Request $request) {
        if (auth()->user()->email !== 'admin@diverland.com') {
            abort(403, 'No autorizado');
        }
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6'
        ]);
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);
        return back()->with('success', 'Usuario creado correctamente.');
    })->name('admin.crear-usuario');

    Route::delete('/admin/eliminar-usuario/{id}', function ($id) {
        if (auth()->user()->email !== 'admin@diverland.com') {
            abort(403, 'No autorizado');
        }
        $user = User::findOrFail($id);
        if ($user->email === 'admin@diverland.com') {
            return back()->with('error', 'No puedes eliminar el usuario administrador.');
        }
        $user->delete();
        return back()->with('success', 'Usuario eliminado correctamente.');
    })->name('admin.eliminar-usuario');
});
