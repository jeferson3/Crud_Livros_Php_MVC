<!doctype html>
<html lang="pt-br">

<head>
    <title>CRUD</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
    <div class="container pt-3">

        <form id="submit" method="POST" action="adicionar.php">
            <div class="row justify-content-center">
                <div class="col-sm-8">
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
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-sm-4">
                    <div class="form-group">
                        <input type="text" name="nome" class='form-control'>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <input type="text" name="sobrenome" class='form-control'>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-sm-8">
                    <div class="form-group">
                        <input type="email" name="email" class='form-control'>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-sm-8">
                    <div class="form-group">
                        <textarea name="txt" cols="30" rows="5" class='form-control'></textarea>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="form-group">
                    <input type="submit" id='save' name='adicionar' class="btn btn-success" value="salvar">
                </div>
            </div>
        </form>

        <div class="row justify-content-center">
            <table class="table table-stripped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nome</th>
                        <th>Sobrenome</th>
                        <th>Email</th>
                        <th>Descrição</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    require_once('conexao.php');
                    $crud = new Crud("localhost", "crud", "root", "");
                    $con = $crud->conexao();
                    $dados = $crud->pegarDados($con);
                    if ($dados) {
                        foreach ($dados->fetchAll() as $key => $i) {
                            echo "<a href='#'>";
                            echo "<tr>";
                            echo "<td>$key</td>";
                            echo "<td>$i[1]</td>";
                            echo "<td>$i[2]</td>";
                            echo "<td>$i[3]</td>";
                            echo "<td>$i[4]</td>";
                            echo "<td>";
                            echo "<a href='delete.php?id=$i[0]'>&times;</a>";
                            echo "</td>";
                            echo "</tr>";
                            echo "</a>";
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>
    <script>
        var alertBox = document.getElementById('alertBox');
        if (alertBox) {

            var i = 1.0;

            function temp() {
                document.getElementById('alertBox').style.opacity = i;
                i -= 0.2;
                console.log('ou');
                console.log(i);
                if (i <= 0) {
                    clearInterval(interval);
                    document.getElementById('alertBox').style.display = 'none';

                }
            }
            var interval = setInterval(temp, 300);

        }


        // $('#alertBox').delay(2000);
    </script>
</body>

</html>