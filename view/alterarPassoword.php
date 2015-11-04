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


if (isset($_POST["alterar"])) {

$_POST['id_funcionario'] =$_SESSION['UsuarioID'];
#passa os novos dados do pet para o controle realizar a alteração

//$cc->alterarSenha($_POST);

}

?>

<html lang="pt-br">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>STACIONE</title>

    <!-- BOOTSTRAP STYLES-->
    <link href="../bootstrap/css/bootstrap.css" rel="stylesheet" />
    <link href="../bootstrap/css/prettify.css" rel="stylesheet" />
    <link href="../bootstrap/css/docs.css" rel="stylesheet" />
    <!-- FONTAWESOME STYLES-->
    <link href="../bootstrap/css/font-awesome.css" rel="stylesheet" />
    <!-- MORRIS CHART STYLES-->
    <link href="../bootstrap/js/morris/morris-0.4.3.min.css" rel="stylesheet" />
    <!-- CUSTOM STYLES-->
    <link href="../bootstrap/css/custom.css" rel="stylesheet" />
    <script src="../bootstrap/js/jquery-2.1.4.js"></script>
    <script src="../bootstrap/js/jquery.mask.js"></script>
    <script src="../bootstrap/js/bootstrap-tooltip.js"></script>
    <script src="../bootstrap/js/bootstrap-confirmation.js"></script>
    <script src="../bootstrap/js/prettify.js"></script>
    <script src="../bootstrap/js/jquery.bsAlerts.js"></script>




    <script type="text/javascript" src="../public/js/funcionario.js">

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

            <h2>Alterar Senha </h2>
            <?php

            if($_SESSION['tipoMsg'] ==0){
                $cc->alertaError($_SESSION['msg']);
            }elseif($_SESSION['tipoMsg'] ==1){
                $cc->alertaInfo($_SESSION['msg']);
            }elseif($_SESSION['tipoMsg'] ==2){
                $cc->alertaSuccess($_SESSION['msg']);
            }

            ?>
            <div data-alerts="alerts" data-titles="{&quot;warning&quot;: &quot;&lt;em&gt;Atenção!&lt;/em&gt;&quot;}" data-ids="myid" data-fade="6000"></div>
            <div data-alerts="alerts" data-titles="{&quot;success &quot;: &quot;&lt;em&gt;Atenção!&lt;/em&gt;&quot;}" data-ids="myid" data-fade="6000"></div>
            <fieldset>

                <form method="post" id="formAlterarSenha" class="form-horizontal">
                    <div class="form-group">
                        <!-- Password input-->
                        <div class="form-group">
                            <label class="col-md-2 control-label" for="senha">Senha Antiga</label>
                            <div class="col-md-4">
                                <input id="senhaAntiga" name="senhaAntiga" type="password" placeholder="" class="form-control input-md" required="">
                            </div>
                        </div>

                        <input id="id_funcionario" value="?>" type="hidden">
                        <!-- Password input-->
                        <div class="form-group">
                            <label class="col-md-2 control-label" for="senha">Senha</label>
                            <div class="col-md-4">
                                <input id="senha" name="senha" type="password" placeholder="" class="form-control input-md" required="">
                            </div>
                        </div>

                        <!-- Password input-->
                        <div class="form-group">
                            <label class="col-md-2 control-label" for="cosenha">confirme senha</label>
                            <div class="col-md-4">
                                <input id="cosenha" name="cosenha" type="password" placeholder="" class="form-control input-md">
                            </div>
                        </div>
                        <!-- Button -->
                        <div class="form-group">
                            <label class="col-md-2 control-label" for="inserir"></label>
                            <div class="col-md-4 ">

                                <button type="submit" name="alterarPasss" id="alterarPasss" class="btn btn-warning btn-lg pull-right" ><span class="fa fa-pencil-square-o"></span>Alterar</button>
                            </div>
                        </div>
                    </div>

                </form>
            </fieldset>
        </div>

        <!-- /. ROW  -->
    </div>
    <!-- /. PAGE INNER  -->
</div>
<!-- /. PAGE WRAPPER  -->
</div>
<!-- /. WRAPPER  -->
<!-- SCRIPTS -AT THE BOTOM TO REDUCE THE LOAD TIME-->



</body>
</html>
