<?php
require_once __DIR__.'/Form.php';
require_once __DIR__.'/Mensaje.php';
require_once __DIR__.'/Usuario.php';

class FormularioEnviarMensaje extends Form
{
    public function __construct() {
        parent::__construct('formEnviarMensaje');
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
                <form>
                <div class="grupo-control">
                    <label for="exampleFormControlTextarea1">Mensaje</label>
                    <textarea class="form-control" id="mensaje" rows="3"></textarea>
                </div>
                <div class="grupo-control">
                  <label for="exampleFormControlSelect1">Estrellas</label>
                  <select class="form-control" id="estrellas">
                  <option value="1">*</option>
                  <option value="2">**</option>
                  <option value="3">***</option>
                  <option value="4">****</option>
                  <option value="5" selected>*****</option>
                  </select>
                </div>
                <div class="btnenviar">
                <input class="btn btn-secondary btn-sm" type="submit" value="Enviar">
                </div>
              </form>
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
        

        
        if (count($result) === 0) {
            $mensaje = Mensaje::crea($user,$mensaje,$puntuacion);
            $result = 'foro.php';
        }
        return $result;
    }

}