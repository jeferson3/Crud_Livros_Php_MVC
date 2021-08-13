<?php

require '../../models/Livro.php';

if(strtolower($_SERVER['REQUEST_METHOD']) != 'post'){
    header('Method not Allowed', false, 405);
}

session_start();

$nome = (isset($_POST['nome']) && !empty($_POST['nome'])) ? $_POST['nome'] : null;
$estante = (isset($_POST['estante']) && !empty($_POST['estante'])) ? $_POST['estante'] : null;
$autor = (isset($_POST['autor']) && !empty($_POST['autor'])) ? $_POST['autor'] : null;

if (!is_null($nome) && !is_null($estante) && !is_null($autor)){

    $livro = new LivroClass(null, $nome, $estante, $autor);

    $status = (new Livro())->create($livro);

    if ($status){
        $_SESSION['status'] = true;
        $_SESSION['message'] = 'Livro criado com sucesso';
    }
    else {
        $_SESSION['status'] = false;
        $_SESSION['message'] = 'Ocorreu um erro inesperado, consulte o suporte técnico!';
    }
    header('location: '.$_SERVER['HTTP_REFERER']);
    exit();
}
$_SESSION['status'] = false;
$_SESSION['message'] = 'Ocorreu um erro inesperado, consulte o suporte técnico!';
header('location: '.$_SERVER['HTTP_REFERER']);
exit();
