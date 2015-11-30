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
    #mostrar todos os Veiculo
   // $veiculos = $cv->consultar();
}

?>

<html lang="pt-br">
<head>


    <link rel="icon" href="../bootstrap/img/logo.JPG" type="image/x-icon" />
    <link rel="shortcut icon" href="../bootstrap/img/logo.JPG" type="image/x-icon" />
    <title>STACIONE</title>
    <!-- BOOTSTRAP STYLES-->
    <link href="../bootstrap/css/bootstrap.css" rel="stylesheet" />
    <script src="../bootstrap/js/jquery-2.1.4.js"></script>
    <!-- FONTAWESOME STYLES-->
    <link href="../bootstrap/css/font-awesome.css" rel="stylesheet" />
    <!-- MORRIS CHART STYLES-->
    <link href="../bootstrap/js/morris/morris-0.4.3.min.css" rel="stylesheet" />
    <!-- CUSTOM STYLES-->
    <link href="../bootstrap/css/custom.css" rel="stylesheet" />
    <script src="../bootstrap/js/jquery.maskedinput.js"></script>
    <script src="../bootstrap/js/bootstrap-tooltip.js"></script>
    <script src="../bootstrap/js/bootstrap-confirmation.js"></script>
    <script src="../bootstrap/js/bootstrap-datepicker.js" type="text/javascript"></script>
    <script src="../bootstrap/js/bootstrap-datepicker.pt-BR.min.js" type="text/javascript"></script>
    <script src="../bootstrap/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="../public/js/veiculo.js"></script>
</head>
<body>
<div id="wrapper">
    <?php
    //insere do topo do sistema
    $cv->topo();
    // chama para o menu lateral
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
            if($_SESSION['UsuarioNivel'] != 1){
            ?>
            <div class="row">
                <div class="col-lg-12" style="text-align: right">
                    <button class="btn btn-success" id="btnNovoVeiculo"><span
                            class="glyphicon glyphicon-plus"></span> Novo Veículo
                    </button>
                </div>
            </div>
            <fieldset>
                <form method="post" class="form-horizontal" id="formVeiculos">
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
                            <select id="modelo" name="modelo" class="form-control input-md"></select>
                        </div>
                    </div>
                    <!-- botões -->
                    <div class="form-group">
                        <label class="col-md-2 control-label" for="nome"></label>
                        <div   class="col-md-4" style="text-align: right">
                            <button type="reset" class="btn btn-danger" name="consultar">Limpar</button>
                                     <button class="btn btn-primary" id="consultar" name="consultar">Consultar</button>
                        </div>
                    </div>
                </form>
            </fieldset>
        <!--tabela de consulta -->
            <div class="jumbotron" id="divVeiculos" >
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
                                        #foreach para listar os dados do veiculo
                                        foreach ($veiculos as $item) {
                                         ?>
                                            <tr id="codigo_<?= $item['id_veiculo']?>">
                                                <td><?=$item['nome_fabricante'];?></td>
                                                <td><?= $item['nome_veiculo'] ?></td>
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
                                                    <td colspan='6' align='center' style='color: #002a80;font-weight: bold'>Nenhum Veículo encontrado!</td></tr>";
                                    } ?>
                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <?php } else {

                $_SESSION['msg'] = "O usuário ".$_SESSION['UsuarioNome']." não tem permissao! ";

                $cc->alertaError($_SESSION['msg']);
            }

            ?>
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
