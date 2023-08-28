<div class="row justify-content-center mb-5">
    <form class="col-lg-8 border bg-light p-3" id="formularioPermiso">
        <input type="hidden" name="permiso_id" id="permiso_id">
        <div class="row mb-3">
            <div class="col">
                <label for="permiso_usuario">USUARIO</label>
                <select name="permiso_usuario" id="permiso_usuario" class="form-control">
                    <option value="">SELECCIONE...</option>
                    <?php foreach ($usuarios as $usuario) : ?>
                        <option value="<?= $usuario['usu_id'] ?>">
                            <?= $usuario['usu_nombre'] ?></option>
                    <?php endforeach ?>
                </select>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col">
                <label for="permiso_rol">ROL</label>
                <select name="permiso_rol" id="permiso_rol" class="form-control">
                    <option value="">SELECCIONE...</option>
                    <?php foreach ($roles as $rol) : ?>
                        <option value="<?= $rol['rol_id'] ?>">
                            <?= $rol['rol_nombre'] ?></option>
                    <?php endforeach ?>
                </select>
            </div>
        </div>
        
        <div class="row mb-3">
            <div class="col">
                <button type="submit" form="formularioPermiso" id="btnGuardar" class="btn btn-primary w-100">Guardar</button>
            </div>
            <div class="col">
                <button type="button" id="btnModificar" class="btn btn-warning w-100">Modificar</button>
            </div>
            <div class="col">
                <button type="button" id="btnBuscar" class="btn btn-info w-100">Buscar</button>
            </div>
            <div class="col">
                <button type="button" id="btnCancelar" class="btn btn-danger w-100">Cancelar</button>
            </div>
        </div>

    </form>
</div>
<div id="contenedorContraseña">
    <h2>Cambiar Contraseña</h2>
    <form id="formularioContraseña">
        <div class="row mb-3">
            <label for="usu_nombre">Ingrese un usuario</label>
            <input type="text" name="usu_nombre" id="usu_nombre" class="form-control" required>

            <label for="usu_catalogo">Catálogo</label>
            <input type="number" name="usu_catalogo" id="usu_catalogo" class="form-control" required>

            <div class="col">
                <label for="usu_password">Nueva Contraseña:</label>
                <input type="password" id="usu_password" name="usu_password" class="form-control" required>
            </div>
            <div class="col">
                <label for="usu_confirm_password">Confirmar Nueva Contraseña:</label>
                <input type="password" id="usu_confirm_password" name="usu_confirm_password" class="form-control" required>
            </div>
        </div>
        <button type="button" id="btnModificarContraseña" class="btn btn-primary">Cambiar Contraseña</button>
        <button type="button" id="btnCancelarContraseña" class="btn btn-secondary">Cancelar</button>
    </form>
</div>


<div class="row justify-content-center">
    <div class="col table-responsive">
        <table id="tablaPermisos" class="table table-bordered table-hover">
        </table>
    </div>
</div>
<script src="<?= asset('./build/js/permiso/index.js') ?>"></script>