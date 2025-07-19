<!DOCTYPE html>
<html>
<head>
    <title>Registrar Inventario</title>
</head>
<body>
    <h1>Formulario de Inventario</h1>

    <form action="{{ route('inventario.store') }}" method="POST">
        @csrf
        <label>Referencia:</label>
        <input type="text" name="referencia"><br>

        <label>Producto:</label>
        <input type="text" name="producto"><br>

        <label>Precio Unidad:</label>
        <input type="number" step="0.01" name="precio_unidad"><br>

        <label>Precio Venta:</label>
        <input type="number" step="0.01" name="precio_venta"><br>

        <label>Fecha de Compra:</label>
        <input type="date" name="fecha_compra"><br>

        <label>Fecha de Vencimiento:</label>
        <input type="date" name="fecha_vencimiento"><br>

        <button type="submit">Guardar</button>
    </form>
</body>
</html>
