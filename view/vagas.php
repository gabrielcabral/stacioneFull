<?php
#iniciar_sessao
session_start();

#função para resolver problema de header
ob_start();

#define codificação
header('Content-Type: text/html; charset=UTF-8');

#cria o objeto de controle
$ce = new ControlEstaciona();

$vaga = $ce->consultarVagas(1);

if (isset($_POST["alterar"])) {
    #passa os dados para inserir
    $ce->alterarVaga($_POST);
}

?>


<html lang="pt-br">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>STACIONE</title>
    <link rel="icon" type="image/jpg" href="../bootstrap/img/logo.JPG" />

    <!-- BOOTSTRAP STYLES-->
    <link href="../bootstrap/css/bootstrap.css" rel="stylesheet" />
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




    <script type="text/javascript" src="../public/js/vagas.js">

    </script>

</head>
<body>
<div id="wrapper">
    <?php
        $ce->topo();
        $ce->menu();
    ?>


    <div id="page-wrapper" >
        <div id="page-inner">
            <h2>Vagas</h2>
            <?php

            if($_SESSION['tipoMsg'] ==0){
                $ce->alertaError($_SESSION['msg']);
            }elseif($_SESSION['tipoMsg'] ==1){
                $ce->alertaInfo($_SESSION['msg']);
            }elseif($_SESSION['tipoMsg'] ==2){
                $ce->alertaSuccess($_SESSION['msg']);
            }

            ?>
            <div class="row"><fieldset>
                    <form method="post" class="form-horizontal">

                        <!-- Multiple Checkboxes (inline) -->
                        <div class="form-group">
                            <label class="col-md-2 control-label" for="liberaCampo"></label>
                            <div class="col-md-4">
                                <label class="checkbox-inline" for="liberaCampo-0">
                                    <input type="checkbox" name="liberaCampo" id="liberaCampo" >
                                    Liberar Campo
                                </label>
                            </div>
                        </div>
                        <!-- Text input-->
                        <div class="form-group">
                            <label class="col-md-2 control-label" for="nome">Vagas</label>

                            <div class="col-md-4">
                                <input id="vaga" name="vaga" type="text" placeholder="" value="<?=$vaga[1]?>" readonly="readonly"
                                       class="form-control input-md" >
                                <input id="id_vaga" name="id_vaga" type="hidden" value="<?=$vaga[0]?>" >
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-2 control-label" for="nome"></label>

                            <div class="col-md-4" style="text-align: right">
                                <button  class="btn btn-warning disabled"  name="alterar" id="alterar" ><i class="fa fa-edit"></i> Alterar</button>

                            </div>
                        </div>

                    </form>
                </fieldset>


            <!-- /. ROW  -->
        </div>
        <!-- /. PAGE INNER  -->
    </div>
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

