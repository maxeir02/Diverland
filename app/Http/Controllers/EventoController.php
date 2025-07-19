<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Evento;

class EventoController extends Controller
{
        // Mostrar vista de eventos
    public function index() {
        $eventos = Evento::all(); // O tu consulta personalizada
        return view('eventos', compact('eventos'));
    }

    // Guardar nuevo evento (RF13)
   public function store(Request $request)
{
    $request->validate([
        'codigo_punto' => 'required|string',
        'usuario_trabajador' => 'required|string|max:100',
        'codigo_juego' => 'required|string',
        'horario' => 'required|date',
    ], [
        'codigo_punto.required' => 'El punto es obligatorio.',
        'usuario_trabajador.required' => 'El usuario trabajador es obligatorio.',
        'codigo_juego.required' => 'El juego es obligatorio.',
        'horario.required' => 'El horario es obligatorio.',
        'horario.date' => 'El horario debe ser una fecha y hora válida.',
    ]);

    $evento = new Evento();
    $evento->codigo_punto = $request->codigo_punto;
    $evento->usuario_trabajador = $request->usuario_trabajador;
    $evento->codigo_juego = $request->codigo_juego;
    $evento->codigo_insumo = $request->codigo_insumo;
    $evento->horario = $request->horario;
    $evento->lugar = $request->codigo_punto;

    $evento->save();

    return redirect()->back()->with('success', 'Evento programado correctamente.');
}

    // Actualizar evento (RF36)
    public function actualizar(Request $request)
{
    $evento = Evento::findOrFail($request->codigo_evento);

    $evento->codigo_punto = $request->codigo_punto;
    $evento->lugar = $request->lugar;
    $evento->codigo_juego = $request->codigo_juego;
    // Si tienes más campos, agrégalos aquí

    $evento->save();

    return redirect()->back()->with('success', 'Evento actualizado correctamente.');
}
    public function destroy($id)
    {
        $evento = Evento::findOrFail($id);
        $evento->delete();
        return redirect()->route('eventos')->with('success', 'Evento eliminado correctamente.');
    }
}
