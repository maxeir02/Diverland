<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;  // Importa el modelo Producto
use Barryvdh\DomPDF\Facade\Pdf;

class InventarioController extends Controller
{
    // Mostrar formulario
    public function index()
    {
        return view('inventario');
    }

    // Guardar datos del formulario
    public function guardar(Request $request)
    {
        $request->validate([
            'referencia' => 'required|string|max:255',
            'producto' => 'required|string|max:255',
            'precio_unidad' => 'required|numeric',
            'precio_venta' => 'required|numeric',
            'fecha_compra' => 'required|date',
            'fecha_vencimiento' => 'nullable|date',
        ]);

        Producto::create([
            'referencia' => $request->referencia,
            'producto' => $request->producto,
            'precio_unidad' => $request->precio_unidad,
            'precio_venta' => $request->precio_venta,
            'fecha_compra' => $request->fecha_compra,
            'fecha_vencimiento' => $request->fecha_vencimiento,
        ]);

        return redirect()->route('inventario.listado')->with('success', 'Producto guardado correctamente');
    }

    // Mostrar listado de productos
    public function listado()
    {
        $productos = Producto::all();
        return view('inventario-listado', compact('productos'));
    }

    // Mostrar formulario para editar
    public function editar($id)
    {
        $producto = Producto::findOrFail($id);
        return view('inventario-editar', compact('producto'));
    }

    // Actualizar un producto
    public function actualizar(Request $request, $id)
    {
        $request->validate([
            'referencia' => 'required|string|max:255',
            'producto' => 'required|string|max:255',
            'precio_unidad' => 'required|numeric',
            'precio_venta' => 'required|numeric',
            'fecha_compra' => 'required|date',
            'fecha_vencimiento' => 'nullable|date',
        ]);

        $producto = Producto::findOrFail($id);
        $producto->update($request->all());

        return redirect()->route('inventario.listado')->with('success', 'Producto actualizado correctamente');
    }

    // Eliminar un producto
    public function eliminar($id)
    {
        $producto = Producto::findOrFail($id);
        $producto->delete();

        return redirect()->route('inventario.listado')->with('success', 'Producto eliminado correctamente');
    }

    public function generarPDF()
{
    $productos = Producto::all(); // Ajusta el modelo si se llama diferente

    $pdf = Pdf::loadView('inventario.pdf', compact('productos'));
    return $pdf->download('inventario_diverland.pdf');
}
}

