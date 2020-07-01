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
            $_SESSION['message'] = 'Erro ao conectar ao servidor jjdhjd';
            $_SESSION['messageType'] = 'danger';
            return false;
        }
    }

    function pegarDados($con)
    {
        if ($con) {
            try {
                return $con->query("SELECT * from pessoas");
            } catch (Exception $error) {
                return $error->getMessage();
            }
        }
    }
    function pegarPorId($con, $id)
    {
        if ($con) {
            try {
                return $con->query("SELECT * from pessoas where id=$id");
            } catch (Exception $error) {
                return $error->getMessage();
            }
        }
    }
    function inserirDados($con, $data)
    {
        if ($con) {
            try {
                $stmt = $con->prepare("INSERT into pessoas
                (nome, sobrenome, email, descricao) 
                values(?, ?, ?, ?)");
                $stmt->execute($data);

                $_SESSION['message'] = 'Criado com sucesso';
                $_SESSION['messageType'] = 'success';
                return $stmt;
            } catch (Exception $error) {
                $_SESSION['message'] = 'Erro ao adicionar novo usuário';
                $_SESSION['messageType'] = 'warn';
                return $error->getMessage();
            }
        }
    }

    function deletarDados($con, $id)
    {
        if ($con) {
            try {
                $_SESSION['message'] = 'Deletado com sucesso';
                $_SESSION['messageType'] = 'success';
                return $con->query("DELETE from pessoas where id=$id");
            } catch (Exception $error) {
                $_SESSION['message'] = 'Erro ao deletar usuário';
                $_SESSION['messageType'] = 'warn';
                return $error->getMessage();
            }
        }
    }

    function atualizarDados($con, $id, $novosDados)
    {
        if ($con) {
            [$nome] = $novosDados;
            echo $nome;
            // try {
            //     $_SESSION['message'] = 'Atualizado com sucesso';
            //     $_SESSION['messageType'] = 'success';
            //     return $con->query("UPDATE pessoas SET name=  where id=$id");

            // } catch (Exception $error) {
            //     $_SESSION['message'] = 'Erro ao atualizar usuário';
            //     $_SESSION['messageType'] = 'warn';
            //     return $error->getMessage();
            // }
        }
    }
}
