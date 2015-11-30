<?php
// iniciar_sessao
//session_start();

// função para resolver problema de header
ob_start();

// define codificação
header('Content-Type: text/html; charset=UTF-8');

// carrega as classes automaticamente
require_once 'autoload.php';

// cria o objeto de controle
$cc = new ControlVeiculo();



?>
<html lang="pt-br">
<head>
    <link rel="icon" href="../bootstrap/img/logo.JPG" type="image/x-icon"/>
    <link rel="shortcut icon" href="../bootstrap/img/logo.JPG" type="image/x-icon"/>
    <title>STACIONE</title>
    <!-- BOOTSTRAP STYLES-->
    <script src="../bootstrap/js/jquery-2.1.4.js"></script>
    <link href="../bootstrap/css/bootstrap.css" rel="stylesheet"/>
    <!-- FONTAWESOME STYLES-->
    <link href="../bootstrap/css/font-awesome.css" rel="stylesheet"/>
    <!-- MORRIS CHART STYLES-->
    <link href="../bootstrap/js/morris/morris-0.4.3.min.css" rel="stylesheet"/>
    <!-- CUSTOM STYLES-->
    <link href="../bootstrap/css/custom.css" rel="stylesheet"/>
    <script src="../bootstrap/js/jquery.maskedinput.js"></script>
    <script src="../bootstrap/js/bootstrap-tooltip.js"></script>
    <script src="../bootstrap/js/jquery.validate.js"></script>
    <script src="../bootstrap/js/prettify.js"></script>
    <script src="../bootstrap/js/jquery.bsAlerts.js"></script>
    <script src="../bootstrap/js/bootstrap-confirmation.js"></script>
    <script src="../bootstrap/js/bootstrap-datepicker.js" type="text/javascript"></script>
    <script src="../bootstrap/js/bootstrap-datepicker.pt-BR.min.js" type="text/javascript"></script>
    <script src="../public/js/Veiculo.js"></script>
    <script src="../bootstrap/js/bootstrap.min.js"></script>
    <script type="text/javascript">
        jQuery.noConflict();
        jQuery(function ($) {
            $('#dtNascimento').datepicker({
                format: "dd/mm/yyyy",
                language: "pt-BR"

            });
        });
    </script>
</head>
<body>
<div id="wrapper">
    <?php
    $cc->topo();
    $cc->menu();
    ?>
    <div id="page-wrapper">
        <div id="page-inner">
            <div data-alerts="alerts" data-fade="3000"></div>
            <form class="form-horizontal" id="formVeiculos" method="post">
                <fieldset>
                    <!-- Form Name -->
                    <legend><h2>Cadastro Veiculo</h2></legend>
                    <?php
                    if ($_SESSION['tipoMsg'] == 0) {
                        $cc->alertaError($_SESSION['msg']);
                    } elseif ($_SESSION['tipoMsg'] == 1) {
                        $cc->alertaInfo($_SESSION['msg']);
                    } elseif ($_SESSION['tipoMsg'] == 2) {
                        $cc->alertaSuccess($_SESSION['msg']);
                    }
                     if($_SESSION['UsuarioNivel'] != 1){
                    ?>
                    <!-- Select tipo de veiculo -->
                        <div class="form-group">
                            <label class="col-md-2 control-label" for="veiculo">Tipo de Veiculo:</label>
                            <div class="col-md-4">
                                <select id="tpveiculo" name="tpveiculo" class="form-control">
                                    <option value="0">Selecione</option>
                                    <option value="carro">Carro</option>
                                    <option value="caminhao">Caminhão</option>
                                    <option value="moto">Moto</option>
                                </select>
                            </div>
                        </div>
                        <!-- Select fabricante -->
                        <div class="form-group">
                            <label class="col-md-2 control-label" for="nome">Fabricante:</label>
                            <div class="col-md-4">
                                <select id="nome_fabricante" name="nome_fabricante"  class="form-control input-md"></select>
                            </div>
                        </div>
                        <!-- Select modelo do veiculo -->
                        <div class="form-group">
                            <label class="col-md-2 control-label" for="nome">Modelo:</label>
                            <div class="col-md-4">
                                <input id="modelo" name="modelo" class="form-control input-md" />
                            </div>
                        </div>
                        <!-- botões -->
                    <div class="form-group">
                        <div class="col-md-7" style="text-align: right">
                            <button class="btn btn-danger" type="reset">Limpar</button>
                            <button id="salvar" name="salvar" type="submit"  class="btn btn-primary"><span
                                    class="glyphicon glyphicon-ok"></span> Salvar
                            </button>
                        </div>
                    </div>
                </fieldset>
            </form>
            <!-- /. PAGE INNER  -->
            <?php } else {

                $_SESSION['msg'] = "O usuário ".$_SESSION['UsuarioNome']." não tem permissao! ";

                $cc->alertaError($_SESSION['msg']);
            }

            ?>
        </div>
        <!-- /. PAGE WRAPPER  -->
    </div>
    <!-- SCRIPTS -AT THE BOTOM TO REDUCE THE LOAD TIME-->
    <!-- JQUERY SCRIPTS -->
    <script src="../bootstrap/js/jquery-1.10.2.js"></script>
    <!-- BOOTSTRAP SCRIPTS -->
    <script src="../bootstrap/js/bootstrap.min.js"></script>
    <!-- METISMENU SCRIPTS -->
    <script src="../bootstrap/js/jquery.metisMenu.js"></script>
<?php    // verfica o o botão 'consultar' foi acionado
    if (isset($_POST["salvar"])) {
    // passa os dados para inserir
    ///   var_dump($_POST);
    $cc->inserir($_POST);
    }
?>