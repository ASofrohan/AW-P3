<?php
require_once __DIR__.'/Form.php';
require_once __DIR__.'/Mensaje.php';
require_once __DIR__.'/Usuario.php';

class FormularioActualizarMensaje extends Form
{
    public function __construct() {
        parent::__construct('formActualizarMensaje');
    }
    
    protected function generaCamposFormulario($datos, $errores = array())
    {
        $comentario = $datos['mensaje'] ?? '';

        // Se generan los mensajes de error si existen.
        $htmlErroresGlobales = self::generaListaErroresGlobales($errores);
        $errorComentario = self::createMensajeError($errores, 'comentario', 'span', array('class' => 'error'));
        $htmlErroresGlobales = self::generaListaErroresGlobales($errores);

        $html = <<<EOF
        <div id="foro">
            <fieldset>
                $htmlErroresGlobales
                <div class="container"><div class="card" style="width: 17rem;"><div class="card-header">
                <div class="grupo-control">
                <label>Mensaje:</label>
                <br>
                <textarea name='mensaje'></textarea>$errorComentario
                <br>
                </div>
                <div class="grupo-control">
                <label>Estrellas:</label>
                <select name="estrellas">
                  <option value="1">*</option>
                  <option value="2">**</option>
                  <option value="3">***</option>
                  <option value="4">****</option>
                  <option value="5" selected>*****</option>
                </select>
                </div>
                <div class="grupo-control"><button class="btn btn-outline-success" type="submit" name="Enviar">Enviar</button>
                </div></div></div></div>
            </fieldset>
            <div>
        EOF;
        return $html;
    }
    

    protected function procesaFormulario($datos)
    {
        $result = array();

        $user = $_SESSION['correo'];
        $puntuacion = $datos['estrellas'] ?? null;
        
        $mensaje = $datos['mensaje'] ?? null;
        if ( empty($mensaje)) {
            $result['comentario'] = "El mensaje no puede estar vacio.";
        }

        $id = $_SESSION["editar"];

        if ( empty($id) ) {
            $result['id'] = "Selecciona un Id valido.";
        }

        $mensaje = Mensaje::edita($id,$user,$mensaje,$puntuacion);

        if($mensaje==null){
            $result['id'] = "El Id no corresponde a ningun mensaje enviado por ti.";
        }
        if (count($result) === 0) {
            unset($_SESSION["editar"]);
            $result = 'foro.php';
        }
        
        return $result;
    }

}