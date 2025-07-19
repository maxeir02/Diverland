<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Cliente - Diverland</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Fuente Roboto Mono para fallback -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Mono:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <style>
        body {
    font-family: 'Roboto Mono', monospace !important;
}
        body::before {
      content: "";
      position: absolute;
      width: 100%;
      height: 100%;
      pointer-events: none;
      background-image:
        radial-gradient(circle, #ff6f00 2px, transparent 3px),
        radial-gradient(circle, #f44336 2px, transparent 3px),
        radial-gradient(circle, #4caf50 2px, transparent 3px),
        radial-gradient(circle, #2196f3 2px, transparent 3px),
        radial-gradient(circle, #9c27b0 2px, transparent 3px);
      background-size: 100px 100px;
      background-position: 0 0, 50px 50px, 25px 75px, 75px 25px, 100px 100px;
      z-index: 0;
      opacity: 0.3;
    }
    .card {
            border-radius: 12px;
            box-shadow: 0 0 16px rgba(0,0,0,0.08);
            border: none;
    }
    footer {
            position: absolute;
            bottom: 10px;
            width: 100%;
            text-align: center;
            color: white;
            font-size: 0.9rem;
            background-color: rgba(0, 0, 0, 0.5);
            padding: 10px 0;
        }

        .btn-primary {
            background-color: #ff6f00;
            border: none;
            padding: 12px;
            font-weight: bold;
            border-radius: 10px;
        }

        .btn-primary:hover {
            background-color: #e65c00;
        }
    </style>
</head>
<body>
    <div class="container d-flex align-items-center justify-content-center" style="min-height: 80vh;">
        <div class="card p-4" style="width: 100%; max-width: 480px;">
            <h2 class="text-center mb-4">Editar Datos del Cliente</h2>
            <form action="{{ route('clientes.update', ['id' => $cliente->id]) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="nombre" class="form-label">Nombre:</label>
                    <input type="text" id="nombre" name="nombre" class="form-control" value="{{ old('nombre', $cliente->nombre) }}" required>
                </div>

                <div class="mb-3">
                    <label for="edad" class="form-label">Edad:</label>
                    <input type="number" id="edad" name="edad" class="form-control" value="{{ old('edad', $cliente->edad) }}" required>
                </div>

                <div class="mb-3">
                    <label for="tiempo_pago" class="form-label">Tiempo Pagado (en horas):</label>
                    <input type="number" id="tiempo_pago" name="tiempo_pago" class="form-control" value="{{ old('tiempo_pago', $cliente->tiempo_pago) }}" required>
                </div>

                <div class="mb-3">
                    <label for="hora_entrada" class="form-label">Hora de Entrada:</label>
                    <input type="time" id="hora_entrada" name="hora_entrada" class="form-control" value="{{ old('hora_entrada', $cliente->hora_entrada) }}" required>
                </div>

                <div class="mb-4">
                    <label for="metodo_pago" class="form-label">Método de Pago:</label>
                    <select id="metodo_pago" name="metodo_pago" class="form-select" required>
                        <option value="efectivo" {{ old('metodo_pago', $cliente->metodo_pago) == 'efectivo' ? 'selected' : '' }}>Efectivo</option>
                        <option value="transferencia" {{ old('metodo_pago', $cliente->metodo_pago) == 'transferencia' ? 'selected' : '' }}>Transferencia Bancaria</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-primary w-100">Actualizar Cliente</button>
            </form>
        </div>
    </div>
    <footer>
        © 2025 Diverland - Todos los derechos reservados
    </footer>
</body>
</html>
