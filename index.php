<!doctype html>
<html lang="pt-br">

<head>
    <title>CRUD</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.1/css/all.min.css">
</head>

<body>
<div class="container pt-3">
    <?php
    session_start();
    if (isset($_SESSION['message'])) {
        $message = $_SESSION['message'];
        $messageType = $_SESSION['messageType'];

        echo "<div id='alertBox' class='alert alert-$messageType alert-dismissible fade show' role='alert'>
                            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                                <span aria-hidden='true'>&times;</span>
                            </button>
                            <strong></strong> 
                            $message
                            </div>";
        unset($_SESSION['message']);
        unset($_SESSION['messageType']);
    }
    ?>

    <div class="row justify-content-center">

        <div class="col-md-8">
            <div class="form-group text-right">
                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#new">
                    <i class="fas fa-plus-circle"></i>
                    Novo produto
                </button>
            </div>
            <table class="table table-responsive table-striped">
                <thead>
                <tr>
                    <th>#</th>
                    <th width=300>Nome</th>
                    <th width=300>Preço</th>
                    <th width=300>Descrição</th>
                    <th width=300>Ações</th>
                </tr>
                </thead>
                <tbody>
                <?php
                require($_SERVER["DOCUMENT_ROOT"] . "/Dao/ProdutoDao.php");
                $dados = ProdutoDao::pegarDados();
                ?>
                <?php if ($dados): ?>
                    <?php foreach ($dados->fetchAll(PDO::FETCH_OBJ) as $produto): ?>

                        <tr>
                            <td><?= $produto->id; ?></td>
                            <td><?= $produto->name; ?></td>
                            <td><?= trim(substr($produto->description, 0, 50)) ?>...</td>
                            <td>R$<?= number_format($produto->price, 2, ",", "."); ?></td>
                            <td>
                                <form class="d-none" id="produto<?= $produto->id ?>" action="controller/delete.php" method="post">
                                    <input type="hidden" name="deletar">
                                    <input type="hidden" name="id" value="<?= $produto->id ?>">
                                    <button type="submit">
                                        <i class='fas fa-trash-alt fas-2x text-danger'></i>
                                    </button>
                                </form>
                                <button class="btn btn-sm btn-danger" type="button" onclick="deletar('produto<?= $produto->id ?>')">Deletar</button>
                                <button class="btn btn-sm btn-primary" type="button">Visualizar</button>
                            </td>
                        </tr>

                    <?php endforeach; ?>
                <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
</div>


<!-- Modal editar -->
<div class="modal fade" id="update" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Atualizar</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form method='POST' action='controller/update.php'>
                    <input type="hidden" name="id" id="idModal">
                    <div class='row justify-content-center'>
                        <div class='col-sm-4'>
                            <div class='form-group'>
                                <input type='text' name='nome' id="nomeModal" class='form-control'>
                            </div>
                        </div>
                        <div class='col-sm-4'>
                            <div class='form-group'>
                                <input type='text' name='sobrenome' id="sobrenomeModal" class='form-control'>
                            </div>
                        </div>
                    </div>
                    <div class='row justify-content-center'>
                        <div class='col-sm-8'>
                            <div class='form-group'>
                                <input type='email' name='email' id="emailModal" class='form-control'>
                            </div>
                        </div>
                    </div>
                    <div class='row justify-content-center'>
                        <div class='col-sm-8'>
                            <div class='form-group'>
                                <textarea name='txt' cols='30' id="descricaoModal" rows='5'
                                          class='form-control'></textarea>
                            </div>
                        </div>
                    </div>
                    <div class='row justify-content-center'>
                        <div class='form-group'>
                            <input type='submit' id='save' name='atualizar' class='btn btn-success' value='salvar'>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>

<!-- Modal criar novo -->
<div class="modal fade" id="new" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Novo produto</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="submit" method="POST" action="controller/adicionar.php">

                    <div class="row justify-content-center">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <input type="text" name="name" placeholder="Nome" required class='form-control'>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <input type="text" name="price" id="price" required class='form-control'>
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-sm-8">
                            <div class="form-group">
                    <textarea name="description" cols="30" rows="5" required class='form-control'
                              placeholder="Descrição"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="form-group text-center">
                        <input type="submit" id='save' name='adicionar' class="btn btn-success" value="salvar">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
</script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
</script>
<script src="https://cdn.rawgit.com/plentz/jquery-maskmoney/master/dist/jquery.maskMoney.min.js"></script>
<script>
    var alertBox = document.getElementById('alertBox');
    if (alertBox) {

        var i = 1.0;

        function temp() {
            document.getElementById('alertBox').style.opacity = i;
            i -= 0.2;
            if (i <= 0) {
                clearInterval(interval);
                document.getElementById('alertBox').style.display = 'none';
            }
        }

        var interval = setInterval(temp, 300);

    }

    function modalEdit(id, nome, snome, email, desc) {

        document.getElementById('idModal').value = id;
        document.getElementById('nomeModal').value = nome;
        document.getElementById('sobrenomeModal').value = snome;
        document.getElementById('emailModal').value = email;
        document.getElementById('descricaoModal').value = desc;

    }
</script>

<script>
    function deletar(id){
        let op = confirm("Deletar produto?");

        if (op)
        {
            document.getElementById(id).submit();
        }
    }
</script>

<script>
    $(document).ready(function () {
        $('#price').maskMoney({decimal: ",", thousands: "."});
    })
</script>

</body>

</html>