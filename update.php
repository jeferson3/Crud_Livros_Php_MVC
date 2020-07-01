<?php

if ($_POST['atualizar']) {
    require_once('conexao.php');

    $id = isset($_POST['id']) ? $_POST['id'] : 'id';
    $nome = isset($_POST['nome']) ? $_POST['nome'] : 'nome';
    $sobrenome = isset($_POST['sobrenome']) ? $_POST['sobrenome'] : 'sobrenome';
    $email = isset($_POST['email']) ? $_POST['email'] : 'email';
    $descricao = isset($_POST['txt']) ? $_POST['txt'] : 'descricao';

    session_start();

    header('location: index.php');
}
