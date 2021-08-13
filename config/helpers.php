<?php

/**
 * return all credentials
 *
 * @return array|false
 */
function loadCredentials(){
    return parse_ini_file(__DIR__.'/credencials.ini');
}
