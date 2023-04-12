<div class="modal fade" tabindex="-1" id="modalPermisos">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Modificacion de Permisos</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p>Permisos para el Usuario X</p>
        <div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" id="rolUsuarioAdmin" disabled>
                <label class="form-check-label" for="flexCheckDefault">
                    Administrador
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox"  id="rolUsuarioPeluq">
                <label class="form-check-label" for="flexCheckDefault">
                    Peluqueria
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" id="rolUsuarioInv">
                <label class="form-check-label" for="flexCheckDefault">
                    Inventario
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" id="rolUsuarioVet">
                <label class="form-check-label" for="flexCheckDefault">
                    Veterinario
                </label>
            </div>
            <div class="form-check form-switch my-3">
                <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault">
                <label class="form-check-label" for="flexSwitchCheckDefault">Deshabilitar Usuario</label>
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary">Guardar</button>
      </div>
    </div>
  </div>
</div>