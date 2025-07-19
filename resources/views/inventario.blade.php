<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Inventario - Diverland</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap y fuentes -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Baloo+2&display=swap" rel="stylesheet">
    <!-- Fuente Roboto Mono para fallback -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Mono:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <style>
        body {
            font-family: 'Roboto Mono', monospace !important;
            background-color: white;
            color: #333;
            position: relative;
            overflow-x: hidden;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        body::before {
            content: "";
            position: absolute;
            width: 100%;
            height: 100%;
            pointer-events: none;
            background-image:
                radial-gradient(circle, #ff6f00 4px, transparent 5px),
                radial-gradient(circle, #f44336 4px, transparent 5px),
                radial-gradient(circle, #4caf50 4px, transparent 5px),
                radial-gradient(circle, #2196f3 4px, transparent 5px),
                radial-gradient(circle, #9c27b0 4px, transparent 5px);
            background-size: 100px 100px;
            background-position: 0 0, 50px 50px, 25px 75px, 75px 25px, 100px 100px;
            z-index: 0;
            opacity: 0.3;
        }

        header {
            background-color: white;
            color: #ff6f00;
            padding: 20px 0;
            text-align: center;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            position: relative;
            z-index: 1;
        }

        nav a {
            color: #ff6f00;
            margin: 0 15px;
            font-size: 1.1rem;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        nav a:hover {
            color: #ffa500;
        }

        .form-container {
            background-color: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
            margin-top: 30px;
            position: relative;
            z-index: 1;
        }

        .btn-guardar {
            background-color: #4CAF50;
            color: white;
        }

        .btn-guardar:hover {
            background-color: #45a049;
        }

        footer {
            margin-top: auto;
            background-color: white;
            color: #ff6f00;
            text-align: center;
            padding: 15px;
            box-shadow: 0 -4px 8px rgba(0,0,0,0.1);
        }

        .btn-primary {
            background-color: #007bff;
            border: none;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }

        .btn-warning {
            background-color: #ffa500;
            border: none;
            color: white;
        }

        .btn-warning:hover {
            background-color: #e08500;
        }
    </style>
</head>
<body>

<header>
    <h1>Inventario - Diverland</h1>
    <h2 class="text-center mb-4">¡Diverland: Donde la diversión nunca termina!</h2>
    <nav>
        <a href="{{ url('menu') }}"><i class="fas fa-arrow-left"></i> Volver al Menú</a>
        <a href="{{ url('login') }}"><i class="fas fa-sign-out-alt"></i> Cerrar Sesión</a>
    </nav>
</header>

<div class="container">
    <div class="form-container">
        <form method="POST" action="{{ url('inventario/guardar') }}">
            @csrf

            <div class="mb-3">
                <label for="referencia" class="form-label">Referencia</label>
                <input type="text" class="form-control" id="referencia" name="referencia" required>
            </div>

            <div class="mb-3">
                <label for="producto" class="form-label">Producto</label>
                <input type="text" class="form-control" id="producto" name="producto" required>
            </div>

            <div class="mb-3">
                <label for="precio_unidad" class="form-label">Precio por Unidad ($)</label>
                <input type="number" step="0.01" class="form-control" id="precio_unidad" name="precio_unidad" required>
            </div>

            <div class="mb-3">
                <label for="precio_venta" class="form-label">Precio de Venta ($)</label>
                <input type="number" step="0.01" class="form-control" id="precio_venta" name="precio_venta" required>
            </div>

            <div class="mb-3">
                <label for="fecha_compra" class="form-label">Fecha de Compra</label>
                <input type="date" class="form-control" id="fecha_compra" name="fecha_compra" required>
            </div>

            <div class="mb-3">
                <label for="fecha_vencimiento" class="form-label">Fecha de Vencimiento</label>
                <input type="date" class="form-control" id="fecha_vencimiento" name="fecha_vencimiento">
            </div>

            <button type="submit" class="btn btn-guardar">Guardar Producto</button>

            <div class="mt-4 text-center">
                <a href="{{ url('inventario/listado') }}" target="_blank" class="btn btn-primary">
                    Ver Registro de Inventario
                </a>
            </div>

            <div class="mt-2 text-center">
                <a href="{{ url('proveedores') }}" class="btn btn-warning">
                    Gestionar Proveedores
                </a>
            </div>
        </form>
    </div>
</div>

<footer>
    <p>&copy; 2025 Diverland - Todos los derechos reservados</p>
    <p><a href="https://www.instagram.com/diverland" target="_blank" style="color: #ff6f00;">Síguenos en Instagram</a></p>
</footer>

</body>
</html>
