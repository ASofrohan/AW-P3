<?php
require_once __DIR__.'/Aplicacion.php';
class PizzaIngrediente{
    private $id_ingredientepizza;
    private $id_pizzapedida;
    private $ingrediente;
   
    private function __construct($id_ingredientepizza,$id_pizzapedida, $ingrediente) {
        $this->id_ingredientepizza = $id_ingredientepizza;
        $this->id_pizzapedida = $id_pizzapedida;
        $this->ingrediente = $ingrediente;
    }

    public static function getIngredientes($idPizzaPedida){
        $app = Aplicacion::getInstancia();
        $conn = $app->conexionBd();
        
        if(isset($_SESSION['login'])){
            $co=$_SESSION['correo'];
            $query = "SELECT * FROM pizza_ingredientes p
                        JOIN ingredientes a ON  p.ID_Ingrediente=a.ID_Ingrediente   
                        WHERE ID_PizzaPedida='$idPizzaPedida' ORDER BY a.Nombre ASC";
            $resultado=$conn->query($query);

            return $resultado;
        }else return null;
    }

    public static function muestraIngredientes($idPizzaPedida){
        $ingredientes = self::getIngredientes($idPizzaPedida);
        $arrayIngredientes = array();
      
        if($ingredientes!=null){
            if(mysqli_num_rows($ingredientes)>0){
                $i=0;
                while($row = mysqli_fetch_assoc($ingredientes)) {
                    $id_ingredientepizza=$row['ID_IngredientePizza'];
                    $id_pizzapedidaa=$row['ID_PizzaPedida'];
                    $id_ingrediente=$row['ID_Ingrediente'];
                    $p = new PizzaIngrediente($id_ingredientepizza,$id_pizzapedidaa,$id_ingrediente);
                    $arrayIngredientes[$i] = $p;
                    $i += 1;
                }
                return $arrayIngredientes;
            }
        }
        else return null;
       
    }
    public function get_id(){ return $this->id_pizzapedida;}
    public function get_idIngredientePizza(){ return $this->id_ingredientepizza;}
    public function get_idIngre(){ return $this->ingrediente;}
}