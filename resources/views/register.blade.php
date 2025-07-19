<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro - Diverland</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <!-- Fuente Roboto Mono para fallback -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Mono:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <style>
        body {
            font-family: 'Roboto Mono', monospace !important;
            background-image: url('https://example.com/imagen-fondo.jpg'); /* Cambia por la URL real del fondo */
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .card {
            background-color: rgba(255, 255, 255, 0.9);
            border-radius: 20px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
            padding: 30px;
            width: 100%;
            max-width: 450px;
        }

        .card-header {
            background-color: #28a745;
            color: white;
            border-radius: 15px 15px 0 0;
            padding: 15px;
            text-align: center;
            font-size: 1.5rem;
        }

        .btn-success {
            background-color: #28a745;
            border: none;
            padding: 12px;
            font-weight: bold;
            border-radius: 10px;
        }

        .btn-success:hover {
            background-color: #218838;
        }

        .form-control {
            border-radius: 10px;
            padding: 12px;
        }

        label {
            font-weight: 500;
            color: #28a745;
        }

        .logo {
            display: block;
            margin: 0 auto 20px;
            width: 120px;
        }

        footer {
            position: absolute;
            bottom: 10px;
            width: 100%;
            text-align: center;
            color: white;
            font-size: 0.9rem;
            background-color: rgba(0, 0, 0, 0.5);
            padding: 10px 0;
        }

    </style>
</head>
<body>

<div class="col-md-4">
    <div class="card">
        <img src="https://cdn-icons-png.flaticon.com/512/3534/3534086.png" class="logo" alt="Diverland logo">
        <div class="card-header">Registro de Usuario</div>
        <div class="card-body">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form action="{{ route('register.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Nombre</label>
                    <input type="text" class="form-control" id="name" name="name" required autofocus>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Correo Electrónico</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Contraseña</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>
                <button type="submit" class="btn btn-success w-100">Registrarse</button>
                <div class="text-center mt-3">
                    <a href="{{ route('login') }}">¿Ya tienes cuenta? Inicia sesión</a>
                </div>
            </form>
        </div>
    </div>
</div>

<footer>
    <p>&copy; 2025 Diverland. Todos los derechos reservados.</p>
</footer>

</body>
</html>
