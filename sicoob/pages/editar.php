<main>


    <?php

    if (@$_POST["update"]) {


        $cpfExiste = false;
        $nomeExiste = false;

        $stmt = $pdo->prepare("SELECT * FROM cooperados WHERE CPF = '" . $_POST["cpf"] . "' AND ID <> '" . $_SESSION["cooperado_id"] . "'");
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            $cpfExiste = true;
        }

        $stmt = $pdo->prepare("SELECT * FROM cooperados WHERE nome = '" . $_POST["nome"] . "' AND ID <> '" . $_SESSION["cooperado_id"] . "'");
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            $nomeExiste = true;
        }

        if (!$cpfExiste && !$nomeExiste) {

            $stmt = $pdo->prepare("UPDATE cooperados SET Nome = '" . $_POST["nome"] . "', CPF = '" . $_POST["cpf"] . "' WHERE ID = '" . $_SESSION["cooperado_id"] . "'");

            if ($stmt->execute()) {
                $_SESSION["cooperado_nome"] = $_POST["nome"];
                $_SESSION["cooperado_cpf"] = $_POST["cpf"];
                $contaAtualizada = true;
            } else {
                $contaAtualizada = false;
            }
        }
    }

    ?>

    <div class="container mt-4">

        <div class=" ocultar-no-pdf">

            <div class="row">
                <div class="col fw-bold">Editar dados da conta</div>
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

                <input type="hidden" name="update" id="update" value="1">

                <label for="nome" class="mb-2">Nome completo</label>
                <input value="<?= @$_SESSION["cooperado_nome"] ?>" required type="text" class="form-control mb-3" id="nome" name="nome">

                <label for="cpf" class="mb-2">CPF (apenas números)</label>
                <input class="form-control" id="cpf" name="cpf" value="<?= @$_SESSION["cooperado_cpf"] ?>" required type="text" pattern="[0-9]{11}" title="Por favor, insira um CPF válido de 11 dígitos" required oninput="this.setCustomValidity('')" oninvalid="this.setCustomValidity('Por favor, insira um CPF válido e informe apenas os números. Ex: 12345678900.')">


                <?php if (@$contaAtualizada) { ?>
                    <div class="alert alert-success mt-4 mb-0" role="alert">
                        Dados atualizados com sucesso.
                    </div>
                <?php } ?>

                <?php if (@$cpfExiste && @!$nomeExiste) { ?>
                    <div class="alert alert-danger mt-4 mb-0" role="alert">
                        Falha ao atualizar dados! Já existe uma outra conta cadastrada com o CPF informado.
                    </div>
                <?php } ?>

                <?php if (@$cpfExiste && @$nomeExiste) { ?>
                    <div class="alert alert-danger mt-4 mb-0" role="alert">
                        Falha ao atualizar dados! Já existe uma outra conta cadastrada com o CPF e nome informados.
                    </div>
                <?php } ?>

                <?php if (@!$cpfExiste && @$nomeExiste) { ?>
                    <div class="alert alert-danger mt-4 mb-0" role="alert">
                        Falha ao atualizar dados! Já existe uma outra conta cadastrada com o nome informado.
                    </div>
                <?php } ?>


                <div class="row">
                    <div class="col">
                        <button type="submit" class="btn btn-success submit-button mt-4" style="background-color: #1b9a8d"><b style="color: white;">Atualizar informações</b></button>
                    </div>
                    <div class="col text-end">
                        <a href="./?p=excluir" class="btn mt-4 text-danger">Excluir conta permanentemente</a>
                    </div>
                </div>



            </form>
        </div>


    </div>


</main>