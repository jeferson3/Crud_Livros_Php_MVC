<?php

require_once dirname(__DIR__,2).'/models/Livro.php';

function getLivro($id){

    $livro = (new Livro())->find($id);

    if ($livro) return $livro;

    session_start();
    $_SESSION['status'] = false;
    $_SESSION['message'] = "Livro não encontrado!";
    header('location: /');
    exit();
}
