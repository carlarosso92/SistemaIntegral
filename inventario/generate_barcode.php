<?php
require '../vendor/autoload.php';

use Picqer\Barcode\BarcodeGeneratorPNG;

function generateBarcode($category, $subcategory, $provider) {
    $randomNumber = rand(1000, 9999);
    $barcodeNumber = $category . $subcategory . $provider . $randomNumber;

    $generator = new BarcodeGeneratorPNG();
    $barcode = $generator->getBarcode($barcodeNumber, $generator::TYPE_CODE_128);

    // Aquí puedes guardar $barcodeNumber en tu base de datos en lugar de guardar la imagen
    // Ejemplo ficticio de cómo podrías guardar en la base de datos:
    // $pdo->query("INSERT INTO codigos_de_barras (codigo) VALUES ('$barcodeNumber')");

    return $barcodeNumber; // Retorna el número de código de barras generado
}
?>
