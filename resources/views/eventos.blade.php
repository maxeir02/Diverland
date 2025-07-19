<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Eventos - Diverland</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
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
        
        .card-eventos {
            background: #fff;
            border-radius: 18px;
            box-shadow: 0 4px 16px rgba(0,0,0,0.08);
            padding: 32px;
            margin: 0 auto 40px auto;
            max-width: 1100px;
        }
        .card-eventos h3 {
            color: #1976d2;
            font-weight: bold;
            margin-bottom: 24px;
        }
        .table thead {
            background-color: #ff6f00;
            color: #fff;
        }
        .table th, .table td {
            vertical-align: middle;
        }
        .form-section {
            margin-top: 32px;
        }
        .form-section .card {
            border-radius: 14px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.06);
        }
        footer {
            margin-top: 40px;
            background-color: white;
            color: #ff6f00;
            text-align: center;
            padding: 15px;
            box-shadow: 0 -4px 8px rgba(0,0,0,0.1);
        }
        @media (max-width: 900px) {
            .menu-icons { flex-wrap: wrap; gap: 16px; }
            .logo-diverland { margin: 16px 0; }
            .card-eventos { padding: 16px; }
        }
    </style>
</head>
<body>
  <header>
    <h1>Lista de Eventos Programados</h1>
    <h2 class="text-center mb-4">¡Diverland: Donde la diversión nunca termina!</h2>

    <nav>
        <a href="{{ url('menu') }}"><i class="fas fa-arrow-left"></i> Volver al Menú</a>
        <a href="{{ url('login') }}"><i class="fas fa-sign-out-alt"></i> Cerrar Sesión</a>
    </nav>
</header>
    <div class="card-eventos">
        <div class="table-responsive">
            <table class="table table-bordered mb-4">
                <thead>
                    <tr>
                        <th>Numero de evento</th>
                        <th>Punto</th>
                        <th>Trabajador</th>
                        <th>Juego</th>
                        <th>Horario</th>
                        <th>Lugar</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
@forelse($eventos as $evento)
    <tr>
        <td>{{ $evento->id }}</td>
        <td>{{ $evento->codigo_punto }}</td>
        <td>{{ $evento->usuario_trabajador }}</td>
        <td>{{ $evento->codigo_juego }}</td>
        <td>{{ $evento->horario }}</td>
        <td>{{ $evento->lugar }}</td>
        <td>
            <form action="{{ route('eventos.destroy', $evento->id) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Seguro que deseas eliminar este evento?')">
                    <i class="fa fa-trash"></i>
                </button>
            </form>
        </td>
    </tr>
@empty
    <tr>
        <td colspan="7" class="text-center">No hay eventos registrados.</td>
    </tr>
@endforelse
                </tbody>
            </table>
        </div>
        <div class="row form-section">
            <div class="col-md-6 mb-3">
                <div class="card">
                    <div class="card-header bg-warning text-dark fw-bold">
                        Programar Evento
                    </div>
                    <div class="card-body">
                        <form action="{{ route('eventos.store') }}" method="POST">
    @csrf
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

    <label for="codigo_punto" class="form-label">Punto</label>
    <select name="codigo_punto" id="codigo_punto" class="form-control mb-2" onchange="actualizarLugar()">
        <option value="">Seleccione punto</option>
        <option value="La finca de Rigo">La finca de Rigo</option>
        <option value="La bendita">La bendita</option>
        <option value="Evento fuera del parque">Evento fuera del parque</option>
    </select>

    <label for="usuario_trabajador" class="form-label">Usuario del Trabajador</label>
    <input type="text" name="usuario_trabajador" class="form-control mb-2" placeholder="Usuario del Trabajador">

    <label for="codigo_juego" class="form-label">Juego</label>
    <select name="codigo_juego" id="codigo_juego" class="form-control mb-2">
        <option value="">Seleccione juego</option>
        <option value="inflable">Inflable</option>
        <option value="trampolin">Trampolín</option>
        <option value="toro mecanico">Toro Mecánico</option>
        <option value="piscina de pelotas">Piscina de Pelotas</option>
    </select>

    <label for="horario" class="form-label">Horario</label>
    <input type="datetime-local" name="horario" class="form-control mb-3" placeholder="dd/mm/aaaa --:--">

    <label for="lugar" class="form-label">Lugar</label>
    <input type="text" name="lugar" id="lugar" class="form-control mb-3" readonly>

    <button type="submit" class="btn btn-primary">Programar</button>
</form>

<script>
function actualizarLugar() {
    const punto = document.getElementById('codigo_punto').value;
    document.getElementById('lugar').value = punto;
}
</script>
                    </div>
                </div>
            </div>
            <div class="col-md-6 mb-3">
                <div class="card">
                    <div class="card-header bg-success text-white fw-bold">
                        Gestionar Evento
                    </div>
                    <div class="card-body">
                        <form action="{{ route('eventos.actualizar') }}" method="POST">
    @csrf
    @method('PUT')
    <label for="codigo_evento" class="form-label">Numero de evento</label>
    <select name="codigo_evento" id="codigo_evento" class="form-control mb-2" required>
        <option value="">Seleccione evento</option>
        @foreach($eventos as $evento)
            <option value="{{ $evento->id }}">{{ $evento->usuario_trabajador }}</option>
        @endforeach
    </select>

    <label for="codigo_punto_gestion" class="form-label">Punto</label>
    <select name="codigo_punto" id="codigo_punto_gestion" class="form-control mb-2" required onchange="actualizarLugarGestion()">
        <option value="">Seleccione punto</option>
        <option value="La finca de Rigo">La finca de Rigo</option>
        <option value="La bendita">La bendita</option>
        <option value="Evento fuera del parque">Evento fuera del parque</option>
    </select>

    <label for="lugar_gestion" class="form-label">Lugar</label>
    <select name="lugar" id="lugar_gestion" class="form-control mb-2" readonly required>
        <option value="">Seleccione lugar</option>
        <option value="La finca de Rigo">La finca de Rigo</option>
        <option value="La bendita">La bendita</option>
        <option value="Evento fuera del parque">Evento fuera del parque</option>
    </select>

    <label for="codigo_juego_gestion" class="form-label">Juego</label>
    <select name="codigo_juego" id="codigo_juego_gestion" class="form-control mb-2" required>
        <option value="">Seleccione juego</option>
        <option value="inflable">Inflable</option>
        <option value="trampolin">Trampolín</option>
        <option value="toro mecanico">Toro Mecánico</option>
        <option value="piscina de pelotas">Piscina de Pelotas</option>
    </select>

    <button type="submit" class="btn btn-success">Actualizar</button>
</form>

<script>
function actualizarLugarGestion() {
    const punto = document.getElementById('codigo_punto_gestion').value;
    document.getElementById('lugar_gestion').value = punto;
}
</script>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <footer>
        © 2025 Diverland - Todos los derechos reservados
    </footer>
</body>
</html>