<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title>Ingreso de Clientes - Diverland</title>
<meta name="csrf-token" content="{{ csrf_token() }}" />
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link href="https://fonts.googleapis.com/css2?family=Baloo+2:wght@400;500;600&display=swap" rel="stylesheet" />
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
<!-- Fuente Roboto Mono para fallback -->
<link href="https://fonts.googleapis.com/css2?family=Roboto+Mono:wght@400;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('css/app.css') }}">
<style>
    :root {
        --color-principal: #ff6f00;
        --color-secundario: #4CAF50;
        --color-fondo: #f4f4f9;
        --color-texto: #333;
    }

    /* Reset y base */
    * {
        box-sizing: border-box;

    }

    body {
        font-family: 'Roboto Mono', monospace !important;
        background-color: white;
        color: var(--color-texto);
        margin: 0;
        min-height: 100vh;
        display: flex;
        flex-direction: column;
        overflow-x: hidden;
    }

    body::before {
        content: "";
        position: fixed;
        top: 0; left: 0; right: 0; bottom: 0;
        pointer-events: none;
        background-image:
            radial-gradient(circle, #ff6f00 3px, transparent 4px),
            radial-gradient(circle, #f44336 3px, transparent 4px),
            radial-gradient(circle, #4caf50 3px, transparent 4px),
            radial-gradient(circle, #2196f3 3px, transparent 4px),
            radial-gradient(circle, #9c27b0 3px, transparent 4px);
        background-size: 80px 80px;
        background-position: 0 0, 40px 40px, 20px 60px, 60px 20px, 80px 80px;
        opacity: 0.15;
        z-index: 0;
    }

    header, footer {
        background-color: var(--color-principal);
        color: white;
        text-align: center;
        padding: 12px 15px;
        font-weight: 600;
        box-shadow: 0 6px 12px rgba(0,0,0,0.15);
        z-index: 1;
    }
    header {
        font-size: 1.5rem;
        border-radius: 10px 10px 0 0;
    }
    footer {
        font-size: 0.875rem;
        border-radius: 0 0 10px 10px;
        margin-top: auto;
    }

    main {
        flex-grow: 1;
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 15px 10px;
        z-index: 1;
    }

    .form-container {
        background-color: #fff;
        border-radius: 12px;
        padding: 25px 25px 20px;
        max-width: 500px;
        width: 100%;
        box-shadow: 0 4px 10px rgba(0,0,0,0.12);
        border: 1px solid #ddd;
    }

    .form-container h2 {
        margin: 0 0 18px;
        font-size: 1.4rem;
        font-weight: 600;
        color: var(--color-texto);
        text-align: center;
    }

    label {
        display: block;
        margin-bottom: 6px;
        font-size: 0.9rem;
        font-weight: 500;
        color: var(--color-texto);
    }

    input[type="text"],
    input[type="number"],
    input[type="time"],
    select {
        width: 100%;
        padding: 9px 11px;
        margin-bottom: 16px;
        border-radius: 8px;
        border: 1px solid #bbb;
        font-size: 0.9rem;
        font-family: 'Roboto Mono', monospace !important;
        transition: border-color 0.25s ease;
        background-color: #fafafa;
    }

    input[type="text"]:focus,
    input[type="number"]:focus,
    input[type="time"]:focus,
    select:focus {
        border-color: var(--color-principal);
        outline: none;
        background-color: #fff;
    }

    /* Estilos para el campo de tiempo simplificado */
    #tiempo_pago {
        text-align: center;
        font-weight: 500;
        font-size: 1rem;
    }

    /* Preview del tiempo total */
    .tiempo-preview {
        background-color: #f8f9fa;
        border: 1px solid #dee2e6;
        border-radius: 8px;
        padding: 12px;
        margin-bottom: 16px;
        text-align: center;
        font-weight: 600;
        color: var(--color-principal);
        font-size: 1rem;
    }

    input[type="submit"] {
        background-color: var(--color-principal);
        color: white;
        cursor: pointer;
        border: none;
        font-size: 1rem;
        padding: 11px 0;
        border-radius: 10px;
        font-weight: 600;
        transition: background-color 0.3s ease;
        width: 100%;
        margin-top: 5px;
        box-shadow: 0 3px 7px rgba(255,111,0,0.6);
    }

    input[type="submit"]:hover {
        background-color: #e65c00;
    }

    input[type="submit"]:disabled {
        background-color: #ccc;
        cursor: not-allowed;
    }

    .btn-ver-clientes {
        background-color: var(--color-secundario);
        color: white;
        padding: 10px 0;
        border-radius: 10px;
        font-size: 0.95rem;
        width: 100%;
        border: none;
        cursor: pointer;
        font-weight: 600;
        transition: background-color 0.3s ease;
        margin-top: 12px;
        box-shadow: 0 3px 7px rgba(76,175,80,0.5);
    }

    .btn-ver-clientes:hover {
        background-color: #45a049;
    }

    #mensaje {
        text-align: center;
        font-weight: 600;
        margin-top: 10px;
        font-size: 0.9rem;
        min-height: 24px;
        color: var(--color-texto);
    }

    /* Responsivo */
    @media (max-width: 480px) {
        .form-container {
            padding: 20px 15px 15px;
            max-width: 100%;
        }
        header {
            font-size: 1.3rem;
            padding: 10px 12px;
        }
        footer {
            font-size: 0.8rem;
            padding: 8px 12px;
        }
    }
</style>
</head>
<body>
<header>
    <h1>Ingreso de Clientes - Diverland</h1>
</header>

<main>
    <div class="form-container" role="form">
        <h2>Formulario de Registro de Cliente</h2>
        <form id="registroClienteForm" action="{{ route('clientes.store') }}" method="POST" novalidate>
            @csrf
            <label for="nombre">Nombre del Cliente:</label>
            <input type="text" id="nombre" name="nombre" required placeholder="Ingrese el nombre completo" autocomplete="off" />

            <label for="edad">Edad del Cliente:</label>
            <input type="number" id="edad" name="edad" required placeholder="Ingrese la edad" min="1" />

            <label for="tiempo_pago"><i class="fas fa-clock"></i> Tiempo Pagado:</label>
            <select id="tiempo_pago" name="tiempo_pago" required>
                <option value="">-- Seleccione --</option>
                <option value="0.25">15 minutos</option>
                <option value="0.5">30 minutos</option>
                <option value="1">1 hora</option>
                <option value="99">Manilla todo el día</option>
            </select>

            <div class="tiempo-preview" id="tiempoPreview">
                <i class="fas fa-timer"></i>
                Tiempo: <span id="tiempoTotal">0 horas</span>
            </div>

            <label for="metodo_pago">Método de Pago:</label>
            <select id="metodo_pago" name="metodo_pago" required>
                <option value="">-- Seleccione --</option>
                <option value="efectivo">Efectivo</option>
                <option value="transferencia">Transferencia Bancaria</option>
            </select>

            <!-- Elimina este bloque del formulario -->
            <!--
            <label for="hora_entrada">Hora de Entrada:</label>
            <input type="time" id="hora_entrada" name="hora_entrada" required />
            -->

            <!-- Agrega este campo oculto en el formulario -->
            <input type="hidden" id="hora_entrada" name="hora_entrada" />
            <input type="hidden" id="hora_salida" name="hora_salida" />

            <input type="submit" value="Registrar" />
        </form>

        <form action="{{ route('clientes.listado') }}" method="GET" aria-label="Ver clientes registrados">
            <input type="submit" class="btn-ver-clientes" value="Ver Clientes Registrados" />
        </form>

        <div id="mensaje" aria-live="polite"></div>
    </div>
</main>

<footer>
    <p>&copy; 2025 Diverland. Todos los derechos reservados.</p>
</footer>

<script>
    // Configura token CSRF para AJAX
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    // Función para actualizar el preview del tiempo
    function actualizarTiempoPreview() {
        const valor = $('#tiempo_pago').val();
        let textoTiempo = '';

        if (valor === '0.25') {
            textoTiempo = '15 minutos';
        } else if (valor === '0.5') {
            textoTiempo = '30 minutos';
        } else if (valor === '1') {
            textoTiempo = '1 hora';
        } else if (valor === '99') {
            textoTiempo = 'Manilla de todo el día (válida hasta las 8:00 pm)';
        } else {
            textoTiempo = '0 horas';
        }

        $('#tiempoTotal').text(textoTiempo);

        // Cambiar color del preview según si hay tiempo o no
        const preview = $('#tiempoPreview');
        if (!valor) {
            preview.css('background-color', '#ffe6e6');
            preview.css('color', '#d32f2f');
        } else {
            preview.css('background-color', '#e8f5e8');
            preview.css('color', '#2e7d32');
        }
    }

    $(document).ready(function() {
        $('#tiempo_pago').on('change', actualizarTiempoPreview);
        actualizarTiempoPreview();

        $('#registroClienteForm').on('submit', function(e) {
            e.preventDefault();
            $('#mensaje').html('');

            let edad = parseInt($('#edad').val());
            let tiempo_pago = $('#tiempo_pago').val();

            // Validaciones
            if (isNaN(edad) || edad <= 0) {
                $('#mensaje').html('<p style="color: red;"><i class="fas fa-exclamation-triangle"></i> Ingrese una edad válida mayor que 0.</p>');
                return;
            }
            if (!tiempo_pago) {
                $('#mensaje').html('<p style="color: red;"><i class="fas fa-exclamation-triangle"></i> Seleccione un tiempo pagado.</p>');
                return;
            }
            if ($('#metodo_pago').val() === '') {
                $('#mensaje').html('<p style="color: red;"><i class="fas fa-exclamation-triangle"></i> Seleccione un método de pago.</p>');
                return;
            }

            // Hora de entrada actual
            const now = new Date();
            const fecha = now.toISOString().slice(0, 10); // yyyy-mm-dd
            const hora = now.getHours().toString().padStart(2, '0');
            const minutos = now.getMinutes().toString().padStart(2, '0');
            $('#hora_entrada').val(`${fecha} ${hora}:${minutos}:00`);

            // Si es manilla, hora de salida fija a las 20:00 del mismo día
            if (tiempo_pago === '99') {
                $('#hora_salida').val(`${fecha} 20:00:00`);
            } else {
                $('#hora_salida').val('');
            }

            let btn = $(this).find('input[type=submit]');
            btn.val('Registrando...').prop('disabled', true);

            let formData = $(this).serialize();

            $.ajax({
                url: $(this).attr('action'),
                type: 'POST',
                data: formData,
                success: function(response) {
                    $('#mensaje').html('<p style="color: green;"><i class="fas fa-check-circle"></i> Cliente registrado con éxito!</p>');
                    $('#registroClienteForm')[0].reset();
                    actualizarTiempoPreview();
                    btn.val('Registrar').prop('disabled', false);
                },
                error: function(xhr) {
                    btn.val('Registrar').prop('disabled', false);
                    if (xhr.status === 422) {
                        let errors = xhr.responseJSON.errors;
                        let mensajes = '';
                        $.each(errors, function(key, value) {
                            mensajes += `<p style="color: red;"><i class="fas fa-times-circle"></i> ${value[0]}</p>`;
                        });
                        $('#mensaje').html(mensajes);
                    } else {
                        $('#mensaje').html('<p style="color: red;"><i class="fas fa-times-circle"></i> Error al registrar cliente.</p>');
                    }
                }
            });
        });
    });
</script>
</body>
</html>
