document = "FormularioPersonalizada.php";

var precioPizza= 4.99
var precioIngrediente= 0.00;
var precioTamaño=0.00;
var ant=0.0;

function recalcularPrecio(checkboxEl){
    if (checkboxEl.checked) {
        precioIngrediente += parseFloat(checkboxEl.value);
    }
    else{
        precioIngrediente -= parseFloat(checkboxEl.value);
    }
    document.getElementById("precio").innerHTML= precioIngrediente + precioTamaño + precioPizza;
}

function precioTam(tam){
    precioTamaño =parseFloat(tam.options[tam.selectedIndex].value);
    document.getElementById("precio").innerHTML= precioIngrediente + precioTamaño + precioPizza;
}

function ingredientes(ingredientes){
}
