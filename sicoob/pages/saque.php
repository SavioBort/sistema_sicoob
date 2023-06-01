<main>


    <?php

    if (@$_POST["valor"]) {

        $stmt = $pdo->prepare("SELECT * FROM movimentacoes  WHERE cooperado_ID = " . $_SESSION["cooperado_id"] . " ORDER BY movimentacoes.id ASC");
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $saldoFinal = 0;

        foreach ($result as $row) {

            if ($row['Tipo'] == 1) {
                $saldoFinal = $saldoFinal - $row['Valor'];
            }

            if ($row['Tipo'] == 2) {
                $saldoFinal = $saldoFinal + $row['Valor'];
            }
        }

        if($_POST["valor"] > $saldoFinal) {

            $erroLimite = true;

        } else {

            $stmt = $pdo->prepare("INSERT INTO movimentacoes (Valor, Tipo, Cooperado_ID) VALUES ('" . $_POST["valor"] . "', '1', '" . $_SESSION["cooperado_id"] . "')");

            if ($stmt->execute()) {
                header('Location: ./');
                exit;
            } else {
                $erro = true;
            }

        }


    }

    ?>

    <div class="container mt-4">

        <div class=" ocultar-no-pdf">

            <div class="row">
                <div class="col fw-bold">Realizar saque</div>
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

                <label for="nome" class="mb-2">Valor a sacar</label>
                <input value="<?= @$_POST["valor"] ?>" required type="number" step="0.01" class="form-control" id="valor" name="valor">

                <?php if (@$erro) { ?>
                    <div class="alert alert-danger mt-4 mb-0" role="alert">
                        Não foi possível atender a sua solicitação. Tente novamente.
                    </div>
                <?php } ?>

                <?php if (@$erroLimite) { ?>
                    <div class="alert alert-danger mt-4 mb-0" role="alert">
                        O valor informado excede o seu saldo atual. (R$ <?= $saldoFinal ?>)
                    </div>
                <?php } ?>

                <button type="submit" class="btn btn-success submit-button mt-4" style="background-color: #1b9a8d"><b style="color: white;">Realizar saque</b></button>
                <a href="./" class="btn btn-white mt-4">Cancelar saque</a>


            </form>
        </div>


    </div>


</main>