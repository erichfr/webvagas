<?php 

require __DIR__ ."./vendor/autoload.php";

use \App\Entity\Vaga;

// Validação do ID
if(!isset($_GET['id']) or !is_numeric($_GET['id'])){
    header('location: index.php?status=error');
    exit;
}


$objVaga = Vaga::getVaga($_GET['id']);
/* echo "<pre>";
print_r($objVaga);
echo "</pre>";
exit; */


//Validação POST
if(isset($_POST['titulo'],$_POST['descricao'],$_POST['ativo'])){
    $objVaga = new Vaga;

    $objVaga->titulo = $_POST['titulo'];
    $objVaga->descricao = $_POST['descricao'];
    $objVaga->ativo = $_POST['ativo'];
    $objVaga->cadastrar();

    header('Location: index.php?status=success');
    exit;
}


include __DIR__ . "./includes/header.php";
include __DIR__ . "./includes/formulario.php";
include __DIR__ . "./includes/footer.php";