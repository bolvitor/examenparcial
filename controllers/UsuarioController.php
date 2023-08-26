<?php

namespace Controllers;

use Exception;
use Model\Area;
use MVC\Router;

class AreaController{
    public static function index(Router $router){
        $areas = Area::all();
        // $areas2 = area::all();
        // var_dump($areas);
        // exit;
        $router->render('areas/index', [
            'areas' => $areas,
            // 'areas2' => $areas2,
        ]);

    }

    public static function guardarAPI(){
        try {
            $area = new Area($_POST);
            $resultado = $area->crear();

            if($resultado['resultado'] == 1){
                echo json_encode([
                    'mensaje' => 'Registro guardado correctamente',
                    'codigo' => 1
                ]);
            }else{
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

    public static function modificarAPI(){
        try {
            $area = new Area($_POST);
            $resultado = $area->actualizar();

            if($resultado['resultado'] == 1){
                echo json_encode([
                    'mensaje' => 'Registro modificado correctamente',
                    'codigo' => 1
                ]);
            }else{
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

    public static function eliminarAPI(){
        try {
            $area_id = $_POST['area_id'];
            $area = Area::find($area_id);
            $area->area_situacion = 0;
            $resultado = $area->actualizar();

            if($resultado['resultado'] == 1){
                echo json_encode([
                    'mensaje' => 'Registro eliminado correctamente',
                    'codigo' => 1
                ]);
            }else{
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

    public static function buscarAPI(){
        // $areas = area::all();
        $area_nombre = $_GET['area_nombre'];
        
        $sql = "SELECT * FROM areas where area_situacion = 1 ";
        if($area_nombre != '') {
            $area_nombre = strtolower($area_nombre);
            $sql.= " and LOWER(area_nombre) like '%$area_nombre%' ";
        }
        try {
            
            $areas = Area::fetchArray($sql);
    
            echo json_encode($areas);
        } catch (Exception $e) {
            echo json_encode([
                'detalle' => $e->getMessage(),
                'mensaje' => 'Ocurrió un error',
                'codigo' => 0
            ]);
        }
    }
}