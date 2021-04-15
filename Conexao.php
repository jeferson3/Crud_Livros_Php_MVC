<?php

final class Conexao
{

    private static $instance = null;
    private static $host = "localhost";
    private static $db = "teste";
    private static $user = "root";
    private static $pass = "";


    public static function getInstance(): ?PDO
    {
        $dir = $_SERVER["DOCUMENT_ROOT"]."/config/credentials.ini";

        if (file_exists($dir))
        {
            $settings = parse_url($dir);

            self::$host = $settings['host'];
            self::$db = $settings['db'];
            self::$user = $settings['user'];
            self::$pass = $settings['pass'];
        }
        if (is_null(self::$instance))
        {
            $dsn = "mysql:dbname=".self::$db.";host=". self::$host;
            try {
                return self::$instance = new PDO($dsn, self::$user, self::$pass, array(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION));
            } catch (Exception $error) {
                $_SESSION['message'] = 'Erro ao conectar ao servidor!';
                $_SESSION['messageType'] = 'danger';

                return null;
            }
        }
        return self::$instance;
    }
}

