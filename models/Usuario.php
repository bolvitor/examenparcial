<?php

namespace Model;

class usuario extends ActiveRecord{
    public static $tabla = 'usuario';
    public static $columnasDB = ['usu_nombre', 'usu_catalogo','usu_password','usu_situacion'];
    public static $idTabla = 'usu_id';

    public $usu_id;
    public $usu_nombre;
    public $usu_catalogo;
    public $usu_password;
    public $usu_situacion;

    public function __construct($args =[])
    {
        $this->usu_id = $args['usu_id'] ?? null;
        $this->usu_nombre = $args['usu_nombre'] ?? '';
        $this->usu_catalogo = $args['usu_catalogo'] ?? '';
        $this->usu_password = $args['usu_password'] ?? '';
        $this->usu_situacion = $args['usu_situacion'] ?? '0';
    }

}