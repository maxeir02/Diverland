<!-- filepath: resources/views/admin/cambiar-password.blade.php -->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Administrar Usuarios - Diverland</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Mono:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body {
            background: #f8fafc;
            font-family: 'Roboto Mono', monospace !important;
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
        .btn-warning, .btn-danger, .btn-success {
            border: none;
        }
        .btn-warning {
            background-color: #ff6f00;
        }
        .btn-warning:hover {
            background-color: #ff9800;
        }
        .volver-menu {
            display: block;
            text-align: center;
            margin-top: 18px;
            color: #ff6f00;
            text-decoration: none;
            font-weight: bold;
            transition: color 0.2s;
        }
        .volver-menu:hover {
            color: #ff9800;
            text-decoration: underline;
        }
        .form-control {
            border-radius: 10px;
            padding: 12px;
        }
        .alert-success, .alert-danger {
            text-align: center;
        }
        .table-users th, .table-users td {
            vertical-align: middle;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="card mb-4">
                    <img src="{{ asset('imagenes/logo.png') }}" class="logo" alt="Diverland logo">
                    <div class="card-header">Cambiar contraseña de usuario</div>
                    <div class="card-body">
                        @if(session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif
                        @if(session('error'))
                            <div class="alert alert-danger">{{ session('error') }}</div>
                        @endif
                        <form method="POST" action="{{ route('admin.cambiar-password.post') }}">
                            @csrf
                            <div class="mb-3">
                                <label for="email" class="form-label">Correo del usuario</label>
                                <input type="email" class="form-control" name="email" id="email" required>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Nueva contraseña</label>
                                <input type="password" class="form-control" name="password" id="password" required>
                            </div>
                            <div class="mb-3">
                                <label for="password_confirmation" class="form-label">Confirmar contraseña</label>
                                <input type="password" class="form-control" name="password_confirmation" id="password_confirmation" required>
                            </div>
                            <button type="submit" class="btn btn-warning w-100">Cambiar contraseña</button>
                        </form>
                        <a href="{{ url('/menu') }}" class="volver-menu">← Volver al menú</a>
                    </div>
                </div>
            </div>
            <div class="col-md-7">
                <div class="card mb-4">
                    <div class="card-header">Crear nuevo usuario</div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('admin.crear-usuario') }}">
                            @csrf
                            <div class="mb-3">
                                <label for="nuevo_nombre" class="form-label">Nombre</label>
                                <input type="text" class="form-control" name="name" id="nuevo_nombre" required>
                            </div>
                            <div class="mb-3">
                                <label for="nuevo_email" class="form-label">Correo</label>
                                <input type="email" class="form-control" name="email" id="nuevo_email" required>
                            </div>
                            <div class="mb-3">
                                <label for="nuevo_password" class="form-label">Contraseña</label>
                                <input type="password" class="form-control" name="password" id="nuevo_password" required>
                            </div>
                            <button type="submit" class="btn btn-success w-100">Crear usuario</button>
                        </form>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">Usuarios registrados</div>
                    <div class="card-body">
                        <table class="table table-bordered table-users">
                            <thead>
                                <tr>
                                    <th>Nombre</th>
                                    <th>Correo</th>
                                    <th>Acción</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($usuarios as $usuario)
                                    <tr>
                                        <td>{{ $usuario->name }}</td>
                                        <td>{{ $usuario->email }}</td>
                                        <td>
                                            @if($usuario->email !== 'admin@diverland.com')
                                            <form method="POST" action="{{ route('admin.eliminar-usuario', $usuario->id) }}" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Seguro que deseas eliminar este usuario?')">Eliminar</button>
                                            </form>
                                            @else
                                                <span class="text-muted">Admin</span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>