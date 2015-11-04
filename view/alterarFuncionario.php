<?php
#iniciar_sessao
//session_start();

#função para resolver problema de header
ob_start();

#define codificação
header('Content-Type: text/html; charset=UTF-8');

#carrega as classes automaticamente
include_once 'autoload.php';

#cria o objeto de controle
$cc = new ControlFuncionario();
$_GET['id_funcionario'] = $_GET['id'];
$funcionarios = $cc->consultar($_GET);
#verfica o o botão 'consultar' foi acionado
if (isset($_POST["inserir"])) {
    #passa os dados para inserir

    $cc->inserir($_POST);
}
var_dump($funcionarios);

?>
<html lang="pt-br">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>STACIONE</title>
    <!-- BOOTSTRAP STYLES-->
    <link href="../bootstrap/css/bootstrap.css" rel="stylesheet" />
    <!-- FONTAWESOME STYLES-->
    <link href="../bootstrap/css/font-awesome.css" rel="stylesheet" />
    <!-- CUSTOM STYLES-->
    <link href="../bootstrap/css/custom.css" rel="stylesheet" />
    <link href="../bootstrap/css/jquery-ui.css" rel="stylesheet" />
    <link href="../bootstrap/css/bootstrap-datepicker3.css" rel="stylesheet" />

</head>
<!--<script src="../bootstrap/js/jquery-1.10.2.js"></script>-->
<script src="../bootstrap/js/jquery-2.1.4.js"></script
<!-- BOOTSTRAP SCRIPTS -->
<script src="../bootstrap/js/bootstrap.min.js"></script>
<!-- METISMENU SCRIPTS -->
<script src="../bootstrap/js/jquery.metisMenu.js"></script>

<!-- CUSTOM SCRIPTS -->
<link rel="stylesheet" href="../bootstrap/css/jquery-ui.css">
<!--<script src="../bootstrap/js/jquery-1.10.2.js"></script>
<script src="../bootstrap/js/jquery-ui.js"></script>
<script src="../bootstrap/js/jquery.js"></script>-->


<script src="../bootstrap/js/bootstrap-datepicker.js" type="text/javascript"></script>
<script src="../bootstrap/js/bootstrap-datepicker.pt-BR.min.js" type="text/javascript"></script>
<script src="../bootstrap/js/jquery.maskedinput.js" type="text/javascript"></script>
<script src="../public/js/funcionario.js"></script>
<script src="../bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript">

    $('#dtNascimento').datepicker({
        format: "dd/mm/yyyy",
        todayBtn: "linked",
        language: "pt-BR",
        orientation: "top left",
        autoclose: true,
        beforeShowMonth: function (date){
            switch (date.getMonth()){
                case 8:
                    return false;
            }
        }
    });
</script>
<body>
<div id="wrapper">
    <?php
    $cc->topo();
    $cc->menu();
    ?>



    <div id="page-wrapper" >
        <div id="page-inner">

            <div class="alert alert-success" id="success" role="alert" style="display: none"></div>
            <div class="alert alert-info" id="info" role="alert" style="display: none"></div>
            <div class="alert alert-warning" id="warning" role="alert" style="display: none"></div>
            <div class="alert alert-danger" id="danger" role="alert" style="display: none"></div>


                <form class="form-horizontal" id="formFunc">
                    <fieldset>

                        <!-- Form Name -->
                        <legend >  <h2>Cadastro Funcionário</h2></legend>

                        <!-- Text input-->
                        <div class="form-group">
                            <label class="col-md-2 control-label" for="nome" style="text-align: left">Nome:</label>
                            <div class="col-md-5">
                                <input id="nm_funcionario" name="nm_funcionario" value="<?=$funcionarios[0]['NM_FUNCIONARIO']?>" maxlength="200" type="text" placeholder="Nome" class="form-control input-md" required="">

                            </div>
                        </div>

                        <!-- Text input-->
                        <div class="form-group">
                            <label class="col-md-2 control-label" for="cpf" style="text-align: left">CPF:</label>
                            <div class="col-md-5">
                                <input id="cpf_funcionario" name="cpf_funcionario" type="text" value="<?=$cc->mascara($funcionarios[0]['CPF_FUNCIONARIO'],'###.###.###-##')?>" placeholder="CPF" class="form-control input-md mascaraCpf" required="">
                                <span class="help-block" id="cpfValidado">CPF Inválido!</span>
                            </div>
                        </div>

                        <!-- Text input-->
                        <div class="form-group">
                            <label class="col-md-2 control-label" for="rg" style="text-align: left">RG:</label>
                            <div class="col-md-5">
                                <input id="rg_funcionario" name="rg_funcionario" type="text" value="<?=$funcionarios[0]['RG_FUNCIONARIO']?>" maxlength="45" placeholder="RG" class="form-control input-md" required="">
                            </div>
                        </div>


                        <!-- Text input-->
                        <div class="form-group">
                            <label class="col-md-2 control-label" for="dtNascimento" style="text-align: left">Data de Nascimento:</label>
                            <div class="col-md-5" >
                                <!--<input id="dtNascimento" name="dtNascimento" type="text" placeholder="" title="Qual sua Data de Nascimento?" class="form-control input-md date" required="">-->
                                <div class="input-group date">
                                    <input type="text" class="form-control" id="dtNascimento" value="<?= $cc->dataBrasileiro($funcionarios[0]['DT_NASCIMENTO'])?>" name="dtNascimento" ><span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span>
                                </div>
                            </div>
                        </div>

                        <!-- Text input-->
                        <div class="form-group">
                            <label class="col-md-2 control-label" for="telefone" style="text-align: left">Telefone:</label>
                            <div class="col-md-5">
                                <input id="telefone" name="telefone" type="text" value="<?=$funcionarios[0]['TELEFONE']?>"  placeholder="Telefone" class="form-control input-md telefone" required="">
                            </div>
                        </div>
                        <!-- Select Basic -->
                        <div class="form-group">
                            <label class="col-md-2 control-label" for="perfil" style="text-align: left">Perfil</label>
                            <div class="col-md-5">
                                <select id="perfil" name="perfil" class="form-control">
                                    <option value="">Selecione...</option>
                                    <option value="1" <?php echo ( $funcionarios[0]['ID_PERFIL'] == 1 ? "selected":"" );?> >Atendente</option>
                                    <option value="2" <?php echo ( $funcionarios[0]['ID_PERFIL'] == 2 ? "selected":"" );?>>Gerente</option>
                                </select>
                            </div>
                        </div>

                        <!-- Button -->
                        <div class="form-group">

                            <div class="col-md-7" style="text-align: right">
                                <button id="aletrar" name="alterar"   class="btn btn-warning"><span class="glyphicon glyphicon-pencil"></span> Alterar</button>
                            </div>
                        </div>
                    </fieldset>
                </form>

        <!-- /. PAGE INNER  -->
    </div>
<!-- /. PAGE WRAPPER  -->
</div>

