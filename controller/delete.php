<?php

require_once($_SERVER["DOCUMENT_ROOT"].'/Conexao.php');
require_once($_SERVER["DOCUMENT_ROOT"] . "/Dao/ProdutoDao.php");

if (isset($_POST['deletar']) and isset($_POST['id'])) {

    session_start();
    ProdutoDao::deletarDados($_POST['id']);

}

header("location: /");
