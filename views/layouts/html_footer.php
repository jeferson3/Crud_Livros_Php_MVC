
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<?php if (isset($_GET['id'])) echo "<script> new bootstrap.Modal(document.getElementById('adicionar')).toggle()</script>"?>
<script>

    const deletarLivro = function (id) {
        let op = confirm('Deletar livro?')
        if (op){
            document.getElementById(id).submit();
        }
    }
</script>
</body>
</html>
