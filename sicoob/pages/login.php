<?php

if (@$_POST["login"]) {

    $stmt = $pdo->prepare("SELECT * FROM cooperados WHERE CPF = '" . $_POST["cpf"] . "'");
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($result) {
        $_SESSION["auth"] = true;
        $_SESSION["cooperado_id"] = $result["ID"];
        $_SESSION["cooperado_nome"] = $result["Nome"];
        $_SESSION["cooperado_cpf"] = $result["CPF"];
        header('Refresh:0');
        exit;
    } else {
        $_SESSION["auth"] = false;
        $_SESSION["cooperado_id"] = 0;
        $_SESSION["cooperado_id"] = '';
        $_SESSION["cooperado_nome"] = '';
        $_SESSION["cooperado_cpf"] = '';
    }
}

if (@$_POST["register"]) {

    $cpfExiste = false;
    $nomeExiste = false;

    $stmt = $pdo->prepare("SELECT * FROM cooperados WHERE CPF = '" . $_POST["cpf"] . "'");
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($result) {
        $cpfExiste = true;
    }

    $stmt = $pdo->prepare("SELECT * FROM cooperados WHERE nome = '" . $_POST["nome"] . "'");
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($result) {
        $nomeExiste = true;
    }

    if (!$cpfExiste && !$nomeExiste) {
        $stmt = $pdo->prepare("INSERT INTO cooperados (nome, CPF) VALUES ('" . $_POST["nome"] . "', '" . $_POST["cpf"] . "')");

        if ($stmt->execute()) {
            $contaCriada = true;
            header('Location: ./?registered');
            exit;
        } else {
            $contaCriada = false;
        }
    }
}

?>

<main class="d-flex justify-content-center align-items-center vh-100">


    <?php if (isset($_GET["register"])) { ?>

        <form method="POST">

            <div class="card">

                <div class="card-header bg-white fs-5">Criar conta</div>

                <div class="card-body" style="width: 25rem">

                    <input type="hidden" name="register" id="register" value="1">

                    <label for="nome" class="mb-2">Nome completo</label>
                    <input value="<?= @$_POST["nome"] ?>" required type="text" class="form-control mb-3" id="nome" name="nome">


                    <label for="cpf" class="mb-2">CPF (apenas números)</label>
                    <input class="form-control" id="cpf" name="cpf" value="<?= @$_POST["cpf"] ?>" required type="text" pattern="[0-9]{11}" title="Por favor, insira um CPF válido de 11 dígitos" required oninput="this.setCustomValidity('')" oninvalid="this.setCustomValidity('Por favor, insira um CPF válido e informe apenas os números. Ex: 12345678900.')">

                    <?php if (@$cpfExiste && @!$nomeExiste) { ?>
                        <div class="alert alert-danger mt-4" role="alert">
                            Oops! Parece que já existe uma conta cadastrada com o CPF informado.
                        </div>
                    <?php } ?>

                    <?php if (@$cpfExiste && @$nomeExiste) { ?>
                        <div class="alert alert-danger mt-4" role="alert">
                            Oops! Parece que já existe uma conta cadastrada com o CPF e nome informados.
                        </div>
                    <?php } ?>

                    <?php if (@!$cpfExiste && @$nomeExiste) { ?>
                        <div class="alert alert-danger mt-4" role="alert">
                            Oops! Parece que já existe uma conta cadastrada com o nome informado.
                        </div>
                    <?php } ?>

                    <button type="submit" class="btn btn-success submit-button btn-" style="background-color: #1b9a8d"><b style="color: white;">Entrar</b></button>


                    <div class="text-center mt-3">
                        <a href="./">Já tem uma conta? Acesse agora</a>
                    </div>

                </div>
            </div>
        </form>

    <?php } else { ?>

        <form method="POST">
            <div class="card">

                <div class="card-header bg-white fs-5">Acessar conta</div>


                <div class="card-body" style="width: 25rem">

                    <input type="hidden" name="login" id="login" value="1">


                    <label for="cpf" class="mb-2">Informe o seu CPF</label>
                    <input class="form-control" id="cpf" name="cpf" value="<?= @$_POST["cpf"] ?>" required type="text" pattern="[0-9]{11}" title="Por favor, insira um CPF válido de 11 dígitos" required oninput="this.setCustomValidity('')" oninvalid="this.setCustomValidity('Por favor, insira um CPF válido e informe apenas os números. Ex: 12345678900.')">

                    <?php if (isset($_GET["registered"])) { ?>
                        <div class="alert alert-success mt-4" role="alert">
                            Conta criada com sucesso! Informe suas credenciais para começar a fazer suas movimentações.
                        </div>
                    <?php } ?>

                    <button type="submit" class="btn btn-success submit-button" style="background-color: #1b9a8d"><b style="color: white;">Entrar</b></button>


                    <div class="text-center mt-3">
                        <a href="./?register">Novo por aqui? Crie sua conta</a>
                    </div>

                </div>
            </div>
        </form>

    <?php } ?>

</main>