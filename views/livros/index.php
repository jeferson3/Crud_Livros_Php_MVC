<?php
    // importação dos controladores
    require dirname(__DIR__,2)."/controllers/livros/index.php";
    require dirname(__DIR__,2)."/controllers/livros/show.php";

    $livros = getAllLivros(); //pegando todos os livros cadastrados no banco
    isset($_GET['id']) ? $oldLivro = getLivro($_GET['id']) : $oldLivro = null //pega só um livro pelo id

?>

<?php include "./views/layouts/html_header.php" ?>

<div class="container">
    <h1 class="text-uppercase text-center mt-3">Meus Livros</h1>
    <div class="pt-4 pb-1">
        <button class="btn btn-success btn-sm shadow-none" data-bs-toggle="modal" data-bs-target="#adicionar">
            Adicionar
        </button>
    </div>
    <table class="table table-stripped table-dark">
        <thead>
        <tr>
            <th>Nome</th>
            <th>Estante</th>
            <th>Autor</th>
            <th class="text-right"></th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($livros as $livro): ?>
        <tr>
            <td><?= $livro->getNome() ?></td>
            <td><?= $livro->getEstante() ?></td>
            <td><?= $livro->getAutor() ?></td>
            <td style="text-align: right">
                <a href="?id=<?= $livro->getId() ?>" class="btn btn-primary btn-sm shadow-none">View</a>
                <button onclick="deletarLivro('deletarLivroForm<?= $livro->getId() ?>')" class="btn btn-danger btn-sm shadow-none">Delete</button>
                <form action="controllers/livros/delete.php" method="post" class="d-none" id="deletarLivroForm<?= $livro->getId() ?>">
                    <input type="hidden" name="id" value="<?= $livro->getId() ?>">
                </form>
            </td>
        </tr>
        </tbody>
        <?php endforeach; ?>
    </table>

    <div class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false" id="adicionar" tabindex="-1" aria-labelledby="adicionarModal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="adicionarModal">Novo livro</h5>
                    <a href="/" class="btn-close shadow-none"  aria-label="Close"></a>
                </div>
                <div class="modal-body">
                    <form action="<?= is_null($oldLivro) ? 'controllers/livros/store.php' : 'controllers/livros/update.php' ?>"
                          method="post" id="formAdicionar">
                        <?php if(!is_null($oldLivro)):?>
                            <input type="hidden" name="id" value="<?= $oldLivro->getId() ?>">
                        <?php endif;?>
                        <div class="form-row">
                            <div class="col col-md-12">
                                <label for="nome" class="col-form-label required">Nome:</label>
                                <input type="text" class="form-control shadow-none" id="nome" required name="nome"
                                       value="<?= !is_null($oldLivro) ? $oldLivro->getNome() : '' ?>">
                            </div>

                            <div class="col col-md-12">
                                <label for="estante" class="col-form-label required">Estante:</label>
                                <input class="form-control shadow-none" id="estante" required name="estante"
                                       value="<?= !is_null($oldLivro) ? $oldLivro->getEstante() : '' ?>">
                            </div>

                            <div class="col col-md-12">
                                <label for="autor" class="col-form-label required">Autor:</label>
                                <input type="text" class="form-control shadow-none" id="autor" required name="autor"
                                       value="<?= !is_null($oldLivro) ? $oldLivro->getAutor() : '' ?>">
                            </div>
                        </div>
                        <div class="text-center mt-5">
                            <button type="submit" class="btn btn-primary btn-sm shadow-none">
                                Salvar
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>

<?php include "./views/layouts/html_footer.php" ?>

