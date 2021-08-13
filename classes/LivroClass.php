<?php


class LivroClass
{
    private $id;
    private $nome;
    private $autor;
    private $estante;

    public function __construct($id, $nome, $estante, $autor)
    {
        $this->setId($id);
        $this->setNome($nome);
        $this->setEstante($estante);
        $this->setAutor($autor);
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getNome()
    {
        return $this->nome;
    }

    /**
     * @param mixed $nome
     */
    public function setNome($nome)
    {
        $this->nome = $nome;
    }

    /**
     * @return mixed
     */
    public function getAutor()
    {
        return $this->autor;
    }

    /**
     * @param mixed $autor
     */
    public function setAutor($autor)
    {
        $this->autor = $autor;
    }

    /**
     * @return mixed
     */
    public function getEstante()
    {
        return $this->estante;
    }

    /**
     * @param mixed $estante
     */
    public function setEstante($estante)
    {
        $this->estante = $estante;
    }

}
