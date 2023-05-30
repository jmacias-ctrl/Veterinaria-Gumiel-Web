<h2 class="my-4">Permisos</h2>
<div class="row justify-content-center align-items-center g-2">
    <div class="col">
        <h5>Productos</h5>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" name="permisos[]" value="ver productos" id="flexCheckDefault"
                @if (isset($permissions) && $permissions->contains('ver productos')) checked @endif>
            <label class="form-check-label" for="flexCheckDefault">
                Ver
            </label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" name="permisos[]" value="modificar productos"
                id="flexCheckDefault" @if (isset($permissions) && $permissions->contains('modificar productos')) checked @endif>
            <label class="form-check-label" for="flexCheckDefault">
                Modificar
            </label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" name="permisos[]" value="eliminar productos"
                id="flexCheckDefault" @if (isset($permissions) && $permissions->contains('eliminar productos')) checked @endif>
            <label class="form-check-label" for="flexCheckDefault">
                Eliminar
            </label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" name="permisos[]" value="ingresar productos"
                id="flexCheckDefault" @if (isset($permissions) && $permissions->contains('ingresar productos')) checked @endif>
            <label class="form-check-label" for="flexCheckDefault">
                Ingresar
            </label>
        </div>
    </div>
    <div class="col">
        <h5>Servicios</h5>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" name="permisos[]" value="ver servicios"
                id="flexCheckDefault" @if (isset($permissions) && $permissions->contains('ver servicios')) checked @endif>
            <label class="form-check-label" for="flexCheckDefault">
                Ver
            </label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" name="permisos[]" value="modificar servicios"
                id="flexCheckDefault" @if (isset($permissions) && $permissions->contains('modificar servicios')) checked @endif>
            <label class="form-check-label" for="flexCheckDefault">
                Modificar
            </label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" name="permisos[]" value="eliminar servicios"
                id="flexCheckDefault" @if (isset($permissions) && $permissions->contains('eliminar servicios')) checked @endif>
            <label class="form-check-label" for="flexCheckDefault">
                Eliminar
            </label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" name="permisos[]" value="ingresar servicios"
                id="flexCheckDefault" @if (isset($permissions) && $permissions->contains('ingresar servicios')) checked @endif>
            <label class="form-check-label" for="flexCheckDefault">
                Ingresar
            </label>
        </div>
    </div>
    <div class="col">
        <h5>Insumos Médicos</h5>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" name="permisos[]" value="ver insumos medicos"
                id="flexCheckDefault" @if (isset($permissions) && $permissions->contains('ver insumos medicos')) checked @endif>
            <label class="form-check-label" for="flexCheckDefault">
                Ver
            </label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" name="permisos[]" value="modificar insumos medicos"
                id="flexCheckDefault" @if (isset($permissions) && $permissions->contains('modificar insumos medicos')) checked @endif>
            <label class="form-check-label" for="flexCheckDefault">
                Modificar
            </label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" name="permisos[]" value="eliminar insumos medicos"
                id="flexCheckDefault" @if (isset($permissions) && $permissions->contains('eliminar insumos medicos')) checked @endif>
            <label class="form-check-label" for="flexCheckDefault">
                Eliminar
            </label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" name="permisos[]" value="ingresar insumos medicos"
                id="flexCheckDefault" @if (isset($permissions) && $permissions->contains('ingresar insumos medicos')) checked @endif>
            <label class="form-check-label" for="flexCheckDefault">
                Ingresar
            </label>
        </div>
    </div>
</div>
<div class="row justify-content-center align-items-center g-2 mt-3">
    <div class="col">
        <h5>Medicamentos</h5>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" name="permisos[]" value="ver medicamentos vacunas"
                id="flexCheckDefault" @if (isset($permissions) && $permissions->contains('ver medicamentos vacunas')) checked @endif>
            <label class="form-check-label" for="flexCheckDefault">
                Ver
            </label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" name="permisos[]" value="modificar medicamentos vacunas"
                id="flexCheckDefault" @if (isset($permissions) && $permissions->contains('modificar medicamentos vacunas')) checked @endif>
            <label class="form-check-label" for="flexCheckDefault">
                Modificar
            </label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" name="permisos[]" value="eliminar medicamentos vacunas"
                id="flexCheckDefault" @if (isset($permissions) && $permissions->contains('eliminar medicamentos vacunas')) checked @endif>
            <label class="form-check-label" for="flexCheckDefault">
                Eliminar
            </label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" name="permisos[]" value="ingresar medicamentos vacunas"
                id="flexCheckDefault" @if (isset($permissions) && $permissions->contains('ingresar medicamentos vacunas')) checked @endif>
            <label class="form-check-label" for="flexCheckDefault">
                Ingresar
            </label>
        </div>
    </div>
    <div class="col">
        <h5>Especies</h5>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" name="permisos[]" value="ver especies"
                id="flexCheckDefault" @if (isset($permissions) && $permissions->contains('ver especies')) checked @endif>
            <label class="form-check-label" for="flexCheckDefault">
                Ver
            </label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" name="permisos[]" value="modificar especies"
                id="flexCheckDefault" @if (isset($permissions) && $permissions->contains('modificar especies')) checked @endif>
            <label class="form-check-label" for="flexCheckDefault">
                Modificar
            </label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" name="permisos[]" value="eliminar especies"
                id="flexCheckDefault" @if (isset($permissions) && $permissions->contains('eliminar especies')) checked @endif>
            <label class="form-check-label" for="flexCheckDefault">
                Eliminar
            </label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" name="permisos[]" value="ingresar especies"
                id="flexCheckDefault" @if (isset($permissions) && $permissions->contains('ingresar especies')) checked @endif>
            <label class="form-check-label" for="flexCheckDefault">
                Ingresar
            </label>
        </div>
    </div>
    <div class="col">
        <h5>Proveedores</h5>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" name="permisos[]" value="ver proveedores"
                id="flexCheckDefault" @if (isset($permissions) && $permissions->contains('ver proveedores')) checked @endif>
            <label class="form-check-label" for="flexCheckDefault">
                Ver
            </label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" name="permisos[]" value="modificar proveedores"
                id="flexCheckDefault" @if (isset($permissions) && $permissions->contains('modificar proveedores')) checked @endif>
            <label class="form-check-label" for="flexCheckDefault">
                Modificar
            </label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" name="permisos[]" value="eliminar proveedores"
                id="flexCheckDefault" @if (isset($permissions) && $permissions->contains('eliminar proveedores')) checked @endif>
            <label class="form-check-label" for="flexCheckDefault">
                Eliminar
            </label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" name="permisos[]" value="ingresar proveedores"
                id="flexCheckDefault" @if (isset($permissions) && $permissions->contains('ingresar proveedores')) checked @endif>
            <label class="form-check-label" for="flexCheckDefault">
                Ingresar
            </label>
        </div>
    </div>
</div>
<div class="row justify-content-center align-items-center g-2 mt-3">
    <div class="col">
        <h5>Usuarios</h5>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" name="permisos[]" value="ver usuarios"
                id="flexCheckDefault" @if (isset($permissions) && $permissions->contains('ver usuarios')) checked @endif>
            <label class="form-check-label" for="flexCheckDefault">
                Ver
            </label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" name="permisos[]" value="modificar usuarios"
                id="flexCheckDefault" @if (isset($permissions) && $permissions->contains('modificar usuarios')) checked @endif>
            <label class="form-check-label" for="flexCheckDefault">
                Modificar
            </label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" name="permisos[]" value="eliminar usuarios"
                id="flexCheckDefault" @if (isset($permissions) && $permissions->contains('eliminar usuarios')) checked @endif>
            <label class="form-check-label" for="flexCheckDefault">
                Eliminar
            </label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" name="permisos[]" value="ingresar usuarios"
                id="flexCheckDefault" @if (isset($permissions) && $permissions->contains('ingresar usuarios')) checked @endif>
            <label class="form-check-label" for="flexCheckDefault">
                Ingresar
            </label>
        </div>
    </div>
    <div class="col">
        <h5>Roles</h5>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" name="permisos[]" value="ver roles"
                id="flexCheckDefault" @if (isset($permissions) && $permissions->contains('ver roles')) checked @endif>
            <label class="form-check-label" for="flexCheckDefault">
                Ver
            </label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" name="permisos[]" value="modificar roles"
                id="flexCheckDefault" @if (isset($permissions) && $permissions->contains('modificar roles')) checked @endif>
            <label class="form-check-label" for="flexCheckDefault">
                Modificar
            </label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" name="permisos[]" value="eliminar roles"
                id="flexCheckDefault" @if (isset($permissions) && $permissions->contains('eliminar roles')) checked @endif>
            <label class="form-check-label" for="flexCheckDefault">
                Eliminar
            </label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" name="permisos[]" value="ingresar roles"
                id="flexCheckDefault" @if (isset($permissions) && $permissions->contains('ingresar roles')) checked @endif>
            <label class="form-check-label" for="flexCheckDefault">
                Ingresar
            </label>
        </div>
    </div>
    <div class="col">
        <h5>Acceso</h5>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" name="permisos[]" value="ver gestionvet"
                id="flexCheckDefault" @if (isset($permissions) && $permissions->contains('ver gestionvet')) checked @endif>
            <label class="form-check-label" for="flexCheckDefault">
                Acceso Gestión de Veterinaria
            </label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" name="permisos[]" value="acceso administracion de stock"
                id="flexCheckDefault" @if (isset($permissions) && $permissions->contains('acceso administracion de stock')) checked @endif>
            <label class="form-check-label" for="flexCheckDefault">
                Acceso Administración de Inventario
            </label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" name="permisos[]" value="acceso punto de venta"
                id="flexCheckDefault" @if (isset($permissions) && $permissions->contains('acceso punto de venta')) checked @endif>
            <label class="form-check-label" for="flexCheckDefault">
                Acceso Punto de Venta
            </label>
        </div>
    </div>
</div>
