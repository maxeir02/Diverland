<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Producto</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <!-- Fuente Roboto Mono para fallback -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Mono:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <style>
        body {
            font-family: 'Roboto Mono', monospace !important;
        }
    </style>
</head>
<body class="container mt-5">
    <h2 class="mb-4">Editar Producto</h2>

    <!-- Mostrar errores de validación -->
    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>¡Atención!</strong> Por favor corrige los siguientes errores:<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Formulario de edición -->
    <form action="{{ route('inventario.actualizar', $producto->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Referencia</label>
            <input type="text" name="referencia" class="form-control" value="{{ $producto->referencia }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Nombre del Producto</label>
            <input type="text" name="producto" class="form-control" value="{{ $producto->producto }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Precio por Unidad</label>
            <input type="number" step="0.01" name="precio_unidad" class="form-control" value="{{ $producto->precio_unidad }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Precio de Venta</label>
            <input type="number" step="0.01" name="precio_venta" class="form-control" value="{{ $producto->precio_venta }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Fecha de Compra</label>
            <input type="date" name="fecha_compra" class="form-control" value="{{ $producto->fecha_compra }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Fecha de Vencimiento (opcional)</label>
            <input type="date" name="fecha_vencimiento" class="form-control" value="{{ $producto->fecha_vencimiento }}">
        </div>

        <button type="submit" class="btn btn-primary">Actualizar</button>
        <a href="{{ route('inventario.listado') }}" class="btn btn-secondary">Volver al listado</a>
    </form>
</body>
</html>
