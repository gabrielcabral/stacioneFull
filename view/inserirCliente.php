<?php
#iniciar_sessao
session_start();

#função para resolver problema de header
ob_start();

#define codificação
header('Content-Type: text/html; charset=UTF-8');

#carrega as classes automaticamente
include_once 'autoload.php';

#cria o objeto de controle
$cc = new ControlCliente();


#verfica o o botão 'consultar' foi acionado
if (isset($_POST["inserir"])) {
    #passa os dados para inserir
    $cc->inserir($_POST["nome"], $_POST["cpf"], $_POST["dtNascimento"], $_POST["telefone"]);
}
?>

<html lang="pt-br">
    <head>
        <!-- define a codificação do HTML -->
        <meta charset="utf-8">

        <!-- define a o titulo do HMTL -->
        <title>STACIONE</title>

        <!-- Link para o CSS do bootstrap -->
        <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet">

        <!-- Link para o CSS do bootstrap (menu) -->
        <link href="../bootstrap/css/navbar.css" rel="stylesheet">

    </head>
    <body>

        <!-- Link para o JQuery do bootstrap -->
        <script src="../bootstrap/js/jquery.min.js"></script>
        <script src="../bootstrap/js/bootstrap.min.js"></script>
        <script src="../bootstrap/js/ie10-viewport-bug-workaround.js"></script>

        <div class="container">
            <!-- inserir o menu -->
            <?php
            #mostrar o menu
            $cc->menu();
            #$cc->alerta($_SESSION['msg']);
            ?> 

            <!-- Main component for a primary marketing message or call to action -->
            <div class="jumbotron">
                <fieldset>
                    <legend>Dados do Cliente</legend>
                    <form method="post">
                        <div class="form-group">
                            <label for="nome">Nome</label>
                            <input class="form-control" required type="text" name="nome" id="nome" />
                            <label for="cpf">CPF</label>
                            <input class="form-control" required id="cpf" name="cpf" type="text" title="Qual seu CPF?" maxlength="14" title="Digite o CPF somente numeros">
                            <label for="dtNascimento">Data Nascimento</label>
                            <input class="form-control" required id="dtNascimento" name="dtNascimento" type="date" title="Qual sua Data de Nascimento?" maxlength="14">
                            <label for="telefone">Telefone</label>
                            <input class="form-control" id="telefone" name="telefone" type="text" title="Qual seu telefone?" maxlength="14">
                            </br>
                            <button type="submit" name="inserir" class="btn btn-primary" style="width: 100%;"><span class="glyphicon bg-success"></span>Inserir</button>
                        </div>
                    </form>
                </fieldset> 
            </div>
    </body>
</html>
