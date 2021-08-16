<?php

require '../../models/Livro.php';

if(strtolower($_SERVER['REQUEST_METHOD']) != 'post'){
    header('Method not Allowed', false, 405);
}

session_start();

$id = isset($_POST['id']) ? $_POST['id'] : null;

if (!is_null($id) && !is_null((new Livro())->find($id))){

    $status = (new Livro())->delete($id);

    if ($status){
        $_SESSION['status'] = true;
        $_SESSION['message'] = 'Livro deletado com sucesso';
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
