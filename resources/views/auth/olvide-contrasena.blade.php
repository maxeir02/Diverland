
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Recuperar Contraseña - Diverland</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Mono:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <style>
        body {
            background: #f8fafc;
            font-family: 'Roboto Mono', monospace !important;
        }
        .logo {
            display: block;
            margin: 0 auto 20px;
            width: 160px;
        }
        .card {
            border-radius: 15px;
            box-shadow: 0 2px 16px 0 rgba(0,0,0,0.08);
        }
        .card-header {
            background: #ffecb3;
            color: #ff6f00;
            font-weight: bold;
            font-size: 1.2rem;
            text-align: center;
            border-radius: 15px 15px 0 0;
        }
        .btn-warning {
            background-color: #ff6f00;
            border: none;
        }
        .btn-warning:hover {
            background-color: #ff9800;
        }
        .form-control {
            border-radius: 10px;
            padding: 12px;
        }
        .alert-success {
            text-align: center;
        }
        .volver-login {
            display: block;
            text-align: center;
            margin-top: 18px;
            color: #ff6f00;
            text-decoration: none;
            font-weight: bold;
            transition: color 0.2s;
        }
        .volver-login:hover {
            color: #ff9800;
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="card">
                    <img src="{{ asset('imagenes/logo.png') }}" class="logo" alt="Diverland logo">
                    <div class="card-header">Recuperar Contraseña</div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('custom.password.email') }}">
                            @csrf
                            <div class="mb-3">
                                <label for="email" class="form-label">Correo registrado</label>
                                <input type="email" class="form-control" id="email" name="email" required autofocus>
                            </div>
                            <button type="submit" class="btn btn-warning w-100">Solicitar recuperación</button>
                        </form>
                        @if(session('status'))
                            <div class="alert alert-success mt-3">{{ session('status') }}</div>
                        @endif
                        <a href="{{ route('login') }}" class="volver-login">
                            ← Volver al login
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>