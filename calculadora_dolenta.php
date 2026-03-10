<?php
 // Gabriel Calero


// constants de la operació


const OPERACION_SUMA = 1;
const OPERACION_RESTA = 2;
const OPERACION_DIVISION = 3;
const OPERACION_MULTIPLICACION = 4;

const IVA_PORCENTAJE = 0.21;
const FACTOR_CON_IVA = 1.21;
const DESCUENTO = 0.95; 


//  funcions de calcul

function sumar($numero1, $numero2) {
    return $numero1 + $numero2;
}

function restar($numero1, $numero2) {
    return $numero1 - $numero2;
}

function multiplicar($numero1, $numero2) {
    return $numero1 * $numero2;
}


 //gestiona la divisió i controla l'error de divisió per zero.
 
function dividir($numero1, $numero2) {
    if ($numero2 == 0) {
        throw new Exception("Error: No es pot dividir per zero.");
    }
    return $numero1 / $numero2;
}


 // valida si els inputs són numèrics.
 
function validarNumeros($num1, $num2) {
    return is_numeric($num1) && is_numeric($num2);
}


 // funció principal calculadora on realitza les funcions
 
function calcularOperacion($numero1, $numero2, $operacion) {
    switch ($operacion) {
        case OPERACION_SUMA:
            return sumar($numero1, $numero2);
        case OPERACION_RESTA:
            return restar($numero1, $numero2);
        case OPERACION_MULTIPLICACION:
            return multiplicar($numero1, $numero2);
        case OPERACION_DIVISION:
            return dividir($numero1, $numero2);
        default:
            throw new Exception("Operació no vàlida.");
    }
}

// funcions per calcular el IVA
function calcularIVA($precioBase) {
    return $precioBase * IVA_PORCENTAJE;
}

function calcularTotalConIVA($precioBase) {
    return $precioBase * FACTOR_CON_IVA;
}

function aplicarDescuento($cantidad) {
    return $cantidad * DESCUENTO;
}


// funcions per visualitzar en pantalla la operació


function mostrarResultado($operacion, $resultado) {
    $nomsOperacions = [
        OPERACION_SUMA => "Suma",
        OPERACION_RESTA => "Resta",
        OPERACION_MULTIPLICACION => "Multiplicació",
        OPERACION_DIVISION => "Divisió"
    ];
    
    $nom = $nomsOperacions[$operacion] ?? "Operació";
    echo "$nom: El resultat és $resultado <br>";
}

function mostrarError($missatge) {
   // he afegit un span en cas de que doni error
    echo "<span style='color:red;'>$missatge</span><br>";
}

function aplicarIVAYDescuento($precioBase) {
    $iva = calcularIVA($precioBase);
    $totalConIva = calcularTotalConIVA($precioBase);
    $totalFinal = aplicarDescuento($totalConIva);

    echo "<h3>Resum de factura:</h3>";
    echo "Preu Base: $precioBase €<br>";
    echo "IVA: $iva €<br>";
    echo "Total amb IVA: $totalConIva €<br>";
    echo "Total amb descompte aplicat: $totalFinal €<br>";
}

 // funcio completa
 
function realizarOperacion($numero1, $numero2, $operacion) {
    try {
        $resultado = calcularOperacion($numero1, $numero2, $operacion);
        mostrarResultado($operacion, $resultado);
    } catch (Exception $e) {
        mostrarError($e->getMessage());
    }
}




// ariables  
$primerNumero = 10;
$segundoNumero = 5;

echo "<h2>Resultats de la Calculadora</h2>";

// validació 
if (validarNumeros($primerNumero, $segundoNumero)) {
    
    
    $operaciones = [
        OPERACION_SUMA,
        OPERACION_RESTA,
        OPERACION_DIVISION,
        OPERACION_MULTIPLICACION
    ];

    foreach ($operaciones as $op) {
        realizarOperacion($primerNumero, $segundoNumero, $op);
    }

    echo "<hr>";

    // processament IVA i descomptes
    $precioBase = calcularOperacion($primerNumero, $segundoNumero, OPERACION_SUMA);
    aplicarIVAYDescuento($precioBase);

} else {
    mostrarError("Els valors introduïts no són numèrics.");
}

?>