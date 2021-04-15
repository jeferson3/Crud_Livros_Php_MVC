<?php

require_once($_SERVER["DOCUMENT_ROOT"].'/Conexao.php');
require_once($_SERVER["DOCUMENT_ROOT"]."/Vo/ProdutoVo.php");
require_once($_SERVER["DOCUMENT_ROOT"] . "/Dao/ProdutoDao.php");

if (isset($_POST['adicionar'])) {

    $name = isset($_POST['name']) ? $_POST['name'] : null;
    $description = isset($_POST['description']) ? $_POST['description'] : null;
    $price = isset($_POST['price']) ? $_POST['price'] : null;

    if (!is_null($name) and !is_null($description) and !is_null($price))
    {
        $produto = new ProdutoVo();
        $produto->setName(trim($name));
        $produto->setDescription(trim($description));
        $produto->setPrice(str_replace([".",","],["","."], $price));
        $produto->setSlug(trim(implode("-", explode(" ", $produto->getName()))));

        session_start();
        ProdutoDao::inserirDados($produto);
    }
}
header("location: /");
