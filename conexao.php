<?php

class Crud
{

    private $host;
    private $db;
    private $user;
    private $pass;

    function Crud($host, $db, $user, $pass)
    {
        $this->host = $host;
        $this->db = $db;
        $this->user = $user;
        $this->pass = $pass;
    }
    function conexao()
    {
        try {
            return new PDO("mysql:host=$this->host;dbname=$this->db", $this->user, $this->pass);
        } catch (Exception $error) {
            echo "<div class='alert alert-danger'><strong>Erro in connection:</strong><br>".$error->getMessage()."</div>";
        }
    }

    function pegarDados($con)
    {
        if ($con) {
            try {
                return $con->query("SELECT * from pessoas");
            } catch (Exception $error) {
                echo "Get data error:<br>" . $error->getMessage();
            }
        }
    }
    function inserirDados($con, $data)
    {
        if($con){
            try {
                $stmt = $con->prepare("INSERT into pessoas
                (nome, sobrenome, email, descricao) 
                values(?, ?, ?, ?)");
                $stmt->execute($data);
                return $stmt;
            } catch (Exception $error) {
                return $error->getMessage();
            }
        }
    }

    function deletarDados($con, $id)
    {
        if($con){
            try {
                return $con->query("DELETE from pessoas where id=$id");
            } catch (Exception $error) {
                return $error->getMessage();
            }
        }
    }

    function atualizarDados($con, $id, $novosDados)
    {
        // em construção
    }
}
