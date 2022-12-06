<?php 

class Usuarios_ctrl{
    public $M_Usuario = null;

    public function __construct(){
        
        $this->M_Usuario = new M_Usuarios();
       
    }

    //Funcion para consultar una id
    public function consultar($f3){
        $usuario_id = $f3->get('PARAMS.usuario_id');
        $this->M_Usuario->load(['id = ?',$usuario_id]);

        $msg = "";
        $item = array();

        if($this->M_Usuario->loaded() > 0) {
            $msg = "Alumno encontrado";
            $item = $this->M_Usuario->cast();
        }else{
            $msg = "Alumno no encontrado";
        }

        echo json_encode([ 
            'Mensaje' => $msg,
            'info' => [
                'item' => $item
            ]
        ]);
    }

    //Funcion para listar toda la tabla 
    public function listado($f3){
        $result = $this->M_Usuario->find();
        $items = array();

        foreach($result as $usuario){
            $items[] = $usuario->cast();
        }
        echo json_encode([ 
            'Mensaje' => count($items) > 0 ? '' : 'Aun no hay registros para mostrar',
            'info' => [
                'items' => $items,
                'total' => count($items)
            ]
        ]);
    }


}