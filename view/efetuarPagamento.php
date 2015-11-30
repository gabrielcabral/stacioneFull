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
$preco = $ce->consultarPreco();
$dadosEntrada = $ce->consultarParaPagamento(['id' => $_GET['id']]);
$data1 = date("H,i,s,m,d,y", strtotime($dadosEntrada['ENTRADA']));
$data2 = date("H,i,s,m,d,y", strtotime($dadosEntrada['SAIDA']));
$segunto1 = mktime($data1);
$segunto2 = mktime($data2);
$to = ($segunto1 - $segunto2);
#converter o tempo em minutos
$mins = round(($to / 60));
$total = $mins * $preco['PRECO_MINUTO'];

?>
<html lang="pt-br">
<head>
    <title>STACIONE</title>
    <!-- BOOTSTRAP STYLES-->
    <link href="../bootstrap/css/bootstrap.css" rel="stylesheet"/>
    <!-- FONTAWESOME STYLES-->
    <link href="../bootstrap/css/font-awesome.css" rel="stylesheet"/>
    <!-- MORRIS CHART STYLES-->
    <link href="../bootstrap/js/morris/morris-0.4.3.min.css" rel="stylesheet"/>
    <!-- CUSTOM STYLES-->
    <link href="../bootstrap/css/custom.css" rel="stylesheet"/>
    <script src="../bootstrap/js/jquery-2.1.4.js"></script>
    <script src="../bootstrap/js/jquery.mask.js"></script>
    <script src="../bootstrap/js/jquery.maskMoney.js"></script>
    <script src="../bootstrap/js/bootstrap-tooltip.js"></script>
    <script src="../bootstrap/js/jquery.bsAlerts.js"></script>
    <script src="../bootstrap/js/bootstrap-confirmation.js"></script>
    <script type="text/javascript" src="../public/js/pagamento.js"></script>
    <script src="../bootstrap/js/bootstrap.min.js"></script>
<body>
<div id="wrapper">
    <?php
    $ce->topo();
    $ce->menu();
    ?>
    <div id="page-wrapper">
        <div id="page-inner">
            <h2>Pagamento</h2>
            <?php
            if ($_SESSION['tipoMsg'] == 0) {
                $ce->alertaError($_SESSION['msg']);
            } elseif ($_SESSION['tipoMsg'] == 1) {
                $ce->alertaInfo($_SESSION['msg']);
            } elseif ($_SESSION['tipoMsg'] == 2) {
                $ce->alertaSuccess($_SESSION['msg']);
            }
            ?>
            <div data-alerts="alerts" data-fade="3000"></div>
            <div class="row">
                <fieldset>
                    <form class="form-horizontal" method="post" id="formEfetuarPagamento">
                        <!-- Text input-->
                        <div class="form-group">
                            <label class="col-md-3 control-label text-right" for="total">Total:</label>

                            <div class="col-md-4">
                                <b style="font-size: 60px"><?= 'R$' . number_format($total, 2, ',', '.'); ?></b>
                                <input id="total" name="total" type="hidden" placeholder="" value="<?= $total ?>"
                                       class="form-control input-md">
                            </div>
                        </div>
                        <!-- Select Basic -->
                        <div class="form-group">
                            <label class="col-md-3 control-label text-right" for="tpPagamento ">Forma de
                                Pagamento</label>

                            <div class="col-md-4">
                                <select id="tpPagamento" name="tpPagamento" class="form-control">
                                    <option value="0">Selecionar</option>
                                    <option value="1">Dinheiro</option>
                                    <option value="2">Cartão Credito</option>
                                    <option value="3">Cartão Debito</option>
                                </select>
                            </div>
                        </div>
                        <!-- Text input-->
                        <div class="form-group">
                            <label class="col-md-3 control-label" for="Recebido">Recebido</label>

                            <div class="col-md-4">
                                <input name="recebido" id="recebido" type="text" placeholder=""
                                       class="form-control input-md">
                            </div>
                        </div>

                        <!-- Text input-->
                        <div class="form-group">
                            <label class="col-md-3 control-label" for="troco">Troco</label>

                            <div class="col-md-4">
                                <input name="troco" id="troco" type="text" placeholder=""
                                       class="form-control input-md">
                            </div>
                        </div>

                        <input id="ID_ENTRADA_SAIDA" name="ID_ENTRADA_SAIDA" value="<?=$dadosEntrada['ID_ENTRADA_SAIDA']?>" type="hidden"/>


                        <!-- Text input-->
                        <div class="form-group">
                            <label class="col-md-3 control-label"></label>

                            <div class="col-md-4">
                                <button class="btn btn-success btn-block" type="submit" id="receber" name="receber"><span class="glyphicon glyphicon-ok"></span>
                                    Registrar Pagamento
                                </button>
                            </div>
                        </div>
                    </form>
                </fieldset>
                <!-- /. ROW  -->
            </div>
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
<?php

if (isset($_POST["receber"])) {
    #passa os dados para inserir

    $ce->efetuarPagamento($_POST);
}
?>