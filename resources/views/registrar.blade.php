<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clientes Registrados - Diverland</title>
    <!-- Fuente Roboto Mono para fallback -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Mono:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <style>
        body {
            font-family: 'Roboto Mono', monospace !important;
            margin: 0;
            padding: 0;
            background-color: #f4f4f9;
        }

        header {
            background-color: #2a2a72;
            color: white;
            padding: 20px;
            text-align: center;
        }

        main {
            padding: 20px;
        }

        .table-container {
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            max-width: 1000px;
            margin: 0 auto;
            overflow-x: auto;
        }

        h2 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table, th, td {
            border: 1px solid #ccc;
        }

        th, td {
            padding: 12px;
            text-align: center;
        }

        th {
            background-color: #2a2a72;
            color: white;
        }

        .btn-edit {
            background-color: #2a2a72;
            color: white;
            padding: 5px 10px;
            border: none;
            cursor: pointer;
            border-radius: 5px;
        }

        .btn-edit:hover {
            background-color: #555;
        }

        footer {
            background-color: #2a2a72;
            color: white;
            text-align: center;
            padding: 10px;
            position: relative;
            bottom: 0;
            width: 100%;
            margin-top: 20px;
        }

        /* Estilo para formularios de edición */
        .edit-form-container {
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            max-width: 600px;
            margin: 20px auto;
        }

        .edit-form-container label {
            display: block;
            margin-bottom: 10px;
        }

        .edit-form-container input, .edit-form-container select {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        .edit-form-container input[type="submit"] {
            background-color: #2a2a72;
            color: white;
            cursor: pointer;
            border: none;
        }

        .edit-form-container input[type="submit"]:hover {
            background-color: #555;
        }
    </style>
</head>
<body>

    <header>
        <h1>Clientes Registrados - Diverland</h1>
    </header>

    <main>
        <div class="table-container">
            <h2>Lista de Clientes Registrados</h2>
            <table>
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Edad</th>
                        <th>Tiempo Pagado (h)</th>
                        <th>Hora de Entrada</th>
                        <th>Método de Pago</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody id="clientes-list">
                    <!-- Lista de clientes será añadida aquí dinámicamente -->
                </tbody>
            </table>
        </div>

        <!-- Formulario de Edición de Cliente -->
        <div class="edit-form-container" id="edit-form-container" style="display: none;">
            <h2>Editar Cliente</h2>
            <form id="edit-form">
                <label for="edit-nombre">Nombre:</label>
                <input type="text" id="edit-nombre" name="nombre" required>

                <label for="edit-edad">Edad:</label>
                <input type="number" id="edit-edad" name="edad" required>

                <label for="edit-tiempo_pago">Tiempo Pagado (en horas):</label>
                <input type="number" id="edit-tiempo_pago" name="tiempo_pago" required>

                <label for="edit-hora_entrada">Hora de Entrada:</label>
                <input type="time" id="edit-hora_entrada" name="hora_entrada" required>

                <label for="edit-metodo_pago">Método de Pago:</label>
                <select id="edit-metodo_pago" name="metodo_pago" required>
                    <option value="efectivo">Efectivo</option>
                    <option value="tarjeta_credito">Tarjeta de Crédito</option>
                    <option value="tarjeta_debito">Tarjeta de Débito</option>
                    <option value="transferencia">Transferencia Bancaria</option>
                </select>

                <input type="submit" value="Actualizar Cliente">
            </form>
        </div>
    </main>

    <footer>
        <p>&copy; 2025 Diverland. Todos los derechos reservados.</p>
    </footer>

    <script>
        // Simulación de datos de clientes
        const clientes = [
            { id: 1, nombre: "Juan Pérez", edad: 30, tiempo_pago: 3, hora_entrada: "10:00", metodo_pago: "Efectivo" },
            { id: 2, nombre: "María González", edad: 25, tiempo_pago: 2, hora_entrada: "11:30", metodo_pago: "Tarjeta de Crédito" },
            { id: 3, nombre: "Carlos López", edad: 35, tiempo_pago: 4, hora_entrada: "09:15", metodo_pago: "Transferencia Bancaria" }
        ];

        // Mostrar la lista de clientes
        function mostrarClientes() {
            const listaClientes = document.getElementById("clientes-list");
            listaClientes.innerHTML = ''; // Limpiar lista antes de llenarla

            clientes.forEach(cliente => {
                const tr = document.createElement('tr');
                tr.innerHTML = `
                    <td>${cliente.nombre}</td>
                    <td>${cliente.edad}</td>
                    <td>${cliente.tiempo_pago}</td>
                    <td>${cliente.hora_entrada}</td>
                    <td>${cliente.metodo_pago}</td>
                    <td><button class="btn-edit" onclick="editarCliente(${cliente.id})">Editar</button></td>
                `;
                listaClientes.appendChild(tr);
            });
        }

        // Editar cliente
        function editarCliente(id) {
            const cliente = clientes.find(c => c.id === id);
            if (cliente) {
                document.getElementById("edit-nombre").value = cliente.nombre;
                document.getElementById("edit-edad").value = cliente.edad;
                document.getElementById("edit-tiempo_pago").value = cliente.tiempo_pago;
                document.getElementById("edit-hora_entrada").value = cliente.hora_entrada;
                document.getElementById("edit-metodo_pago").value = cliente.metodo_pago;
                document.getElementById("edit-form-container").style.display = "block";

                // Actualizar la información del cliente
                document.getElementById("edit-form").onsubmit = function(event) {
                    event.preventDefault();
                    cliente.nombre = document.getElementById("edit-nombre").value;
                    cliente.edad = document.getElementById("edit-edad").value;
                    cliente.tiempo_pago = document.getElementById("edit-tiempo_pago").value;
                    cliente.hora_entrada = document.getElementById("edit-hora_entrada").value;
                    cliente.metodo_pago = document.getElementById("edit-metodo_pago").value;

                    // Ocultar el formulario de edición y actualizar la lista
                    document.getElementById("edit-form-container").style.display = "none";
                    mostrarClientes();
                };
            }
        }

        // Inicializar la lista de clientes
        mostrarClientes();
    </script>

</body>
</html>
