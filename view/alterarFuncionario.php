<?php
// iniciar_sessao
session_start();

// função para resolver problema de header
ob_start();

// define codificação
header('Content-Type: text/html; charset=UTF-8');

// carrega as classes automaticamente
require_once 'autoload.php';

// cria o objeto de controle
$cc = new ControlFuncionario();
$_GET['id_funcionario'] = $_GET['id'];
$funcionarios = $cc->consultar($_GET);
// verfica o o botão 'consultar' foi acionado
if (isset($_POST["alterar"])) {
    // passa os dados para inserir

    $cc->alterar($_POST);
}
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
    <script src="../public/js/funcionario.js"></script>
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
    <head>
<body>
<div id="wrapper">
    <?php
    $cc->topo();
    $cc->menu();
    ?>
    <div id="page-wrapper">
        <div id="page-inner">
            <div class="alert alert-success" id="success" role="alert" style="display: none"></div>
            <div class="alert alert-info" id="info" role="alert" style="display: none"></div>
            <div class="alert alert-warning" id="warning" role="alert" style="display: none"></div>
            <div class="alert alert-danger" id="danger" role="alert" style="display: none"></div>
            <form class="form-horizontal" id="formFuncAlt" method="post">
                <fieldset>
                    <!-- Form Name -->
                    <legend><h2>Altera Funcionário</h2></legend>
                    <!-- Text input-->
                    <div class="form-group">
                        <label class="col-md-2 control-label" for="nome" style="text-align: left">Nome:</label>

                        <div class="col-md-5">
                            <input id="nm_funcionario" name="nm_funcionario"
                                   value="<?= $funcionarios[0]['NM_FUNCIONARIO'] ?>" maxlength="200" type="text"
                                   placeholder="Nome" class="form-control input-md" required="">
                        </div>
                    </div>
                    <!-- Text input-->
                    <div class="form-group">
                        <label class="col-md-2 control-label" for="cpf" style="text-align: left">CPF:</label>

                        <div class="col-md-5">
                            <input id="cpf_funcionario" name="cpf_funcionario" type="text"
                                   value="<?=$funcionarios[0]['CPF_FUNCIONARIO']?>"
                                   placeholder="CPF" class="form-control input-md mascaraCpf " required="">
                            <span class="help-block" id="cpfValidado">CPF Inválido!</span>
                        </div>
                    </div>
                    <!-- Text input-->
                    <div class="form-group">
                        <label class="col-md-2 control-label" for="rg" style="text-align: left">RG:</label>

                        <div class="col-md-5">
                            <input id="rg_funcionario" name="rg_funcionario" type="text"
                                   value="<?= $funcionarios[0]['RG_FUNCIONARIO'] ?>" maxlength="45" placeholder="RG"
                                   class="form-control input-md" required="">
                        </div>
                    </div>
                    <!-- Text input-->
                    <div class="form-group">
                        <label class="col-md-2 control-label" for="dtNascimento" style="text-align: left">Data de
                            Nascimento:</label>

                        <div class="col-md-5">
                            <div class="input-group date">
                                <input type="text" class="form-control" id="dtNascimento"
                                       value="<?= $cc->dataBrasileiro($funcionarios[0]['DT_NASCIMENTO']) ?>"
                                       name="dtNascimento"><span class="input-group-addon"><i
                                        class="glyphicon glyphicon-th"></i></span>
                            </div>
                        </div>
                    </div>
                    <!-- Text input-->
                    <div class="form-group">
                        <label class="col-md-2 control-label" for="telefone" style="text-align: left">Telefone:</label>

                        <div class="col-md-5">
                            <input id="telefone" name="telefone" type="text" value="<?= $funcionarios[0]['TELEFONE'] ?>"
                                   placeholder="Telefone" class="form-control input-md telefone" required="">
                        </div>
                    </div>
                    <!-- Select Basic -->
                    <div class="form-group">
                        <label class="col-md-2 control-label" for="perfil" style="text-align: left">Perfil</label>

                        <div class="col-md-5">
                            <select id="perfil" name="perfil" class="form-control">
                                <option value="">Selecione...</option>
                                <option value="1" <?php echo($funcionarios[0]['ID_PERFIL'] == 1 ? "selected" : ""); ?> >
                                    Atendente
                                </option>
                                <option value="2" <?php echo($funcionarios[0]['ID_PERFIL'] == 2 ? "selected" : ""); ?>>
                                    Gerente
                                </option>
                            </select>
                        </div>
                    </div>
                    <input id="id_funcionario" name="id_funcionario" value="<?= $funcionarios[0]['ID_FUNCIONARIO'] ?>" type="hidden" />
                    <!-- Button -->
                    <div class="form-group">
                        <div class="col-md-7" style="text-align: right">
                            <button id="alterar" name="alterar" class="btn btn-warning"><span
                                    class="glyphicon glyphicon-pencil"></span> Alterar
                            </button>
                        </div>
                    </div>
                </fieldset>
            </form>
            <!-- /. PAGE INNER  -->
        </div>
        <!-- /. PAGE WRAPPER  -->
    </div>
    <!-- JQUERY SCRIPTS -->
    <script src="../bootstrap/js/jquery-2.1.4.js"></script>
    <!-- BOOTSTRAP SCRIPTS -->
    <script src="../bootstrap/js/bootstrap.min.js"></script>
    <!-- METISMENU SCRIPTS -->
    <script src="../bootstrap/js/jquery.metisMenu.js"></script>
    <!-- CUSTOM SCRIPTS -->
    <script src="../bootstrap/js/custom.js"></script>