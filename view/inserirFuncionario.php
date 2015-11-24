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
$cc = new ControlFuncionario();



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
            <form class="form-horizontal" id="formFunc" method="post">
                <fieldset>
                    <!-- Form Name -->
                    <legend><h2>Cadastro Funcionário</h2></legend>
                    <?php
                    if ($_SESSION['tipoMsg'] == 0) {
                        $cc->alertaError($_SESSION['msg']);
                    } elseif ($_SESSION['tipoMsg'] == 1) {
                        $cc->alertaInfo($_SESSION['msg']);
                    } elseif ($_SESSION['tipoMsg'] == 2) {
                        $cc->alertaSuccess($_SESSION['msg']);
                    }
                    ?>
                    <!-- Text input-->
                    <div class="form-group">
                        <label class="col-md-2 control-label" for="nome" style="text-align: left">Nome:</label>

                        <div class="col-md-5">
                            <input id="nm_funcionario" name="nm_funcionario" maxlength="200" type="text"
                                   placeholder="Nome" class="form-control input-md" required="required">
                        </div>
                    </div>
                    <!-- Text input-->
                    <div class="form-group">
                        <label class="col-md-2 control-label" for="cpf" style="text-align: left">CPF:</label>

                        <div class="col-md-5">
                            <input id="cpf_funcionario" name="cpf_funcionario" type="text" placeholder="CPF"
                                   class="form-control input-md mascaraCpf" required="required">
                            <span class="help-block" id="cpfValidado">CPF Inválido!</span>
                        </div>
                    </div>
                    <!-- Text input-->
                    <div class="form-group">
                        <label class="col-md-2 control-label" for="rg" style="text-align: left">RG:</label>

                        <div class="col-md-5">
                            <input id="rg_funcionario" name="rg_funcionario" type="text" maxlength="45" placeholder="RG"
                                   class="form-control input-md" required="required">
                        </div>
                    </div>
                    <!-- Text input-->
                    <div class="form-group">
                        <label class="col-md-2 control-label" for="dtNascimento" style="text-align: left">Data de
                            Nascimento:</label>

                        <div class="col-md-5">
                            <div class="input-group date">
                                <input type="text" class="form-control" id="dtNascimento"  name="dtNascimento"
                                       required="required"><span class="input-group-addon"><i
                                        class="glyphicon glyphicon-th"></i></span>
                            </div>
                        </div>
                    </div>
                    <!-- Text input-->
                    <div class="form-group">
                        <label class="col-md-2 control-label" for="login" style="text-align: left">Login:</label>

                        <div class="col-md-5">
                            <input id="login" name="login" type="text" placeholder="Login" maxlength="45"
                                   class="form-control input-md" required="required">
                        </div>
                    </div>
                    <!-- Password input-->
                    <div class="form-group">
                        <label class="col-md-2 control-label" for="password" style="text-align: left">Senha:</label>

                        <div class="col-md-5">
                            <input id="password" name="password" type="password" placeholder="Senha"
                                   class="form-control input-md" required="required">
                        </div>
                    </div>
                    <!-- confirme Password input-->
                    <div class="form-group">
                        <label class="col-md-2 control-label" for="password" style="text-align: left">Confirme a
                            Senha:</label>

                        <div class="col-md-5">
                            <input id="confirmePassword" name="confirmePassword" type="password"
                                   placeholder="Confirme a Senha" class="form-control input-md" required="required">
                        </div>
                    </div>
                    <!-- Text input-->
                    <div class="form-group">
                        <label class="col-md-2 control-label" for="telefone" style="text-align: left">Telefone:</label>

                        <div class="col-md-5">
                            <input id="telefone" name="telefone" type="text" placeholder="Telefone"
                                   class="form-control input-md telefone" required="required">
                        </div>
                    </div>
                    <!-- Select Basic -->
                    <div class="form-group">
                        <label class="col-md-2 control-label" for="perfil" style="text-align: left">Perfil</label>

                        <div class="col-md-5">
                            <select id="perfil" name="perfil" class="form-control" required="required">
                                <option value="">Selecione...</option>
                                <option value="1">Atendente</option>
                                <option value="2">Gerente</option>
                            </select>
                        </div>
                    </div>
                    <!-- Button -->
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