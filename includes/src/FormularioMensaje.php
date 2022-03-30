<?php
require_once __DIR__.'/Form.php';
require_once __DIR__.'/Mensaje.php';

class FormularioMensaje extends Form
{
    public function __construct() {
        parent::__construct('formMensaje');
    }
    
    protected function generaCamposFormulario($datos, $errores = array())
    {
        $nombreUsuario = $datos['nombreUsuario'] ?? '';
        $comentario = $datos['comentario'] ?? '';

        // Se generan los mensajes de error si existen.
        $htmlErroresGlobales = self::generaListaErroresGlobales($errores);
        $errorComentario = self::createMensajeError($errores, 'comentario', 'span', array('class' => 'error'));
        $errorPuntuacion = self::createMensajeError($errores, 'puntuacion', 'span', array('class' => 'error'));
        $htmlErroresGlobales = self::generaListaErroresGlobales($errores);

        $html = <<<EOF
            <fieldset>
                $htmlErroresGlobales
                <div class="grupo-control">
                <label>Mensaje:</label><textarea name='mensaje'></textarea>
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
                </div>$errorPuntuacion
                <div class="grupo-control"><button type="submit" name="Enviar">Enviar</button></div>
            </fieldset>
        EOF;
        return $html;
    }
    

    protected function procesaFormulario($datos)
    {
        $result = array();
        
        if ( empty($mensaje)) {
            $result['mensaje'] = "El mensaje no puede estar vacio.";
        }


        $puntuacion = $datos['estrellas'] ?? null;
        
        if (count($result) === 0) {
            $mensaje = Mensaje::crea($user,$mensaje,$puntuacion);
            //if ( ! $user ) {
            //    $result[] = "El usuario ya existe";
           // } else {
                //$_SESSION['login'] = true;
               // $_SESSION['nombre'] = $nombre;
                $result = 'reseñas.php';
        }
        return $result;
    }

    public function mostrarForo(){
        return Mensaje::mostrarForo();
    }

}