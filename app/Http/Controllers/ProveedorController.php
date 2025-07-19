<?php

namespace App\Http\Controllers;

use App\Models\Proveedor;
use Illuminate\Http\Request;

class ProveedorController extends Controller
{
    public function index()
    {
        $proveedores = Proveedor::all();
        return view('proveedor-listado', compact('proveedores'));
    }

    public function crear()
    {
        return view('proveedor-crear');
    }

    public function guardar(Request $request)
    {
        $request->validate([
            'nombre' => 'required',
            'direccion' => 'required',
            'correo' => 'required|email',
            'contacto' => 'required',
            'datos_facturacion' => 'nullable',
        ]);

        Proveedor::create($request->all());

        return redirect()->route('proveedor.index')->with('success', 'Proveedor registrado con éxito');
    }

    public function editar($id)
    {
        $proveedor = Proveedor::findOrFail($id);
        return view('proveedor-editar', compact('proveedor'));
    }

    public function actualizar(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required',
            'direccion' => 'required',
            'correo' => 'required|email',
            'contacto' => 'required',
            'datos_facturacion' => 'nullable',
        ]);

        $proveedor = Proveedor::findOrFail($id);
        $proveedor->update($request->all());

        return redirect()->route('proveedor.index')->with('success', 'Datos actualizados');
    }
}
