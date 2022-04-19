document = "FormularioPersonalizada.php";

var precioPizza= 8.99;
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
    if(tam.name=="t_personalizada"){
        precioPizza= 4.99;
    }
    else{
        precioPizza=8.99;
    }
    precioTamaño =parseFloat(tam.options[tam.selectedIndex].value);
    document.getElementById("precio").innerHTML= precioIngrediente + precioTamaño + precioPizza;
}

function ingredientes(ingredientes){
}

