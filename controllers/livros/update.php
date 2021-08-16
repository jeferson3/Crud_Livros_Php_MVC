<?php

require '../../models/Livro.php';

if(strtolower($_SERVER['REQUEST_METHOD']) != 'post'){
    header('Method not Allowed', false, 405);
}

session_start();

$id = (isset($_POST['id']) && !empty($_POST['id'])) ? $_POST['id'] : null;
$nome = (isset($_POST['nome']) && !empty($_POST['nome'])) ? $_POST['nome'] : null;
$estante = (isset($_POST['estante']) && !empty($_POST['estante'])) ? $_POST['estante'] : null;
$autor = (isset($_POST['autor']) && !empty($_POST['autor'])) ? $_POST['autor'] : null;

if (!is_null($id) && !is_null((new Livro())->find($id)) && !is_null($nome) && !is_null($estante) && !is_null($autor)){

    $novoLivro = new LivroClass($id, $nome, $estante, $autor);

    $status = (new Livro())->update($novoLivro);

    if ($status){
        $_SESSION['status'] = true;
        $_SESSION['message'] = 'Livro atualizado com sucesso';
    }
    else {
        $_SESSION['status'] = false;
        $_SESSION['message'] = 'Ocorreu um erro inesperado, consulte o suporte técnico!';
    }
    header('location: '.$_SERVER['HTTP_ORIGIN']);
    exit();
}
$_SESSION['status'] = false;
$_SESSION['message'] = 'Ocorreu um erro inesperado, consulte o suporte técnico!';
header('location: '.$_SERVER['HTTP_ORIGIN']);
exit();
