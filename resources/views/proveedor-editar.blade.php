<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Proveedor - Diverland</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap y estilos -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Baloo+2&display=swap" rel="stylesheet">
    <!-- Fuente Roboto Mono para fallback -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Mono:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <style>
        body {
            font-family: 'Roboto Mono', monospace !important;
            background-color: #f9f9f9;
            padding: 20px;
        }

        h1 {
            color: #ff6f00;
            text-align: center;
        }

        .btn-actualizar {
            background-color: #28a745;
            color: white;
        }

        .btn-actualizar:hover {
            background-color: #1e7e34;
        }

        .volver-btn {
            display: block;
            margin: 20px auto;
            text-align: center;
        }
    </style>
</head>
<body>

<h1>Editar Proveedor</h1>

<div class="container">
    <form method="POST" action="{{ url('proveedores/actualizar/'.$proveedor->id) }}">
        @csrf

        <div class="mb-3">
            <label>Nombre</label>
            <input type="text" name="nombre" class="form-control" value="{{ old('nombre', $proveedor->nombre) }}" required>
        </div>

        <div class="mb-3">
            <label>Dirección</label>
            <input type="text" name="direccion" class="form-control" value="{{ old('direccion', $proveedor->direccion) }}">
        </div>

        <div class="mb-3">
            <label>Correo</label>
            <input type="email" name="correo" class="form-control" value="{{ old('correo', $proveedor->correo) }}">
        </div>

        <div class="mb-3">
            <label>Contacto</label>
            <input type="text" name="contacto" class="form-control" value="{{ old('contacto', $proveedor->contacto) }}">
        </div>

        <div class="mb-3">
            <label>Datos de Facturación</label>
            <textarea name="datos_facturacion" class="form-control">{{ old('datos_facturacion', $proveedor->datos_facturacion) }}</textarea>
        </div>

        <button type="submit" class="btn btn-actualizar">Actualizar</button>
    </form>

    <div class="volver-btn">
        <a href="{{ url('proveedores') }}" class="btn btn-secondary">Volver al Listado</a>
    </div>
</div>

</body>
</html>
