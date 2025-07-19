<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Gestión de Eventos | Diverland</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

    {{-- Header con botones --}}
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark px-4">
        <span class="navbar-brand">Diverland</span>
        <div class="ms-auto">
            <a href="/menu" class="btn btn-outline-light me-2">Volver al menú</a>
            <a href="/logout" class="btn btn-outline-danger">Cerrar sesión</a>
        </div>
    </nav>

    <div class="container mt-5">
        <h2 class="text-center text-primary mb-4">Programar y Gestionar Eventos</h2>

        {{-- Alertas de éxito o error --}}
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @elseif(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        {{-- Tabla de eventos existentes --}}
        <div class="card mb-4">
            <div class="card-header bg-secondary text-white">
                Lista de Eventos Programados
            </div>
            <div class="card-body table-responsive">
                <table class="table table-bordered table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Punto</th>
                            <th>Trabajador</th>
                            <th>Juego</th>
                            <th>Insumo</th>
                            <th>Horario</th>
                            <th>Lugar</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($eventos as $evento)
                            <tr>
                                <td>{{ $evento->id }}</td>
                                <td>{{ $evento->codigo_punto }}</td>
                                <td>{{ $evento->usuario_trabajador }}</td>
                                <td>{{ $evento->codigo_juego }}</td>
                                <td>{{ $evento->codigo_insumo }}</td>
                                <td>{{ $evento->horario }}</td>
                                <td>{{ $evento->lugar }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        {{-- FORMULARIOS --}}
        <div class="row">
            {{-- Programar Evento --}}
            <div class="col-md-6">
                <div class="card mb-4">
                    <div class="card-header bg-warning">RF13 - Programar Evento</div>
                    <div class="card-body">
                        <form action="{{ route('eventos.store') }}" method="POST">
                            @csrf
                            <input type="text" name="codigo_punto" class="form-control mb-2" placeholder="Código del Punto" required>
                            <input type="text" name="usuario_trabajador" class="form-control mb-2" placeholder="Usuario del Trabajador" required>
                            <input type="text" name="codigo_juego" class="form-control mb-2" placeholder="Código del Juego">
                            <input type="text" name="codigo_insumo" class="form-control mb-2" placeholder="Código del Insumo">
                            <input type="datetime-local" name="horario" class="form-control mb-2" required>
                            <button type="submit" class="btn btn-primary">Programar</button>
                        </form>
                    </div>
                </div>
            </div>

            {{-- Gestionar Evento --}}
            <div class="col-md-6">
                <div class="card mb-4">
                    <div class="card-header bg-success text-white">RF36 - Gestionar Evento</div>
                    <div class="card-body">
                        <form action="{{ route('eventos.actualizar') }}" method="POST">
                            @csrf
                            @method('PUT')
                            <input type="text" name="codigo_evento" class="form-control mb-2" placeholder="Código del Evento" required>
                            <input type="text" name="lugar" class="form-control mb-2" placeholder="Lugar actualizado" required>
                            <button type="submit" class="btn btn-success">Actualizar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
</body>
</html>
