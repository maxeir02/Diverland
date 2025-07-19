<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Factura - Diverland</title>
    <!-- Fuente Roboto Mono para fallback -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Mono:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <style>
        /* Estilos sencillos para mostrar la factura */
        body {
            font-family: 'Roboto Mono', monospace !important;
            background-color: #f4f4f9;
            padding: 20px;
        }

        .factura-container {
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 800px;
            margin: 0 auto;
        }

        .factura-container h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        .factura-container table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .factura-container table th, .factura-container table td {
            padding: 10px;
            border: 1px solid #ccc;
            text-align: left;
        }

        .factura-container .edit-btn {
            background-color: #2a2a72;
            color: white;
            padding: 10px;
            border-radius: 5px;
            text-decoration: none;
            font-size: 16px;
        }

        .factura-container .edit-btn:hover {
            background-color: #555;
        }
    </style>
</head>
<body>

    <div class="factura-container">
        <h2>Factura de Cliente - Diverland</h2>

        <table>
            <tr>
                <th>Nombre</th>
                <td>{{ $cliente->nombre }}</td>
            </tr>
            <tr>
                <th>Edad</th>
                <td>{{ $cliente->edad }}</td>
            </tr>
            <tr>
                <th>Tiempo Pagado (en horas)</th>
                <td>{{ $cliente->tiempo_pago }}</td>
            </tr>
            <tr>
                <th>Hora de Entrada</th>
                <td>{{ $cliente->hora_entrada }}</td>
            </tr>
            <tr>
                <th>Método de Pago</th>
                <td>{{ $cliente->metodo_pago }}</td>
            </tr>
        </table>

        <a href="{{ route('clientes.edit', ['id' => $cliente->id]) }}" class="edit-btn">Editar Datos</a>
    </div>

</body>
</html>
