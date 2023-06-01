<main>


    <?php

    if (isset($_GET["confirmar"])) {

        $stmt = $pdo->prepare("DELETE FROM movimentacoes WHERE Cooperado_ID = '" . $_SESSION["cooperado_id"] . "'");
        $stmt->execute();

        $stmt = $pdo->prepare("DELETE FROM cooperados WHERE ID = '" . $_SESSION["cooperado_id"] . "'");
        $stmt->execute();

        header('Location: ./?p=sair');

        exit;
    }

    ?>

    <div class="container mt-4">

        <div>

            <div class="row">
                <div class="col fw-bold">Excluir conta permanentemente</div>
                <div class="col text-end">
                    <a href="./" class="me-4">Movimentações</a>
                    <a href="./?p=editar" class="me-4 active">Editar dados da conta</a>
                    <a href="./?p=sair">Sair da conta</a>
                </div>
            </div>
            <hr>

        </div>


        <div>


            <b>Tem certeza disso?</b>
            <div>Ao excluir sua conta você perderá todas as suas movimentações e não será mais possível recuperá-las. Deseja confirmar a exclusão?</div>

        </div>

        <a href="./?p=excluir&confirmar" class="btn btn-danger submit-button mt-4"><b style="color: white;">Sim, excluir conta permanentemente</b></a>
        <a href="./?p=editar" class="btn btn-white mt-4">Cancelar exclusão</a>




    </div>


</main>