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
$cc = new ControlFuncionario();

#verfica o o botão 'consultar' foi acionado
if (isset($_POST["consultar"])) {
    #passa o cpf e nome para consultar

    $funcionarios = $cc->consultar($_POST);
} else {
    #mostrar todos os funcionarios
    $funcionarios = $cc->consultar();
}



$local_file = 'cupon_fiscal'.date('dmyHis'); // Definimos o local para salvar o arquivo de texto
$escreve = "Teste de impressao\nEste texto está sendo impresso por uma página em PHP!!"; // A variavel escreve será o que desejamos imprimir e escrever no arquivo de texto
$fp = fopen('../cupom/'.$local_file.'.txt', "w"); //utilizamos o operador w+ para criar o arquivo imprimir.txt, e APAGAR tudo que já existe nele, caso ele já exista.
$salva = fwrite($fp, $escreve);
fclose($fp);

// Agora que já temos o arquivo imprime.txt, no local indicado por $local_fil, basta mandar imprimir:



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

            <h2>Funcionário</h2>
            <?php

            if($_SESSION['tipoMsg'] ==0){
                $cc->alertaError($_SESSION['msg']);
            }elseif($_SESSION['tipoMsg'] ==1){
                $cc->alertaInfo($_SESSION['msg']);
            }elseif($_SESSION['tipoMsg'] ==2){
                $cc->alertaSuccess($_SESSION['msg']);
            }

            ?>
            <div class="row">
                <div class="col-lg-12" style="text-align: right">
                    <button class="btn btn-success" id="btnNovoFuncionario"><span
                            class="glyphicon glyphicon-plus"></span> Novo Funcionário
                    </button>
                </div>
                <!-- /.col-lg-6 -->
            </div>
            <!-- /.row -->


            <fieldset>

                <form method="post" class="form-horizontal">

                    <!-- Text input-->
                    <div class="form-group">
                        <label class="col-md-2 control-label" for="nome">Nome</label>

                        <div class="col-md-4">
                            <input id="nm_funcionario" name="nm_funcionario" type="text" placeholder=""
                                   class="form-control input-md">

                        </div>
                    </div>

                    <!-- Text input-->
                    <div class="form-group">
                        <label class="col-md-2 control-label" for="cpf">CPF</label>

                        <div class="col-md-4">
                            <input id="cpf_funcionario" name="cpf_funcionario" type="text" placeholder=""
                                   class="form-control input-md mascaraCpf " title="Digite o CPF somente numeros">

                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 control-label" for="nome"></label>

                        <div class="col-md-4" style="text-align: right">
                            <button type="reset" class="btn btn-danger" name="consultar"><span class="glyphicon glyphicon-remove"></span> Limpar</button>
                            <button type="submit" class="btn btn-primary" name="consultar"><span class="glyphicon glyphicon-search"></span> Consultar</button>
                        </div>
                    </div>

                </form>
            </fieldset>
            <div class="jumbotron">

                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table id="mytable" class="table table-bordred table-striped" style="width: 100%">
                                    <thead>

                                    <th>Nome</th>
                                    <th>CPF</th>
                                    <th>Telefone</th>
                                    <th>Perfil</th>
                                    <th>Data Nascimento</th>
                                    <th>Alterar</th>
                                    <th>Excluir</th>
                                    </thead>
                                    <tbody>
                                    <?php
                                    if (count($funcionarios) > 0) {
                                        #foreach para listar os dados do funcionario
                                        foreach ($funcionarios as $item) {
                                            if ($item['ID_PERFIL'] == 1) {
                                                $perfil = "Atentende";
                                            } else {
                                                $perfil = "Gerente";
                                            }
                                            ?>
                                            <tr id="codigo_<?= $item['ID_FUNCIONARIO'] ?>">
                                                <td><?= $item['NM_FUNCIONARIO'] ?></td>
                                                <td><?=$cc->mascara($item['CPF_FUNCIONARIO'],'###.###.###-##');?></td>
                                                <td><?= $item['TELEFONE'] ?></td>
                                                <td><?= $perfil ?></td>
                                                <td><?= $cc->dataBrasileiro($item['DT_NASCIMENTO']) ?></td>
                                                <td>
                                                    <p data-placement='top' data-toggle='tooltip' title='Alterar'>
                                                        <button class='btn btn-warning btnAletrar ' data-title='Alterar'
                                                                  id='<?= $item['ID_FUNCIONARIO'] ?>'>
                                                            <span class='glyphicon glyphicon-pencil'></span></button>
                                                    </p>
                                                </td>
                                                <td>
                                                    <p data-placement='top' data-toggle='tooltip' title='Excluir'>
                                                        <button class='btn btn-danger'
                                                                id='<?=$item['ID_FUNCIONARIO']?>'  data-href="deleteFuncionario.php?id=<?=$item['ID_FUNCIONARIO']?>" data-toggle="confirmation" data-placement="right"  title="Deleja excluir o funcionário <?=$item['NM_FUNCIONARIO']?>">
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
