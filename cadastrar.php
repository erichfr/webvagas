<?php 

require __DIR__ ."./vendor/autoload.php";

use \App\Entity\Vaga;


//Validação POST
if(isset($_POST['titulo'],$_POST['descricao'],$_POST['ativo'])){
    $objVaga = new Vaga;

    $objVaga->titulo = $_POST['titulo'];
    $objVaga->descricao = $_POST['descricao'];
    $objVaga->ativo = $_POST['ativo'];
    $objVaga->cadastrar();


    /* echo "<pre>";
    print_r($objVaga);
    echo "</pre>";
    exit; */
}


include __DIR__ . "./includes/header.php";
include __DIR__ . "./includes/formulario.php";
include __DIR__ . "./includes/footer.php";