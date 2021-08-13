<?php

require_once dirname(__DIR__) .'/config/Connection.php';

class Model
{
    /**
     * @var PDO
     */
    protected $con;

    public function __construct()
    {
        $this->con = (new Connection())->getInstance();
    }
}
