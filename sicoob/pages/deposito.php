<main>


    <?php

    if (@$_POST["valor"]) {


        $stmt = $pdo->prepare("INSERT INTO movimentacoes (Valor, Tipo, Cooperado_ID) VALUES ('" . $_POST["valor"] . "', '2', '" . $_SESSION["cooperado_id"] . "')");

        if ($stmt->execute()) {
            header('Location: ./');
            exit;
        } else {
            $erro = true;
        }
    }

    ?>

    <div class="container mt-4">

        <div class=" ocultar-no-pdf">

            <div class="row">
            <div class="col fw-bold">Realizar depósito</div>
                <div class="col text-end">
                    <a href="./" class="me-4">Movimentações</a>
                    <a href="./?p=editar" class="me-4 active">Editar dados da conta</a>
                    <a href="./?p=sair">Sair da conta</a>
                </div>
            </div>
            <hr>

        </div>


        <div class="mostrar-no-pdf mb-4">

            <form method="POST">

                <label for="nome" class="mb-2">Valor a depositar</label>
                <input value="0,00" required type="number" step="0.01" class="form-control" id="valor" name="valor">

                <?php if (@$erro) { ?>
                    <div class="alert alert-danger mt-4 mb-0" role="alert">
                        Não foi possível atender a sua solicitação. Tente novamente.
                    </div>
                <?php } ?>

                <button type="submit" class="btn btn-success submit-button mt-4" style="background-color: #1b9a8d"><b style="color: white;">Realizar depósito</b></button>
                <a href="./" class="btn btn-white mt-4">Cancelar depósito</a>


            </form>
        </div>


    </div>


</main>