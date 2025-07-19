<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Inventario PDF</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
            color: #333;
        }
        header {
            text-align: center;
            margin-bottom: 10px;
        }
        .logo {
            width: 120px;
            height: auto;
            margin-bottom: 5px;
        }
        .timestamp {
            font-size: 12px;
            color: #666;
        }
        h1, h2 {
            text-align: center;
            color: #ff6f00;
            margin-bottom: 10px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }
        th, td {
            border: 1px solid #999;
            padding: 6px;
            text-align: center;
        }
        thead {
            background-color: #ff6f00;
            color: white;
        }
    </style>
</head>
<body>
<header style="text-align: center; margin-bottom: 20px;">
    <img src="{{ public_path('images/logo.png') }}" width="100" alt="DiverLand" class="logo">
    <p style="font-size: 14px; margin-top: 10px;">
        Fecha de generación: {{ \Carbon\Carbon::now()->format('d/m/Y H:i:s') }}
    </p>
</header>

    <h1>Registro de Inventario - Diverland</h1>
    <h2>Listado de Productos e Insumos</h2>

    <table>
        <thead>
            <tr>
                <th>Referencia</th>
                <th>Producto</th>
                <th>Precio Unidad ($)</th>
                <th>Precio Venta ($)</th>
                <th>Fecha Compra</th>
                <th>Fecha Vencimiento</th>
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
                    <td>
                        {{ $producto->fecha_vencimiento ? \Carbon\Carbon::parse($producto->fecha_vencimiento)->format('Y-m-d') : 'N/A' }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

</body>
</html>
