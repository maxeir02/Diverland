<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Clientes - PDF</title>
    <style>
        body {
            font-family: sans-serif;
            font-size: 12px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #444;
            padding: 5px;
            text-align: center;
        }
        th {
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
    <h2 style="text-align: center;">Listado de Clientes - Diverland</h2>
    <table>
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Edad</th>
                <th>Tiempo Pagado</th>
                <th>Hora de Entrada</th>
                <th>Hora de Salida</th>
                <th>Método de Pago</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($clientes as $cliente)
                @php
                    $entrada = \Carbon\Carbon::parse($cliente->hora_entrada);
                    $salida = $entrada->copy()->addHours($cliente->tiempo_pago);
                @endphp
                <tr>
                    <td>{{ $cliente->nombre }}</td>
                    <td>{{ $cliente->edad }}</td>
                    <td>
                        @if($cliente->tiempo_pago == 99)
                            Manilla todo el día
                        @else
                            @php
                                $horas = floor($cliente->tiempo_pago);
                                $minutos = round(($cliente->tiempo_pago - $horas) * 60);
                            @endphp
                            @if($horas > 0)
                                {{ $horas }} h
                            @endif
                            @if($minutos > 0)
                                {{ $minutos }} m
                            @endif
                            @if($horas == 0 && $minutos == 0)
                                0 m
                            @endif
                        @endif
                    </td>
                    <td>{{ $entrada->format('Y-m-d H:i') }}</td>
                    <td>{{ $salida->format('Y-m-d H:i') }}</td>
                    <td>{{ ucfirst(str_replace('_', ' ', $cliente->metodo_pago)) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
