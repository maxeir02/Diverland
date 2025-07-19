<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cliente;
use Barryvdh\DomPDF\Facade\Pdf;

class ClienteController extends Controller
{
    // Función para mostrar la lista de clientes
    public function index()
    {
        // Obtener todos los clientes desde la base de datos
        $clientes = Cliente::all();

        // Pasar los clientes a la vista 'clientes'
        return view('clientes.index', compact('clientes')); // Asegúrate que la vista sea 'clientes.index'
    }

    // Función para almacenar un nuevo cliente
    public function store(Request $request)
    {
        // Validación opcional
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'edad' => 'required|integer',
            'tiempo_pago' => 'required|in:0.25,0.5,1,99', 
            'hora_entrada' => 'required',
            'hora_salida' => 'nullable|string', 
            'metodo_pago' => 'required|string',
        ]);

        // Crear el cliente
        $cliente = Cliente::create($validated);

        // Redirigir a la lista de clientes con mensaje
        return response()->json(['mensaje' => 'Cliente registrado correctamente.']);
    }

    // Función para mostrar la factura de un cliente
    public function factura($id)
    {
        // Buscar el cliente por ID
        $cliente = Cliente::findOrFail($id);

        // Retornar la vista con los datos del cliente
        return view('factura', compact('cliente'));
    }

    // Función para mostrar el formulario de edición
   public function edit($id)
{
    $cliente = Cliente::findOrFail($id);
    return view('editar-cliente', compact('cliente')); // Cambiado aquí
}
    
    // Función para listar todos los clientes (esto es opcional)
    public function listado()
    {
        $clientes = Cliente::all();
        return view('clientes-listado', compact('clientes'));
    }

    // Función para agregar tiempo a un cliente
    public function agregarTiempo(Request $request)
    {
        try {
            $cliente = Cliente::findOrFail($request->cliente_id);
            
            $horas = (int) $request->horas;
            $minutos = (int) $request->minutos;
            
            // Convertir minutos a fracción de hora
            $tiempoExtra = $horas + ($minutos / 60);
            
            // Actualizar el tiempo
            $cliente->tiempo_pago = $cliente->tiempo_pago + $tiempoExtra;
            $cliente->save();
            
            // Retornar el nuevo tiempo formateado
            return response()->json([
                'success' => true,
                'nuevo_tiempo' => number_format($cliente->tiempo_pago, 2)
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al actualizar el tiempo: ' . $e->getMessage()
            ], 500);
        }
    }
    public function destroy($id)
{
    $cliente = Cliente::findOrFail($id);
    $cliente->delete();
    return redirect()->back()->with('success', 'Cliente eliminado correctamente.');
}

    
    // Función para actualizar los datos del cliente
    public function update(Request $request, $id)
    {
        try {
            $cliente = Cliente::findOrFail($id);
            
            $request->validate([
                'nombre' => 'required|string|max:255',
                'edad' => 'required|integer|min:1',
                'tiempo_pago' => 'required|numeric|min:0.01',
                'hora_entrada' => 'required',
                'metodo_pago' => 'required|string'
            ]);

            $cliente->nombre = $request->nombre;
            $cliente->edad = $request->edad;
            $cliente->tiempo_pago = $request->tiempo_pago;
            $cliente->hora_entrada = $request->hora_entrada;
            $cliente->metodo_pago = $request->metodo_pago;
            
            $cliente->save();

            return redirect()->route('clientes.listado')->with('success', 'Cliente actualizado correctamente');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('error', 'Error al actualizar el cliente: ' . $e->getMessage());
        }
    }
    public function generarPDF()
{
    $clientes = Cliente::all();
    $pdf = Pdf::loadView('clientes.pdf', compact('clientes'));
    return $pdf->download('clientes_diverland.pdf');
}
}