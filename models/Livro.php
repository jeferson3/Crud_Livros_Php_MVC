<?php

require_once __DIR__.'/Model.php';
require_once dirname(__DIR__).'/classes/LivroClass.php';

final class Livro extends Model
{

    /**
     * return stored book from database by id
     *
     * @param $id
     * @return LivroClass|null
     */
    public function find($id)
    {
        try {
            $sql = "SELECT * from livros where id = :id limit 1";
            $query = $this->con->prepare($sql);
            $query->bindValue(':id', $id);

            if ($query->execute() && $query->rowCount() === 1){
                $data = $query->fetch(PDO::FETCH_OBJ);
                return (new LivroClass($data->id, $data->nome, $data->estante, $data->autor));
            }
            return null;
        }
        catch (PDOException $exception){
            return null;
        }
    }

    /**
     * return all stored books from database
     *
     * @return array
     */
    public function all()
    {
        try {
            $sql = "SELECT * from livros";
            $query = $this->con->query($sql);
            $data = array();

            if ($query->rowCount() > 0){
                foreach ($query->fetchAll(PDO::FETCH_OBJ) as $value){
                    array_push($data, (new LivroClass($value->id,$value->nome,$value->estante,$value->autor)));
                }
            }
            return $data;
        }
        catch (PDOException $exception){
            return [];
        }
    }

    /**
     * store new book in database
     *
     * @param LivroClass $livro
     * @return bool
     */
    public function create(LivroClass $livro)
    {
        try {

            $sql = "INSERT into livros (nome, estante, autor) values (:nome, :estante, :autor)";
            $query = $this->con->prepare($sql);
            $query->bindValue(':nome', $livro->getNome());
            $query->bindValue(':estante', $livro->getEstante());
            $query->bindValue(':autor', $livro->getAutor());

            return $query->execute();
        }
        catch (PDOException $exception){
            return false;
        }
    }

    /**
     * delete book from database
     *
     * @param $id
     * @return bool
     */
    public function delete($id)
    {
        try {

            $sql = 'DELETE from livros where id = :id';
            $query = $this->con->prepare($sql);
            $query->bindValue(':id', $id);

            return $query->execute();
        }
        catch (PDOException $exception){
            return false;
        }
    }

    /**
     * update book from database
     *
     * @param LivroClass $livro
     * @return bool
     */
    public function update(LivroClass $livro)
    {
        try {

            $sql = 'UPDATE livros set nome=:nome, estante=:estante, autor=:autor where id = :id';
            $query = $this->con->prepare($sql);
            $query->bindValue(':id', $livro->getId());
            $query->bindValue(':nome', $livro->getNome());
            $query->bindValue(':estante', $livro->getEstante());
            $query->bindValue(':autor', $livro->getAutor());

            return $query->execute();
        }
        catch (PDOException $exception){
            return false;
        }
    }
}
