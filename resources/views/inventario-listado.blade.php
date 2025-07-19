<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro de Inventario - Diverland</title>
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
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }
        header {
            background-color: white;
            color: #ff6f00;
            padding: 20px 0;
            text-align: center;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
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
        .table thead {
            background-color: #ff6f00;
            color: white;
        }
        footer {
            margin-top: auto;
            background-color: white;
            color: #ff6f00;
            text-align: center;
            padding: 15px;
            box-shadow: 0 -4px 8px rgba(0,0,0,0.1);
        }
    </style>
</head>
<body>

<header>
    <h1>Registro de Inventario - Diverland</h1>
    <h2 class="text-center mb-4">Listado de Productos e Insumos</h2>

    <nav>
        <a href="{{ url('menu') }}"><i class="fas fa-arrow-left"></i> Volver al Menú</a>
        <a href="{{ url('login') }}"><i class="fas fa-sign-out-alt"></i> Cerrar Sesión</a>
        <a href="{{ route('inventario.pdf') }}" class="btn btn-success mb-3">
    <i class="fas fa-file-pdf"></i> Descargar PDF
</a>

    </nav>
</header>

<div class="container mt-4">
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="table-responsive">
        <table class="table table-bordered text-center align-middle">
            <thead>
                <tr>
                    <th>Referencia</th>
                    <th>Producto</th>
                    <th>Precio por Unidad ($)</th>
                    <th>Precio de Venta ($)</th>
                    <th>Fecha de Compra</th>
                    <th>Fecha de Vencimiento</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($productos as $producto)
                    <tr>
                        <td>{{ $producto->referencia }}</td>
                        <td>{{ $producto->producto }}</td>
                        <td>{{ number_format($producto->precio_unidad, 2) }}</td>
                        <td>{{ number_format($producto->precio_venta, 2) }}</td>
                        <td>{{ \Carbon\Carbon::parse($producto->fecha_compra)->format('Y-m-d') }}</td>
                        <td>{{ $producto->fecha_vencimiento ? \Carbon\Carbon::parse($producto->fecha_vencimiento)->format('Y-m-d') : 'N/A' }}</td>
                        <td>
                            <a href="{{ route('inventario.editar', $producto->id) }}" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i> Editar</a>

                            @if(Auth::check() && Auth::user()->email === 'admin@diverland.com')
                            <form action="{{ route('inventario.eliminar', $producto->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('¿Estás seguro de eliminar este producto?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i> Eliminar</button>
                            </form>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<footer>
    <p>&copy; 2025 Diverland - Todos los derechos reservados</p>
</footer>

</body>
</html>
