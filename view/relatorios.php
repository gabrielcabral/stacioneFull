<?php
// iniciar_sessao
session_start();
require_once 'autoload.php';

// cria o objeto de controle
$rel = new ControlRelatorio();
// verfica o o botão 'consultar' foi acionado
if (isset($_POST["gerar"])) {
    // passa o cpf e nome para consultar

    $rel->gerarRelatorio($_POST);
}
?>
<html lang="pt-br">
<head>
    <link rel="icon" href="../bootstrap/img/logo.JPG" type="image/x-icon"/>
    <link rel="shortcut icon" href="../bootstrap/img/logo.JPG" type="image/x-icon"/>
    <title>STACIONE</title>
    <!-- BOOTSTRAP STYLES-->
    <link href="../bootstrap/css/bootstrap.css" rel="stylesheet"/>
    <script src="../bootstrap/js/jquery-2.1.4.js"></script>
    <!-- FONTAWESOME STYLES-->
    <link href="../bootstrap/css/font-awesome.css" rel="stylesheet"/>
    <!-- MORRIS CHART STYLES-->
    <link href="../bootstrap/js/morris/morris-0.4.3.min.css" rel="stylesheet"/>
    <!-- CUSTOM STYLES-->
    <link href="../bootstrap/css/custom.css" rel="stylesheet"/>
    <script src="../bootstrap/js/jquery.maskedinput.js"></script>
    <script src="../bootstrap/js/bootstrap-tooltip.js"></script>
    <script src="../bootstrap/js/bootstrap-confirmation.js"></script>
    <script src="../bootstrap/js/bootstrap-datepicker.js" type="text/javascript"></script>
    <script src="../bootstrap/js/bootstrap-datepicker.pt-BR.min.js" type="text/javascript"></script>
    <script src="../bootstrap/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="../webcam.js"></script>
    <script type="text/javascript" src="../public/js/principal.js"></script>
</head>
<body>
<div id="wrapper">
    <?php
    $rel->topo();
    $rel->menu();

    ?>
    <div id="page-wrapper">
        <div id="page-inner">
            <fieldset>
                <h2>Relatório</h2>
                <?php   if($_SESSION['UsuarioNivel'] != 1){?>
                <form method="post" class="form-horizontal">
                    <!-- Text input-->
                    <div class="form-group">
                        <label class="col-md-2 control-label" for="nome">Placa</label>

                        <div class="col-md-4">
                            <input id="placa" name="placa" type="text" placeholder=""
                                   class="form-control input-md">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 control-label" for="data entrada">Data:</label>

                        <div class="col-md-4">
                            <div class="input-daterange input-group" id="datepicker">
                                <input type="text" class="input-sm form-control" name="entrada" id="entrada"/>
                                <span class="input-group-addon">até</span>
                                <input type="text" class="input-sm form-control" name="saida" id="saida"/>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 control-label" for="nome"></label>

                        <div class="col-md-4" style="text-align: right">
                            <button type="reset" class="btn btn-danger" name="consultar">Limpar</button>
                            <button type="submit" class="btn btn-primary" id="gerar" name="gerar"><span
                                    class="glyphicon glyphicon-search"></span> Gerar Relatorios
                            </button>
                        </div>
                    </div>
                </form>
            </fieldset>
            <!-- /. PAGE INNER  -->

        <?php } else {

            $_SESSION['msg'] = "O usuário ".$_SESSION['UsuarioNome']." não tem permissao! ";

            $rel->alertaError($_SESSION['msg']);
        }

        ?> </div>
        <!-- /. PAGE WRAPPER  -->
    </div>
    <!-- /. WRAPPER  -->
    <!-- SCRIPTS -AT THE BOTOM TO REDUCE THE LOAD TIME-->
    <!-- JQUERY SCRIPTS -->
    <script src="../bootstrap/js/jquery-2.1.4.js"></script>
    <!-- BOOTSTRAP SCRIPTS -->
    <script src="../bootstrap/js/bootstrap.min.js"></script>
    <!-- METISMENU SCRIPTS -->
    <script src="../bootstrap/js/jquery.metisMenu.js"></script>
    <!-- CUSTOM SCRIPTS -->
    <script src="../bootstrap/js/custom.js"></script>
</body>
</html>

