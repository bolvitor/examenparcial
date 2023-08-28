<div style="max-width: 450px; margin: 0 auto; padding: 20px; border: 1px solid #ccc;">
        <h1 class="text-center display-7"><b>Registro de Usuario</b></h1>
        
        <form id="formularioUsuario">
            <label for="usu_nombre">Ingrese un usuario</label>
            <input type="text" name="usu_nombre" id="usu_nombre" class="form-control" required>

            <label for="usu_catalogo">Catálogo</label>
            <input type="number" name="usu_catalogo" id="usu_catalogo" class="form-control" required>

            <label for="usu_password">Ingrese una contraseña</label>
            <input type="password" name="usu_password" id="usu_password" class="form-control" required>

            <label for="usu_confirm_password">Confirme su contraseña</label>
            <input type="password" name="usu_confirm_password" id="usu_confirm_password" class="form-control" required>

            <button type="submit" form="formularioUsuario" class="btn btn-primary w-100">Guardar</button>
        </form>
    </div>

<script src="<?= asset('./build/js/usuario/index.js')  ?>"></script>