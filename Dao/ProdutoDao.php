<?php

require_once($_SERVER["DOCUMENT_ROOT"] . "/Conexao.php");

class ProdutoDao
{
    public static function pegarDados()
    {
        $con = Conexao::getInstance();
        if (!is_null($con)) {
            try {
                return $con->query("SELECT * from products");
            } catch (Exception $error) {
                return $error->getMessage();
            }
        }
        return null;
    }

    public static function pegarPorId($id)
    {
        $con = Conexao::getInstance();

        if (!is_null($con)) {
            try {
                $con->prepare("SELECT * from products where id=:id");
                $query = $con->bindValue(":id", $id);

                return $query->execute();

            } catch (Exception $error) {
                return $error->getMessage();
            }
        }
        return null;
    }

    public static function inserirDados(ProdutoVo $produto)
    {
        $con = Conexao::getInstance();

        if (!is_null($con)) {
            try {
                $query = $con->prepare("INSERT into products(name, description, price, slug)
                values(:name, :description, :price, :slug)");

                $query->bindValue(":name", $produto->getName());
                $query->bindValue(":description", $produto->getDescription());
                $query->bindValue(":price", $produto->getPrice());
                $query->bindValue(":slug", $produto->getSlug());

                if ($query->execute()) {
                    $_SESSION['message'] = 'Criado com sucesso';
                    $_SESSION['messageType'] = 'success';

                    return true;
                }
                else
                {
                    $_SESSION['message'] = 'Erro ao adicionar novo usuário';
                    $_SESSION['messageType'] = 'warn';
                    return false;
                }

            } catch (Exception $error) {
                return $error->getMessage();
            }
        }

        return null;
    }

    public static function deletarDados($id)
    {
        $con = Conexao::getInstance();

        if (!is_null($con)) {
            try {
                $query = $con->prepare("DELETE from products where id=:id");
                $query->bindValue(":id",$id);

                if($query->execute())
                {
                    $_SESSION['message'] = 'Produto deletado com sucesso';
                    $_SESSION['messageType'] = 'success';

                    return true;
                }
                else{
                    $_SESSION['message'] = 'Erro ao deletar produto';
                    $_SESSION['messageType'] = 'warn';

                    return true;
                }
            } catch (Exception $error) {
                return $error->getMessage();
            }
        }
        return null;
    }

    public static function atualizarDados($id, $novosDados)
    {
        $con = Conexao::getInstance();

        if (!is_null($con)) {
            // increment
        }
        return null;
    }
}