<?php

require_once dirname(__DIR__,2).'/models/Livro.php';

/**
 * @return array
 */
function getAllLivros(){
    return (new Livro)->all();
}
