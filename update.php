<?php

if ($_POST['atualizar']) {
    require_once('conexao.php');

    $id = isset($_POST['id']) ? $_POST['id'] : 'id';
    $nome = isset($_POST['nome']) ? $_POST['nome'] : 'nome';
    $sobrenome = isset($_POST['sobrenome']) ? $_POST['sobrenome'] : 'sobrenome';
    $email = isset($_POST['email']) ? $_POST['email'] : 'email';
    $descricao = isset($_POST['txt']) ? $_POST['txt'] : 'descricao';

    echo $id, $nome, $sobrenome;

    session_start();

    $crud = new Crud("localhost", "crud", "root", "");
    $con = $crud->conexao();
    $crud->atualizarDados($con, $id, [$nome, $sobrenome, $email, $descricao]);
}
header('location: index.php');
