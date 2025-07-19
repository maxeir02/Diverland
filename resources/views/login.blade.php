<!-- resources/views/auth/login.blade.php -->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Diverland</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <!-- Fuente Roboto Mono para fallback -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Mono:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <style>
        body {
            font-family: 'Roboto Mono', monospace !important;
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
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

        .card {
            background-color: rgba(255, 255, 255, 0.9);
            border-radius: 20px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
            padding: 30px;
            width: 100%;
            max-width: 400px;
        }

        .card-header {
            background-color: #ff6f00;
            color: white;
            border-radius: 15px 15px 0 0;
            padding: 15px;
            text-align: center;
            font-size: 1.5rem;
        }

        .btn-primary {
            background-color: #ff6f00;
            border: none;
            padding: 12px;
            font-weight: bold;
            border-radius: 10px;
        }

        .btn-primary:hover {
            background-color: #e65c00;
        }

        .form-control {
            border-radius: 10px;
            padding: 12px;
        }

        .logo {
            display: block;
            margin: 0 auto 20px;
            width: 160px;
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

        .col-md-4 {
            flex: 0 0 auto;
            width: auto;
        }
    </style>
</head>
<body>

<div class="col-md-4">
    <div class="card">
        <img src= "{{ asset('imagenes/logo.png')}}" class="logo" alt="Diverland logo">
        <div class="card-header">Bienvenido a Diverland</div>
        <div class="card-body">
            <form action="{{ route('login') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="email" class="form-label">Correo Electrónico</label>
                    <input type="email" class="form-control" id="email" name="email" required autofocus>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Contraseña</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>
                <button type="submit" class="btn btn-primary w-100 mb-2">Iniciar Sesión</button>
                <div class="text-center">
                    <a href="{{ route('custom.password.request') }}" class="text-decoration-none" style="color:#ff6f00;">
                        ¿Olvidaste tu contraseña?
                    </a>
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
