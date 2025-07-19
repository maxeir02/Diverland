<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Cliente</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Baloo 2', cursive;
            background-image: url('https://example.com/imagen-fondo.jpg'); /* Cambia la URL por la imagen de fondo que prefieras */
            background-size: cover;
            background-position: center;
            color: #333;
        }

        header {
            background-color: #ff6f00;
            color: white;
            padding: 20px 0;
            text-align: center;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .card {
            background-color: rgba(255, 255, 255, 0.8);
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.15);
            margin-top: 40px;
        }

        .card-header {
            background-color: #ff6f00;
            color: white;
            padding: 15px;
            border-radius: 10px 10px 0 0;
        }

        .btn {
            width: 100%;
            margin-top: 15px;
            padding: 12px;
            border-radius: 10px;
            font-weight: bold;
        }

        .btn-success {
            background-color: #4CAF50;
            color: white;
        }

        .btn-success:hover {
            background-color: #45a049;
        }

        .btn-secondary {
            background-color: #6c757d;
            color: white;
        }

        .btn-secondary:hover {
            background-color: #5a6268;
        }

        .btn-info {
            background-color: #17a2b8;
            color: white;
        }

        .btn-info:hover {
            background-color: #138496;
        }

        .form-label {
            font-weight: bold;
            color: #ff6f00;
        }

        .form-select, .form-control {
            border-radius: 10px;
            padding: 10px;
        }

        footer {
            background-color: #ff6f00;
            color: white;
            text-align: center;
            padding: 15px;
            position: fixed;
            bottom: 0;
            width: 100%;
        }

    </style>
</head>
<body>

<header>
    <h1>Editar Cliente - Diverland</h1>
</header>

<div class="container mt-5">
    <div class="card shadow">
        <div class="card-header">
            <h4 class="mb-0">Editar Cliente</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('clientes.update', $cliente->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="nombre" class="form-label">Nombre</label>
                    <input type="text" id="nombre" name="nombre" value="{{ $cliente->nombre }}" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="edad" class="form-label">Edad</label>
                    <input type="number" id="edad" name="edad" value="{{ $cliente->edad }}" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="tiempo_pago" class="form-label">Tiempo Pagado (horas)</label>
                    <input type="number" id="tiempo_pago" name="tiempo_pago" value="{{ $cliente->tiempo_pago }}" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="metodo_pago" class="form-label">Método de Pago</label>
                    <select id="metodo_pago" name="metodo_pago" class="form-select" required>
                        <option value="efectivo" {{ $cliente->metodo_pago == 'efectivo' ? 'selected' : '' }}>Efectivo</option>
                        <option value="tarjeta" {{ $cliente->metodo_pago == 'tarjeta' ? 'selected' : '' }}>Tarjeta</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-success">Guardar Cambios</button>
                <a href="{{ route('clientes.index') }}" class="btn btn-secondary">Cancelar</a>
                <a href="{{ url('menu') }}" class="btn btn-info">Volver</a> <!-- Botón Volver -->
            </form>
        </div>
    </div>
</div>

<footer>
    <p>&copy; 2025 Diverland</p>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
