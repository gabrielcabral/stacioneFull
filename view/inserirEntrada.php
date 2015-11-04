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
$ce = new ControlEstaciona();
$img =new ControlImagem();
$cv =new ControlVeiculo();
$imgem = $img->consultar();


if (isset($_POST["salvar"])) {
    #passa os dados para inserir

    $ce->inserir($_POST);
}
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
<link rel="stylesheet" href="../bootstrap/css/docs.css" />
<link rel="stylesheet" href="../bootstrap/css/prettify.css" />
<!-- CUSTOM SCRIPTS -->
<link rel="stylesheet" href="../bootstrap/css/jquery-ui.css">
<script src="../bootstrap/js/jquery-1.10.2.js"></script>
<script src="../bootstrap/js/jquery-ui.js"></script>
<script src="../bootstrap/js/jquery.js"></script>
<script src="../bootstrap/js/jquery.maskedinput.js"></script>

<script src="../bootstrap/js/bootstrap-tooltip.js"></script>
<script src="../bootstrap/js/bootstrap-confirmation.js"></script>
<script src="../bootstrap/js/bootstrap-datepicker.js" type="text/javascript"></script>
<script src="../bootstrap/js/bootstrap-datepicker.pt-BR.min.js" type="text/javascript"></script>

<script src="../bootstrap/js/jquery.maskedinput.js" type="text/javascript"></script>


<script src="../bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript" src="../webcam.js"></script>
<script type="text/javascript" src="../public/js/entrada.js"></script>
<script src="../bootstrap/js/prettify.js"></script>
<script src="../bootstrap/js/jquery.bsAlerts.js"></script>

<body>
<div id="wrapper">
    <?php
    $ce->topo();
    $ce->menu();
    ?>



    <div id="page-wrapper" >
        <div id="page-inner">



                <form class="form-horizontal" id="formEntrada" method="post">
                    <fieldset>

                        <!-- Form Name -->
                        <legend >  <h2>Cadastro de Entrada</h2></legend>
                        <div data-alerts="alerts" id="alerts"></div>
                        <!-- Text input-->
                        <div class="form-group">
                            <label class="col-md-2 control-label">Entrada:</label>
                            <div class="col-md-4">
                                <input id="entrada" name="entrada" maxlength="200" type="text" placeholder="Nome" class="form-control input-md" readonly="readonly" value="<?=date("d/m/Y H:m:s")?>">

                            </div>
                        </div>
                        <input type="hidden" id="imagem" value="<?=$_SESSION['nomeImagem']?>" >
                        <!-- Text input-->
                        <div class="form-group">
                            <label class="col-md-2 control-label" >Imagem:</label>
                            <div class="col-md-4">
                                <script type="text/javascript">
                                    //Instanciando a webcam. O tamanho pode ser alterado
                                    document.write(webcam.get_html(320, 240));
                                </script>

                            </div>
                        </div>

                        <!-- Text input-->
                        <div class="form-group aparece">
                            <label class="col-md-2 control-label">Placa:</label>
                            <div class="col-md-4">
                                <input id="placa" name="placa" type="text" maxlength="45" placeholder="" class="form-control input-md" required="">
                            </div>
                        </div>

                        <!-- Text input-->
                        <div class="form-group aparece">
                            <label class="col-md-2 control-label" >Fabricante:</label>

                            <div class="col-md-4">
                                <select id="nome_fabricante" name="nome_fabricante"  class="form-control input-md">

                                    <option value="">Selecione..</option>
                                    <?php
                                    $fabricantes = $cv->selectFabricante();
                                    foreach($fabricantes as $value){
                                        echo  "<option value='".$value['ID_fabricante']."'>".$value['nome_fabricante']."</option>";
                                    }
                                    ?>
                                </select>

                            </div>
                        </div>

                        <!-- Text input-->
                        <div class="form-group aparece">
                            <label class="col-md-2 control-label ">Modelo:</label>

                            <div class="col-md-4">
                                <select id="veiculo" name="veiculo" class="form-control input-md">

                                </select>

                            </div>
                        </div>

                        <!-- Button -->
                        <div class="form-group">

                            <div class="col-md-7" style="text-align: right">
                                <button class="btn btn-danger" type="reset">Limpar</button>

                                <button  class="btn btn-info  " id="config" onClick="webcam.configure()"><i class="fa fa-cog"></i></span> Configuração de camera</button>
                                <button class="btn btn-success  " id="tirarfoto"><i class="fa fa-camera"></i></span> Tirar foto</button>
                                <button id="salvar" name="salvar"   class="btn btn-primary  aparece"><span class="glyphicon glyphicon-ok"></span> Salvar</button>
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
