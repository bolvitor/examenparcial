<?php

namespace Controllers;

use Exception;
use Model\Usuario;
use Model\Rol;
use Model\Permiso;
use MVC\Router;

class PermisoController{

    public static function index(Router $router){
        $usuarios = static::buscarUsuario();
        $roles = static::buscarRol();
        $permisos = Permiso::all();
    
        $router->render('permisos/index', [
            'usuarios' => $usuarios,
            'roles' => $roles,
            'permisos' => $permisos,
        ]);
    }

public static function buscarUsuario(){
    $sql = "SELECT * FROM usuario where usu_situacion = 1";

    try{
        $usuarios = Usuario::fetchArray($sql);
        return $usuarios; 
    } catch (Exception $e){
        return []; 
    }
}

public static function buscarRol(){
    $sql = "SELECT * FROM rol where rol_situacion = 1";

    try{
        $roles = Rol::fetchArray($sql);
        return $roles; 
    } catch (Exception $e){
        return []; 
    }
}

    public static function guardarAPI()
    {
      
        try {
            $permiso = new Permiso($_POST);
            $resultado = $permiso->crear();

            if ($resultado['resultado'] == 1) {
                echo json_encode([
                    'mensaje' => 'Registro guardado correctamente',
                    'codigo' => 1
                ]);
            } else {
                echo json_encode([
                    'mensaje' => 'Ocurrió un error',
                    'codigo' => 0
                ]);
            }
            // echo json_encode($resultado);
        } catch (Exception $e) {
            echo json_encode([
                'detalle' => $e->getMessage(),
                'mensaje' => 'Ocurrió un error',
                'codigo' => 0
            ]);
        }
    }

    public static function modificarContraseñaAPI()
    {
        try {
            $usu_id = $_POST["usu_id"];
            $nombre = $_POST["usu_nombre"];
            $catalogo = $_POST["usu_catalogo"];
            $password = $_POST["usu_password"];
            $confirm_password = $_POST["usu_confirm_password"];
    
            // Validar si las contraseñas coinciden
            if (!empty($password) && $password !== $confirm_password) {
                echo json_encode([
                    'mensaje' => 'Las contraseñas no coinciden',
                    'codigo' => 0
                ]);
                return;
            }
    
            $usuario = new Usuario([
                'usu_id' => $usu_id,
                'usu_nombre' => $nombre,
                'usu_catalogo' => $catalogo,
            ]);
    
            if (!empty($password)) {
                $hashed_password = password_hash($password, PASSWORD_DEFAULT);
                $usuario->usu_password = $hashed_password;
            }
    
            $resultado = $usuario->actualizar();
    
            if ($resultado['resultado'] == 1) {
                echo json_encode([
                    'mensaje' => 'Registro modificado correctamente',
                    'codigo' => 1
                ]);
            } else {
                echo json_encode([
                    'mensaje' => 'Ocurrió un error',
                    'codigo' => 0
                ]);
            }
        } catch (Exception $e) {
            echo json_encode([
                'detalle' => $e->getMessage(),
                'mensaje' => 'Ocurrió un error',
                'codigo' => 0
            ]);
        }
    }
    

    public static function modificarAPI()
    {
        try {
            $permiso = new Permiso($_POST);
            
            $resultado = $permiso->actualizar();

            if ($resultado['resultado'] == 1) {
                echo json_encode([
                    'mensaje' => 'Registro modificado correctamente',
                    'codigo' => 1
                ]);
            } else {
                echo json_encode([
                    'mensaje' => 'Ocurrió un error',
                    'codigo' => 0
                ]);
            }
            // echo json_encode($resultado);
        } catch (Exception $e) {

            echo json_encode([
                'detalle' => $e->getMessage(),
                'mensaje' => 'Ocurrió un error',
                'codigo' => 0
            ]);
        }
    }

    public static function eliminarAPI()
    {
        try {
            $permiso_id = $_POST['permiso_id'];
            $permiso = Permiso::find($permiso_id);
            $permiso->permiso_situacion = 0;
            $resultado = $permiso->actualizar();

            if ($resultado['resultado'] == 1) {
                echo json_encode([
                    'mensaje' => 'Registro eliminado correctamente',
                    'codigo' => 1
                ]);
            } else {
                echo json_encode([
                    'mensaje' => 'Ocurrió un error',
                    'codigo' => 0
                ]);
            }
            // echo json_encode($resultado);
        } catch (Exception $e) {
            echo json_encode([
                'detalle' => $e->getMessage(),
                'mensaje' => 'Ocurrió un error',
                'codigo' => 0
            ]);
        }
    }

 
    public static function buscarAPI()
    {
        $usu_id = $_GET['usu_id'];
        $rol_id = $_GET['rol_id'];

        $sql = "SELECT
        p.permiso_id,
        u.usu_nombre AS permiso_usuario,
        u.usu_id,
        u.usu_password,
        r.rol_nombre AS permiso_rol,
        r.rol_id,
        u.usu_estado
    FROM
        permiso p
    INNER JOIN
        usuario u ON p.permiso_usuario = u.usu_id
    INNER JOIN
        rol r ON p.permiso_rol = r.rol_id
    WHERE
        p.permiso_situacion = 1";
    
    if ($usu_id != '') {
        $sql .= " AND usuarios.usu_id = '$usu_id'";
    }
    
    if ($rol_id != '') {
        $sql .= " AND roles.rol_id = '$rol_id'";
    }

        try {

            $permisos = Permiso::fetchArray($sql);

            echo json_encode($permisos);
        } catch (Exception $e) {
            echo json_encode([
                'detalle' => $e->getMessage(),
                'mensaje' => 'Ocurrió un error',
                'codigo' => 0
            ]);
        }
    }

    
   


public static function activarAPI(){
       
    
    try {
        $usu_id = $_POST['usu_id'];
        $sql = "UPDATE usuario set usu_estado = 'ACTIVO' where usu_id = ${usu_id}";
        $resultado = Usuario::SQL($sql);
        $resultado=1;

        if ($resultado == 1) {
            echo json_encode([
                'mensaje' => 'Usuario activado correctamente' ,
                'codigo' => 1
            ]);
        } else {
            echo json_encode([
                'mensaje' => 'Ocurrió un error al actualizar',
                'codigo' => 0
            ]);
        }
       
    } catch (Exception $e) {
        echo json_encode([
            'detalle' => $e->getMessage(),
            'mensaje' => 'Ocurrió un error',
            'codigo' => 0
        ]);
    }
}
public static function desactivarAPI(){
   

    try {
        $usu_id = $_POST['usu_id'];
        $sql = "UPDATE usuario set usu_estado = 'INACTIVO' where usu_id = ${usu_id}";
        $resultado = Usuario::SQL($sql);
        $resultado=1;

        if ($resultado == 1) {
            echo json_encode([
                'mensaje' => 'Usuario desactivado correctamente' ,
                'codigo' => 1
            ]);
        } else {
            echo json_encode([
                'mensaje' => 'Ocurrió un error al actualizar',
                'codigo' => 0
            ]);
        }
       
    } catch (Exception $e) {
        echo json_encode([
            'detalle' => $e->getMessage(),
            'mensaje' => 'Ocurrió un error',
            'codigo' => 0
        ]);
    }
}
    
}

