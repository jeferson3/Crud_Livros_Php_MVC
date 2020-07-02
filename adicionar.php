<?php

if ($_POST['adicionar']) {
    require_once('conexao.php');

    $nome = isset($_POST['nome']) ? $_POST['nome'] : 'nome';
    $sobrenome = isset($_POST['sobrenome']) ? $_POST['sobrenome'] : 'sobrenome';
    $email = isset($_POST['email']) ? $_POST['email'] : 'email';
    $descricao = isset($_POST['txt']) ? $_POST['txt'] : 'descricao';

    session_start();

    $crud = new Crud("localhost", "crud", "root", "");
    $con = $crud->conexao();
    $crud->inserirDados($con, [$nome, $sobrenome, $email, $descricao]);

}
header("location: index.php");
