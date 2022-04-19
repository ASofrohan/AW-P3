document = "bebidas.php";

var precio=0.0;
var pulsado = 0;
var contador = 0;
var inicio = 0;

function recalcularPrecio(checkboxEl){
    if (checkboxEl.checked) {
        precio += parseFloat(checkboxEl.value);
        //document.getElementById("precio").innerHTML=precio;
    }
    else{
        precio -= parseFloat(checkboxEl.value);
        //document.getElementById("precio").innerHTML=precio;
    }
    document.getElementById("precio").innerHTML=precio;
}

function añadir(){
    pulsado = 1;
}

function aumentar(){ // se crean la funcion y se agrega al evento onclick en en la etiqueta button con id aumentar

    var cantidad = document.getElementById('cantidad').value = ++inicio; //se obtiene el valor del input, y se incrementa en 1 el valor que tenga.
    }
    
    function disminuir(){ // se crean la funcion y se agrega al evento onclick en en la etiqueta button con id disminuir
    
    var cantidad = document.getElementById('cantidad').value = --inicio; //se obtiene el valor del input, y se decrementa en 1 el valor que tenga.
}

function myFunction(tipo) {
    var x = parseInt(document.getElementById("myText").value);
    x = x + contador;
    document.getElementById("demo").innerHTML = x;
}