<main>


    <?php

    $stmt = $pdo->prepare("SELECT * FROM movimentacoes  WHERE cooperado_ID = " . $_SESSION["cooperado_id"] . " ORDER BY movimentacoes.id ASC");
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $saldoFinal = 0;

    ?>

    <div class="container mt-4">

        <div class=" ocultar-no-pdf">

            <div class="row">
                <div class="col">Seja bem vindo, <b><?= $_SESSION["cooperado_nome"]; ?></b>. </div>
                <div class="col text-end">

                    <a href="./" class="me-4">Movimentações</a>
                    <a href="./?p=editar" class="me-4 active">Editar dados da conta</a>
                    <a href="./?p=sair">Sair da conta</a>

                </div>
            </div>
            <hr>

        </div>

        <div class="mostrar-no-pdf mb-4">
            <h2>Extrato de movimentações</h2>

            <div>
    
    <b>Data e hora de emissão: </b><?php echo date('d/m/Y \à\s H:i'); ?>
</div>

        </div>

        <div class="mostrar-no-pdf mb-4">
            <h4>Dados do cooperado</h4>

            <div>
                <b>Nome do cooperado: </b><?= $_SESSION["cooperado_nome"]; ?><br />
                <b>CPF: </b><?= $_SESSION["cooperado_cpf"]; ?>
            </div>
        </div>

        <div class="row ">
            <div class="col">
                <h4>Movimentações</h4>
            </div>
            <div class="col text-end ocultar-no-pdf">
                <a href="./?p=saque" class="btn btn-light">+ Novo saque</a>
                <a href="./?p=deposito" class="btn btn-light">+ Novo depósito</a>
                <a href="javascript:window.print()" class="btn btn-light"># Extrato</a>
            </div>
        </div>

        <?php


        echo "<table class='table'>";
        echo "
                    <th>Valor</th>
                    <th>Tipo</th>
                    <th>Data/Hora</th>
                    </tr>";

        foreach ($result as $row) {

            if ($row['Tipo'] == 1) {
                $saldoFinal = $saldoFinal - $row['Valor'];
            }

            if ($row['Tipo'] == 2) {
                $saldoFinal = $saldoFinal + $row['Valor'];
            }

            echo "<tr class='" . ($row['Tipo'] == 1 ? 'saque' : 'deposito') . "'>";
            echo "<td>" . ($row['Tipo'] == 1 ? '-' : '+') . " R$ " . $row['Valor'] . "</td>";
            echo "<td>" . ($row['Tipo'] == 1 ? 'Saque' : 'Depósito') . "</td>";
            echo "<td>" . date('d/m/Y \à\s H:i', strtotime($row['Data_e_hora'])) . "</td>";

            echo "<td> </td>";
            echo "<td>
                        
                        </td>";
            echo "</tr>";

            echo "</tr>";
        }
        echo "</table>";
        ?>

        <h6>Saldo final: R$ <?= $saldoFinal ?></h6>

    </div>


</main>