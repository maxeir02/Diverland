<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Listado de Clientes - Diverland</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Bootstrap y fuentes -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
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

        .table thead {
            background-color: #ff6f00;
            color: white;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 8px 12px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 0.9rem;
            width: 30px;  /* Ancho fijo para todos los botones */
            height: 30px; /* Alto fijo para todos los botones */
            margin: 2px;  /* Pequeño margen entre botones */
        }

        /* Contenedor de acciones para alinear mejor */
        .acciones-container {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 5px; /* Espacio entre botones */
            flex-wrap: wrap; /* Permite que los botones se ajusten en pantallas pequeñas */
        }

        .btn-editar {
            background-color: #ffa500;
            color: white;
        }

        .btn-editar:hover {
            background-color: #e08500;
        }

        .btn-agregar-tiempo {
            background-color: #4CAF50;
            color: white;
        }

        .btn-agregar-tiempo:hover {
            background-color: #45a049;
        }

        .btn-borrar {
            background-color: red;
            color: white;
        }

        .btn-borrar:hover {
            background-color: #c13521;
        }

        /* Asegurar que los iconos estén centrados */
        .btn i {
            font-size: 16px;
        }

        /* Para pantallas más pequeñas */
        @media (max-width: 768px) {
            .btn {
                width: 35px;
                height: 35px;
                padding: 6px;
            }
            
            .btn i {
                font-size: 14px;
            }
        }

        footer {
            margin-top: auto;
            background-color: white;
            color: #ff6f00;
            text-align: center;
            padding: 15px;
            box-shadow: 0 -4px 8px rgba(0,0,0,0.1);
        }
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            justify-content: center;
            align-items: center;
            z-index: 999;
        }

        .modal-content {
            position: relative;
            padding: 30px;
            border-radius: 15px;
            width: 90%;
            max-width: 400px;
            background-color: white;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
            margin: 20px;
            animation: modalFadeIn 0.3s ease-out;
        }

        @keyframes modalFadeIn {
            from {
                opacity: 0;
                transform: scale(0.8) translateY(-50px);
            }
            to {
                opacity: 1;
                transform: scale(1) translateY(0);
            }
        }

        .close {
            position: absolute;
            top: 10px;
            right: 15px;
            background-color: #ff4444;
            color: white;
            padding: 8px 12px;
            border-radius: 50%;
            cursor: pointer;
            border: none;
            font-size: 16px;
            font-weight: bold;
            transition: all 0.3s ease;
            width: 35px;
            height: 35px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .close:hover {
            background-color: #cc0000;
            transform: scale(1.1);
        }

        .modal h2 {
            color: #ff6f00;
            margin-bottom: 20px;
            margin-top: 10px;
            text-align: center;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            color: #333;
            font-weight: 600;
        }

        .form-control {
            width: 100%;
            padding: 12px;
            border: 2px solid #ddd;
            border-radius: 8px;
            font-size: 16px;
            transition: border-color 0.3s ease;
        }

        .form-control:focus {
            outline: none;
            border-color: #ff6f00;
            box-shadow: 0 0 0 3px rgba(255, 111, 0, 0.1);
        }

        .btn-primary {
            background-color: #ff6f00;
            border: none;
            padding: 12px;
            border-radius: 8px;
            color: white;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #e55a00;
            transform: translateY(-2px);
        }

        .tiempo-terminado {
            background-color: #ffe6e6 !important;
        }
    </style>
</head>
<body>

<header>
    <h1>Listado de Clientes Registrados - Diverland</h1>
    <h2 class="text-center mb-4">¡Diverland: Donde la diversión nunca termina!</h2>

    <nav>
        <a href="{{ url('menu') }}"><i class="fas fa-arrow-left"></i> Volver al Menú</a>
        <a href="{{ url('login') }}"><i class="fas fa-sign-out-alt"></i> Cerrar Sesión</a>
        <a href="http://127.0.0.1:8000/registroc">
    <button type="button" style="margin-top: 10px; background-color: #007bff; color: white; padding: 10px 20px; border: none; border-radius: 5px;">
        Ir al Registro de Cliente
    </button>
    
</a>
<a href="{{ route('clientes.pdf') }}" target="_blank">
    <button type="button" style="margin-top: 10px; background-color: #4caf50; color: white; padding: 10px 20px; border: none; border-radius: 5px;">
        <i class="fas fa-file-pdf"></i> Descargar PDF de Clientes
    </button>
</a>
    </nav>
</header>

<div class="container mt-4">
    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif
    <div class="table-responsive">
        <table class="table table-bordered text-center align-middle">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Edad</th>
                    <th>Tiempo Pagado</th>
                    <th>Hora de Entrada</th>
                    <th>Hora de Salida</th>
                    <th>Método de Pago</th>
                    <th>Tiempo Restante</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
              
    @foreach ($clientes as $cliente)
    @php
        $timezone = config('app.timezone');
        $entrada = \Carbon\Carbon::parse($cliente->hora_entrada)->setTimezone($timezone);

        if ($cliente->tiempo_pago == 99) {
            $salida = $entrada->copy()->setTime(20, 0, 0);
        } else {
            $horas = floor($cliente->tiempo_pago);
            $minutos = round(($cliente->tiempo_pago - $horas) * 60);
            $salida = $entrada->copy()->addHours($horas)->addMinutes($minutos);
        }
        $tiempoRestante = now()->diffInSeconds($salida, false); // <-- CORRECTO
    @endphp
    <tr class="{{ $tiempoRestante <= 0 ? 'tiempo-terminado' : '' }}" data-id="{{ $cliente->id }}" data-tiempo-restante="{{ $tiempoRestante }}" data-nombre="{{ $cliente->nombre }}">
        <td>{{ $cliente->nombre }}</td>
        <td>{{ $cliente->edad }}</td>
        <td id="tiempo_pago_cliente_{{ $cliente->id }}">
            @if($cliente->tiempo_pago == 99)
                Manilla todo el día
            @else
                @if($horas > 0)
                    {{ $horas }}h
                @endif
                @if($minutos > 0 || $horas == 0)
                    {{ $minutos }}m
                @endif
            @endif
        </td>
        <td>{{ $entrada->format('Y-m-d H:i:s') }}</td>
        <td>{{ $salida->format('Y-m-d H:i:s') }}</td>
        <td>{{ ucfirst(str_replace('_', ' ', $cliente->metodo_pago)) }}</td>
        <td class="tiempo-restante"></td>
        <td>
            <div class="acciones-container">
                <button class="btn btn-editar" onclick="editarCliente({{ $cliente->id }})" title="Editar">
                    <i class="fas fa-edit"></i>
                </button>
                <button class="btn btn-agregar-tiempo" onclick="agregarTiempo({{ $cliente->id }})" title="Agregar Tiempo"
    @if($cliente->tiempo_pago == 99) disabled style="opacity:0.5;cursor:not-allowed;" @endif>
    <i class="fas fa-clock"></i>
</button>
                <button class="btn btn-borrar" onclick="borrarCliente({{ $cliente->id }})" title="Borrar">
                    <i class="fas fa-trash"></i>
                </button>
            </div>
        </td>
    </tr>
@endforeach
            </tbody>
        </table>
    </div>
</div>

<footer>
    <p>&copy; 2025 Diverland - Todos los derechos reservados</p>
    <p><a href="https://www.instagram.com/diverlandplay?utm_source=ig_web_button_share_sheet&igsh=ZDNlZDc0MzIxNw==" target="_blank" style="color: white;">Síguenos en Instagram</a></p>
</footer>

<!-- Modal para agregar tiempo -->
<div id="agregarTiempoModal" class="modal">
    <div class="modal-content">
        <button class="close" onclick="closeModal()">&times;</button>
        <h2><i class="fas fa-clock"></i> Agregar Tiempo</h2>
        <form id="agregarTiempoForm">
            @csrf
            <input type="hidden" id="cliente_id" name="cliente_id">
            <div class="form-group">
                <label for="horas"><i class="fas fa-hourglass-half"></i> Horas:</label>
                <input type="number" id="horas" name="horas" min="0" max="24" value="0" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="minutos"><i class="fas fa-clock"></i> Minutos:</label>
                <input type="number" id="minutos" name="minutos" min="0" max="59" value="0" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary w-100">
                <i class="fas fa-plus"></i> Agregar Tiempo
            </button>
        </form>
    </div>
</div>

<script>
    function openModal(clienteId) {
        document.getElementById('cliente_id').value = clienteId;
        document.getElementById('agregarTiempoModal').style.display = 'flex';
    }

    function agregarTiempo(clienteId) {
        document.getElementById('cliente_id').value = clienteId;
        document.getElementById('horas').value = '0';
        document.getElementById('minutos').value = '0';
        document.getElementById('agregarTiempoModal').style.display = 'flex';
        
        // Enfocar el primer input
        setTimeout(() => {
            document.getElementById('horas').focus();
        }, 100);
    }

    function closeModal() {
        document.getElementById('agregarTiempoModal').style.display = 'none';
    }

    // Cerrar modal con ESC
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeModal();
        }
    });

    // Cerrar modal al hacer clic fuera de él
    document.getElementById('agregarTiempoModal').addEventListener('click', function(e) {
        if (e.target === this) {
            closeModal();
        }
    });

    document.getElementById('agregarTiempoForm').addEventListener('submit', function(e) {
        e.preventDefault();
        
        const clienteId = document.getElementById('cliente_id').value;
        const horas = parseInt(document.getElementById('horas').value) || 0;
        const minutos = parseInt(document.getElementById('minutos').value) || 0;
        
        // Validación básica
        if (horas === 0 && minutos === 0) {
            alert('Debes agregar al menos 1 minuto');
            return;
        }
        
        // Deshabilitar botón durante la petición
        const submitBtn = this.querySelector('button[type="submit"]');
        const originalText = submitBtn.innerHTML;
        submitBtn.disabled = true;
        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Agregando...';
        
        const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        fetch('/clientes/agregar-tiempo', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': token
            },
            body: JSON.stringify({
                cliente_id: clienteId,
                horas: horas,
                minutos: minutos
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Actualizar el tiempo en la tabla sin recargar
                const elementoTiempo = document.getElementById('tiempo_pago_cliente_' + clienteId);
                if (elementoTiempo) {
                    elementoTiempo.textContent = data.nuevo_tiempo + ' h';
                }
                
                // Actualizar tiempo restante en la fila
                const fila = document.querySelector(`tr[data-id="${clienteId}"]`);
                if (fila) {
                    const tiempoRestanteActual = parseInt(fila.getAttribute('data-tiempo-restante'));
                    const tiempoAgregado = (horas * 3600) + (minutos * 60);
                    const nuevoTiempoRestante = tiempoRestanteActual + tiempoAgregado;
                    fila.setAttribute('data-tiempo-restante', nuevoTiempoRestante);
                    
                    // Remover clase de tiempo terminado si tenía
                    fila.classList.remove('tiempo-terminado');
                }
                
                closeModal();
                
                // Mostrar notificación de éxito
                mostrarNotificacion('Tiempo agregado correctamente', 'success');
            } else {
                mostrarNotificacion('Error: ' + data.message, 'error');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            mostrarNotificacion('Error al actualizar el tiempo', 'error');
        })
        .finally(() => {
            // Rehabilitar botón
            submitBtn.disabled = false;
            submitBtn.innerHTML = originalText;
        });
    });

    // Función para mostrar notificaciones
    function mostrarNotificacion(mensaje, tipo) {
        const notificacion = document.createElement('div');
        notificacion.className = `alert alert-${tipo === 'success' ? 'success' : 'danger'} position-fixed`;
        notificacion.style.cssText = `
            top: 20px;
            right: 20px;
            z-index: 9999;
            min-width: 300px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.2);
        `;
        notificacion.innerHTML = `
            <i class="fas fa-${tipo === 'success' ? 'check-circle' : 'exclamation-triangle'}"></i>
            ${mensaje}
        `;
        
        document.body.appendChild(notificacion);
        
        // Remover después de 3 segundos
        setTimeout(() => {
            notificacion.remove();
        }, 3000);
    }

    function editarCliente(id) {
        window.location.href = `/clientes/${id}/editar`;
    }

    function borrarCliente(id) {
        if (confirm('¿Estás seguro de borrar este cliente?')) {
            const form = document.getElementById('form-borrar');
            form.action = `/clientes/${id}`;
            form.submit();
        }
    }

    function actualizarTiempos() {
        const filas = document.querySelectorAll('tr[data-tiempo-restante]');
        filas.forEach(fila => {
            let restante = parseInt(fila.getAttribute('data-tiempo-restante'));
            const span = fila.querySelector('.tiempo-restante');

            if (restante <= 0) {
                fila.classList.add('tiempo-terminado');
                span.textContent = 'Tiempo terminado';
            } else {
                const h = Math.floor(restante / 3600);
                const m = Math.floor((restante % 3600) / 60);
                const s = restante % 60;
                span.textContent = `${h}h ${m}m ${s}s`;
                fila.setAttribute('data-tiempo-restante', restante - 1);
            }
        });
    }

    setInterval(actualizarTiempos, 1000);
</script>

<form id="form-borrar" method="POST" style="display: none;">
    @csrf
    @method('DELETE')
</form>

</body>
</html>
