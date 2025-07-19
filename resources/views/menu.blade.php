<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Menú Principal - Diverland</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css2?family=Baloo+2&display=swap" rel="stylesheet" />
  <!-- Fuente Roboto Mono para fallback -->
  <link href="https://fonts.googleapis.com/css2?family=Roboto+Mono:wght@400;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('css/app.css') }}">
  <style>
    html, body {
      height: 100%;
      margin: 0;
      font-family: 'Roboto Mono', monospace !important;
      background-color: white;
      color: #333;
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
      padding: 10px 0;
      text-align: center;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
      position: relative;
      z-index: 1;
    }

    .main-content {
      margin-top: 20px;
      position: relative;
      z-index: 1;
      text-align: center;
      flex: 1; /* para que empuje el footer abajo */
    }

    .menu-line {
      display: flex;
      justify-content: center;
      align-items: center;
      gap: 40px;
      padding: 30px 0;
      width: 100%;
      margin: 0 auto;
    }

    .menu-item {
      background: white;
      border-radius: 20px;
      padding: 28px 40px;
      box-shadow: 0 8px 20px rgba(0, 0, 0, 0.12);
      transition: transform 0.3s ease;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      min-width: 170px;
      min-height: 130px;
      gap: 12px;
      text-align: center;
    }

    .menu-item:hover {
      transform: translateY(-5px);
    }

    .menu-item i {
      font-size: 2.2rem;
      color: #ff6f00;
      margin-bottom: 0;
    }

    .menu-item a {
      text-decoration: none;
      color: #333;
      font-weight: bold;
      font-size: 1.15rem;
      width: 100%;
      text-align: center;
      margin: 0 auto;
      display: flex;
      align-items: center;
      justify-content: center;
      height: 2.2rem; /* igualar altura para todos */
    }

    .logo-center-container {
      background: transparent;
      box-shadow: none;
      padding: 0;
      min-width: 200px;
      min-height: 200px;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .logo-center {
      height: 160px;
      width: 160px;
      object-fit: contain;
      margin: 0 auto;
      display: block;
    }

    footer {
      background-color: rgba(0, 0, 0, 0.5);
      color: white;
      text-align: center;
      padding-top: 10px;
      margin-top: 40px;
      position: relative;
      z-index: 1;
      /* No position fixed para no sobreponer */
    }

    /* Ajustes para imágenes del carrusel: mismo tamaño y objeto cubriendo */
    .carousel-inner img {
      height: 300px;
      object-fit: cover;
      width: 100%;
    }
    
    .separar-texto {
      margin-bottom: 0px;
    }
  </style>
</head>
<body>

  <header>
    <h4 class="text-center separar-texto">Restaurante: La benedita picnic / Télefono: 3185848733 / DiverlandPlay@gmail.com</h4>
  </header>

  <div class="container main-content">
    <div class="menu-line">
      <div class="menu-item">
        <i class="fas fa-home"></i>
        <a href="{{ url('/menu') }}">Inicio</a>
      </div>  
      <div class="menu-item">
        <i class="fas fa-users"></i>
        <a href="{{ url('/clientes/listado') }}">Clientes</a>
      </div>

      <div class="menu-item">
        <i class="fas fa-apple-alt"></i>
        <a href="{{ url('/inventario') }}">Inventario</a>
      </div>

      <div class="logo-center-container">
        <img src="{{ asset('imagenes/logo.png')}}" alt="Logo Centro" class="logo-center">
      </div>

      <div class="menu-item">
        <i class="fas fa-birthday-cake"></i>
        <a href="{{ url('/eventos') }}">Eventos</a>
      </div>

      <div class="menu-item">
        <i class="fas fa-user-plus"></i>
        <a href="{{ url('/registroc') }}">Registrar</a>
      </div>

      <div class="menu-item">
        <i class="fas fa-sign-out-alt"></i>
        <a href="{{ url('/login') }}">Salir</a>
      </div>
    </div>

    <h3 class="text-center mb-4">¡Diverland: Donde la diversión nunca termina!</h3>
<!-- Carrusel agregado aquí -->
    <div id="diverlandCarousel" class="carousel slide mb-5" data-bs-ride="carousel">
      <div class="carousel-indicators">
        <button type="button" data-bs-target="#diverlandCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
        <button type="button" data-bs-target="#diverlandCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
        <button type="button" data-bs-target="#diverlandCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
      </div>
      <div class="carousel-inner rounded-4 shadow-sm">
        <div class="carousel-item active">
          <img src="{{ asset('imagenes/niños.jpg')}}" alt="Diversion 1" />
          <div class="carousel-caption d-none d-md-block">
            
          </div>
        </div>
        <div class="carousel-item">
          <img src="{{ asset('imagenes/niños2.jpg')}}" alt="Diversion 2" />
          <div class="carousel-caption d-none d-md-block">
           
          </div>
        </div>
        <div class="carousel-item">
          <img src="{{ asset('imagenes/niños3.jpg')}}" alt="Diversion 3" />
          <div class="carousel-caption d-none d-md-block">
            
          </div>
        </div>
      </div>
      <button class="carousel-control-prev" type="button" data-bs-target="#diverlandCarousel" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Anterior</span>
      </button>
      <button class="carousel-control-next" type="button" data-bs-target="#diverlandCarousel" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Siguiente</span>
      </button>
    </div>


    
  </div> <!-- fin container main-content -->

  <footer>
    <div style="display: flex; align-items: center; justify-content: space-between; padding: 0 30px;">
      <img src="{{ asset('imagenes/sena-seeklogo.png') }}" alt="SENA" style="height: 40px;">
      <div style="flex: 1; text-align: center;">
        <p>&copy; 2025 Diverland - Todos los derechos reservados</p>
        <p>
          <a href="https://www.instagram.com/diverlandplay?utm_source=ig_web_button_share_sheet&igsh=ZDNlZDc0MzIxNw==" target="_blank" style="color: white;">
            Síguenos en Instagram
          </a>
        </p>
      </div>
      <div style="width: 40px;"></div> <!-- Espaciador derecho -->
    </div>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
