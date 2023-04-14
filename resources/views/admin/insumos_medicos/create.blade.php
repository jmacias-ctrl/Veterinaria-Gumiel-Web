<form action="{{route('admin.insumos_medicos.store')}}" method="POST">
@csrf
    <label for="nombre">Nombre</label>
    <input type="text" name="nombre" id="nombre">
    <br>

    <label for="marca">Marca</label>
    <input type="text" name="marca" id="marca">
    <br>

    <label for="tipo">Tipo</label>
    <input type="enum" name="tipo" id="tipo">
    <br>

    <label for="stock">Stock</label>
    <input type="integer" name="stock" id="stock">
    <br>

    <input type="submit" name="enviar" id="enviar">
    <br>
</form>