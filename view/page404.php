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
$ce = new ControlEstaciona();
// verfica o o botão 'consultar' foi acionado
if (isset($_POST["consultar"])) {
    // passa o cpf e nome para consultar
    $entrada = $ce->consultar($_POST);
} else {
    // mostrar todos ass entradas de veiculos
    $entrada = $ce->consultar();
}
$vagas = $ce->consultarVagas(1);






?>
<html lang="pt-br">
<head>
    <link rel="icon" href="../bootstrap/img/logo.jpg" type="image/x-icon"/>
    <link rel="shortcut icon" href="../bootstrap/img/logo.jpg" type="image/x-icon"/>
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
    $ce->topo();
    $ce->menu();
    ?>
    <div id="page-wrapper">
        <div id="page-inner">

            <div class="jumbotron">
                <fieldset>
                    <!-- Form Name -->
                    <legend>Entrada</legend>
                    <?php
                    if ($_SESSION['tipoMsg'] == 0) {
                        $ce->alertaError($_SESSION['msg']);
                    } elseif ($_SESSION['tipoMsg'] == 1) {
                        $ce->alertaInfo($_SESSION['msg']);
                    } elseif ($_SESSION['tipoMsg'] == 2) {
                        $ce->alertaSuccess($_SESSION['msg']);
                    }
                    if (count($entrada) >= $vagas[1]) { ?>
                        <h1>Lotado</h1>
                        <?php
                    } else {
                        ?>
                        <!-- Button -->
                        <div class="form-group">
                            <div class="col-md-2">
                                <button class="btn btn-success btn-lg " id="btnentrada" name="btnentrada"
                                ><span
                                        class="fa fa-car fa-2x"></span> Registrar Entrada
                                </button>
                            </div>
                        </div>
                    <?php } ?>
                    <!-- Button -->
                    <div class="form-group">
                        <div class="col-md-5 " style="margin-left: 20%">
                            <video autoplay controls></video>
                        </div>
                    </div>
                </fieldset>


                <div class="row">

                    <fieldset>
                        <form method="post" class="form-horizontal">
                            <legend>Consulta</legend>
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
                                    <button type="reset" class="btn btn-danger" name="consultar"><span
                                            class="glyphicon glyphicon-remove"></span>Limpar
                                    </button>
                                    <button type="submit" class="btn btn-primary" id="consultar" name="consultar"><span
                                            class="glyphicon glyphicon-search"></span> Consultar
                                    </button>
                                </div>
                            </div>
                        </form>
                    </fieldset>


                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table id="mytable" class="table table-bordred table-striped" style="font-size: small">
                                    <thead>
                                    <th>Entrada</th>
                                    <th>Placa</th>
                                    <th>Veiculo</th>
                                    <th>Fabricante</th>
                                    <th>Detalhes</th>
                                    <th>Saída</th>
                                    </thead>
                                    <tbody>
                                    <?php
                                    // foreach para listar os dados do entrada
                                    foreach ($entrada as $item) {
                                        echo "<tr>";
                                        echo "<td>" . date('d/m/Y H:i:s', strtotime($item[ENTRADA])) . "</td>";
                                        echo "<td style='font-weight: bold'>" . strtoupper($item['PLACA']) . " </td>";
                                        echo "<td> {$item['nome_veiculo']} </td>";
                                        echo "<td> {$item['nome_fabricante']} </td>";
                                        echo "<td><button class='btn btn-info' id='" . $item['ID_ENTRADA_SAIDA'] . "' data-toggle='modal' data-target='#modal_" . $item['ID_ENTRADA_SAIDA'] . "'  ><span class='glyphicon glyphicon-th-list'></span> Detelhes</button></td>";
                                        echo " <td  data-placement='top' data-toggle='tooltip' title='Excluir'>
                                                        <button class='btn btn-success'
                                                                 data-href='saida.php?id=" . $item['ID_ENTRADA_SAIDA'] . "' data-toggle='confirmation' data-placement='right'  title='Registrar Saída'>
                                                            <span class='fa fa-sign-out'></span>  Registrar Saída</button>
                                                   </td>";
                                        echo "</tr>";

                                    } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
                <?php
                // foreach para listar os dados do entrada
                foreach ($entrada as $item) { ?>
                    <!-- Modal-->
                    <div class="modal fade" id="modal_<?= $item['ID_ENTRADA_SAIDA'] ?>" tabindex="-1" role="dialog"
                         aria-labelledby="myModalLabel">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                            aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title" id="myModalLabel"><b>Detalhes</b></h4>
                                </div>
                                <div class="modal-body">
                                    Entrada: <?= date('d/m/Y H:i:s', strtotime($item['ENTRADA'])) ?><br>
                                    Placa: <?= $item['PLACA'] ?><br>
                                    Fabricante: <?= $item['nome_fabricante'] ?><br>
                                    Veiculo: <?= $item['nome_veiculo'] ?><br>
                                    Imagem:<br> <img src="../<?= $item['imagem'] ?>">
                                </div>
                                <div class="modal-footer">

                                    <td data-placement="top" data-toggle="tooltip" title="Excluir">
                                        <button class="btn btn-success"
                                                data-href="saida.php?id=<?= $item['ID_ENTRADA_SAIDA'] ?>"
                                                data-toggle="confirmation" data-placement="top" title="Dar a Saida">
                                            <span class=="fa fa-sign-out"></span>  Dar Saída
                                        </button>
                                        <button type="button" class="btn btn-default" data-dismiss="modal"><span
                                                aria-hidden="true">&times;</span> Fechar
                                        </button>
                                    </td>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
                <!-- /. ROW  -->

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


