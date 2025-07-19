<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Proveedores - Diverland</title>
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

        h1, h2 {
            color: #ff6f00;
            text-align: center;
        }

        .btn-guardar {
            background-color: #007bff;
            color: white;
        }

        .btn-guardar:hover {
            background-color: #0056b3;
        }

        .table th {
            background-color: #ffe0b2;
        }

        .volver-btn {
            display: block;
            margin: 20px auto;
            text-align: center;
        }
    </style>
</head>
<body>

<h1>Gestión de Proveedores</h1>
<h2>Agregar o Actualizar Proveedor</h2>

<div class="container">
    <!-- Formulario -->
    <form method="POST" action="{{ url('proveedores/guardar') }}">
        @csrf
        <input type="hidden" name="id" value="{{ isset($proveedor) ? $proveedor->id : '' }}">

        <div class="row">
            <div class="col-md-6 mb-3">
                <label>Nombre</label>
                <input type="text" name="nombre" class="form-control" value="{{ $proveedor->nombre ?? '' }}" required>
            </div>

            <div class="col-md-6 mb-3">
                <label>Dirección</label>
                <input type="text" name="direccion" class="form-control" value="{{ $proveedor->direccion ?? '' }}">
            </div>

            <div class="col-md-6 mb-3">
                <label>Correo</label>
                <input type="email" name="correo" class="form-control" value="{{ $proveedor->correo ?? '' }}">
            </div>

            <div class="col-md-6 mb-3">
                <label>Contacto</label>
                <input type="text" name="contacto" class="form-control" value="{{ $proveedor->contacto ?? '' }}">
            </div>

            <div class="col-12 mb-3">
                <label>Datos de Facturación</label>
                <textarea name="facturacion" class="form-control">{{ $proveedor->facturacion ?? '' }}</textarea>
            </div>
        </div>

        <button type="submit" class="btn btn-guardar">Guardar Proveedor</button>
    </form>

    <hr>

    <!-- Tabla de proveedores -->
    <h2 class="mt-5">Listado de Proveedores</h2>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Dirección</th>
                <th>Correo</th>
                <th>Contacto</th>
                <th>Facturación</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($proveedores as $prov)
                <tr>
                    <td>{{ $prov->nombre }}</td>
                    <td>{{ $prov->direccion }}</td>
                    <td>{{ $prov->correo }}</td>
                    <td>{{ $prov->contacto }}</td>
                    <td>{{ $prov->facturacion }}</td>
                    <td>
                        <a href="{{ url('proveedores/editar/'.$prov->id) }}" class="btn btn-sm btn-warning">Editar</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="volver-btn">
        <a href="{{ url('menu') }}" class="btn btn-secondary">Volver al Menú</a>
    </div>
</div>

</body>
</html>
