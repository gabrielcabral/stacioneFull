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
$cv = new ControlVeiculo();


#verfica o o botão 'consultar' foi acionado
if (isset($_POST["consultar"])) {
    #passa o cpf e nome para consultar

    $veiculos = $cv->consultar($_POST);
} else {
    #mostrar todos os funcionarios
    $veiculos = $cv->consultar();
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




    <script type="text/javascript" src="../public/js/veiculo.js">

    </script>

</head>
<body>
<div id="wrapper">
    <?php
    $cv->topo();
    $cv->menu();

    ?>


    <div id="page-wrapper">
        <div id="page-inner">

            <h2>Veículo</h2>
            <?php

            if($_SESSION['tipoMsg'] ==0){
                $cv->alertaError($_SESSION['msg']);
            }elseif($_SESSION['tipoMsg'] ==1){
                $cv->alertaInfo($_SESSION['msg']);
            }elseif($_SESSION['tipoMsg'] ==2){
                $cv->alertaSuccess($_SESSION['msg']);
            }

            ?>
            <div class="row">
                <div class="col-lg-12" style="text-align: right">
                    <button class="btn btn-success" id="btnNovoFuncionario"><span
                            class="glyphicon glyphicon-plus"></span> Novo Veículo
                    </button>
                </div>
                <!-- /.col-lg-6 -->
            </div>
            <!-- /.row -->


            <fieldset>

                <form method="post" class="form-horizontal">

                    <!-- Text input-->
                    <div class="form-group">
                        <label class="col-md-2 control-label" for="nome">Fabricante:</label>

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
                    <div class="form-group">
                        <label class="col-md-2 control-label" for="nome">Modelo:</label>

                        <div class="col-md-4">
                            <select id="veiculo" name="veiculo" class="form-control input-md">

                            </select>

                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-2 control-label" for="nome"></label>

                        <div class="col-md-4" style="text-align: right">
                            <button type="reset" class="btn btn-danger" name="consultar">Limpar</button>
                            <button type="submit" class="btn btn-primary" name="consultar">Consultar</button>
                        </div>
                    </div>

                </form>
            </fieldset>
            <div class="jumbotron">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table id="mytable" class="table table-bordred table-striped" style="width: 100%">
                                    <thead>

                                    <th>Fabricante</th>
                                    <th>Veiculo</th>

                                    <th>Alterar</th>
                                    <th>Excluir</th>
                                    </thead>
                                    <tbody>
                                    <?php
                                    if (count($veiculos) > 0) {
                                        #foreach para listar os dados do funcionario
                                        foreach ($veiculos as $item) {
                                         ?>
                                            <tr id="codigo_<?= $item['id_veiculo']?>">
                                                <td><?=$item['nome_fabricante'];?></td>
                                                <td><?= $item['veiculo'] ?></td>

                                                                                               <td>
                                                    <p data-placement='top' data-toggle='tooltip' title='Alterar'>
                                                        <button class='btn btn-warning btnAletrar ' data-title='Alterar'
                                                                  id='<?= $item['id_veiculo'] ?>'>
                                                            <span class='glyphicon glyphicon-pencil'></span></button>
                                                    </p>
                                                </td>
                                                <td>
                                                    <p data-placement='top' data-toggle='tooltip' title='Excluir'>
                                                        <button class='btn btn-danger'
                                                                id='<?=$item['id_veiculo']?>'  data-href="deleteVeiculo.php?id=<?=$item['id_veiculo']?>" data-toggle="confirmation" data-placement="right"  title="">
                                                            <span class='glyphicon glyphicon-trash'></span></button>
                                                    </p>
                                                </td>
                                            </tr>
                                        <?php }
                                    } else {
                                        echo "<tr>
                                                    <td colspan='6' align='center' style='color: #002a80;font-weight: bold'>Nenhum Fincionário encontrado!</td></tr>";
                                    } ?>
                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>
                </div>
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
