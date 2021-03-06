<?php
require_once __DIR__.'/Form.php';
require_once __DIR__.'/Mensaje.php';
require_once __DIR__.'/Usuario.php';

class FormularioBorrarMensaje extends Form
{
    public function __construct() {
        parent::__construct('formBorrarMensaje');
    }
    
    protected function generaCamposFormulario($datos, $errores = array())
    {

        // Se generan los mensajes de error si existen.
        $htmlErroresGlobales = self::generaListaErroresGlobales($errores);
        $htmlErroresGlobales = self::generaListaErroresGlobales($errores);

        $html = <<<EOF
        <div id="foro">
            <fieldset>
                $htmlErroresGlobales
                <div class="container"><div class="card" style="width: 8rem;"><div class="card-header">
                <div class="grupo-control"><button class="btn btn-outline-danger" type="submit" name="Enviar">Aceptar</button>
                </div></div></div></div>
            </fieldset>
            <div>
        EOF;
        return $html;
    }
    

    protected function procesaFormulario($datos)
    {

        $result = array();

        $id = $_SESSION["borrar"];

        if ( empty($id) ) {
            $result['id'] = "Selecciona un Id valido.";
        }

        
        if (count($result) === 0) {
            $mensaje = Mensaje::borra($id);
            if($mensaje==null){
                unset($_SESSION["borrar"]);
                $result['id'] = "El mensaje ha sido respondido y no puede ser eliminado.";
                return $result;
            }
            unset($_SESSION["borrar"]);
        }
        $result = 'foro.php';
        return $result;
    }

}