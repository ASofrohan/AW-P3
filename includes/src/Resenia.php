<?php
require_once __DIR__.'/Mensaje.php';
require_once __DIR__.'/Mensaje_respuesta.php';
require_once __DIR__.'/Usuario.php';

class Reseña
{
    public function mostrarReseñas(){
        $foro=Mensaje::mostrarReseñas();
        $foroToString="";
        foreach ($foro as $val) {
            $correo=$val->getUser();
            $user = Usuario::buscaUsuario($correo);
            if($val->getEditado()){
                $respuesta="SI";
            }
            else{
                $respuesta="NO";
            }
            $foroToString=$foroToString . "[Id: " . $val->getId() . "] Usuario: " . $user->getNombre() . " " .
            $user->getApellidos() . " (Editado: " . $respuesta . ") [Fecha: ". $val->getFecha() ."]<br>Comentario: " . $val->getComentario() .
            "<br>Puntuacion: " . $val->getPuntuacion() . "<br>Respuestas: ";

            $respuestas=Mensaje_respuesta::mostrarRespuestas($val->getId());
            $isEmpty = empty($respuestas);
            if($isEmpty){
                $foroToString=$foroToString."NO HAY RESPUESTAS";
            }
            else{
                foreach ($respuestas as $res) {
                    $correo=$res->getUser();
                    $user = Usuario::buscaUsuario($correo);
                    $foroToString=$foroToString. "<br>[Id respuesta: " . $res->getId() . "] Usuario: " . $user->getNombre() . " " .
                    $user->getApellidos() . " [Fecha: ". $res->getFecha() ."]<br>Respuesta: " . $res->getRespuesta();
                }
            }
            $foroToString=$foroToString . "<br>";
            if(!isset($_SESSION["login"])){
                $foroToString=$foroToString . "<br>";
            }
            else{
                $id=$val->getId();
                $foroToString=$foroToString .  "
                <a href='borrarMensajeForo.php?id=$id'><input type='button' value='Borrar'></a>
                <a href='actualizarMensajeForo.php?id=$id'><input type='button' value='Editar'></a>
                <a href='responderMensajeForo.php?id=$id'><input type='button' value='Responder'></a>";
                $foroToString=$foroToString . "<br><br>";
            }
        }

        if(!isset($_SESSION["login"])){
            $foroToString=$foroToString . "<br><br>";
        }
        else{
            $foroToString=$foroToString .
            "<a href='enviarMensajeForo.php'><input type='button' value='Enviar nuevo mensaje'></a><br><br>";
        }
        return $foroToString;
    }

}