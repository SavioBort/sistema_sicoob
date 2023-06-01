<?php include('_config.php');


if (@$_SESSION["auth"] == true) {

    /**
     * Deslogar
     */

    if (@$_GET["p"] == 'sair') {
        $_SESSION["auth"] = false;
        $_SESSION["coperado_id"] = 0;
        header('Location: ./');
        exit;
    }

    /**
     * Excluir conta
     */

    if (@$_GET["p"] == 'excluir') {
        $pagina = 'excluir';

    }


    /** 
     * Página inicial
     * */

    if (@$_GET["p"] == 'movimentacoes' || !isset($_GET["p"])) {

        $pagina = 'movimentacoes';
    }

    
    /** 
     * Saque
     * */

     if (@$_GET["p"] == 'saque') {

        $pagina = 'saque';
    }

  
    /** 
     * Deposito
     * */

     if (@$_GET["p"] == 'deposito') {

        $pagina = 'deposito';
    }


    /**
     * Editar dados da conta do cooperado
     * */

    if (@$_GET["p"] == 'editar') {

        $idCoperado = $_SESSION["cooperado_id"];

        $pagina = 'editar';
    }
} else {

    $pagina = 'login';
}


include("template-parts/header.php");

include("pages/$pagina.php");

include("template-parts/footer.php");
