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
$cc = new ControlCliente();


#verfica o o botão 'consultar' foi acionado
if (isset($_POST["consultar"])) {
    #passa o id e nome para consultar
    $clientes = $cc->consultar($_POST["id_cliente"], $_POST["nome"]);
} else {
    #mostrar todos os clientes
    $clientes = $cc->consultar(null, null);
}
?>

<html lang="pt-br">
    <head>
        <!-- define a codificação do HTML -->
        <meta charset="utf-8">

        <!-- define a o titulo do HMTL -->
        <title>Sistema Controle - SC</title>

        <!-- Link para o CSS do bootstrap -->
        <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet">

        <!-- Link para o CSS do bootstrap (menu) -->
        <link href="../bootstrap/css/navbar.css" rel="stylesheet">

    </head>
    <body>

        <!-- Link para o JQuery do bootstrap -->
        <script src="../bootstrap/js/jquery.min.js"></script>
        <script src="../bootstrap/js/bootstrap.min.js"></script>
        <script src="../bootstrap/js/bootstrap.min.js"></script>
        <script src="../bootstrap/js/ie10-viewport-bug-workaround.js"></script>

        <div class="container">
            <!-- inserir o menu -->
            <?php
            #mostrar o menu
            $cc->menu();
            $cc->alerta($_SESSION['msg']);
            ?> 

            <!-- Main component for a primary marketing message or call to action -->
            <div class="jumbotron">
                <fieldset>
                    <legend>Dados da Consulta</legend>
                    <form method="post">
                        <div class="form-group">
                            <label for="codigo" class="control-label">Código</label>
                            <input type="text" class="form-control" placeholder="código" name="id_cliente">
                            <label for="nome" class="control-label">Nome</label>
                            <input type="text" class="form-control" placeholder="nome" name="nome">
                        </div>
                        <button type="submit" class="btn btn-primary" name="consultar" style="width: 100%;">Consultar</button>
                    </form>
                </fieldset> 
            </div>

            <div class="jumbotron">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table id="mytable" class="table table-bordred table-striped">
                                    <thead>
                                    <th>Codigo</th>
                                    <th>Nome</th>
                                    <th>CPF</th>
                                    <th>Email</th>
                                    <th>Telefone</th>
                                    <th>Alterar</th>

                                    <th>Excluir</th>
                                    </thead>
                                    <tbody>
                                        <?php
                                        #foreach para listar os dados do cliente
                                        foreach ($clientes as $item) {
                                            echo "<tr>";
                                            echo "<td> {$item[id]} </td>";
                                            echo "<td> {$item[nome]} </td>";
                                            echo "<td> {$item[cpf]} </td>";
                                            echo "<td> {$cc->dataBrasileiro($item[dtNascimento])} </td>";
                                            echo "<td> {$item[telefone]} </td>";
                                            echo "<td><p data-placement='top' data-toggle='tooltip' title='Alterar'><button class='btn btn-primary btn-xs' data-title='Alterar' data-toggle='modal' data-target='#alterar{$item[id]}'><span class='glyphicon glyphicon-pencil'></span></button></p></td>";
                                            echo "<td><p data-placement='top' data-toggle='tooltip' title='Excluir'><button class='btn btn-danger btn-xs' data-title='Delete' data-toggle='modal' data-target='#excluir{$item[id]}'><span class='glyphicon glyphicon-trash'></span></button></p></td>";
                                            echo "</tr>";
                                        }
                                        ?>
                                    </tbody>
                                </table>                         
                            </div>

                        </div>
                    </div>
                </div>
            </div>



            <?php
            #foreach para listar os dados do cliente e definica cada modal para alterar
            foreach ($clientes as $item) {
                ?>
                <!-- modal de alterar -->
                <div class="modal fade" id="alterar<?php echo $item[id] ?>" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
                                <h4 class="modal-title custom_align" id="Heading">Alterar Cliente</h4>
                            </div>
                            <div class="modal-body">

                                <?php
                                #inclui a view alterar cliente
                                include 'alterarCliente.php';
                                ?>       

                            </div>
                        </div>
                    </div>
                </div> 
                <?php
            }
            ?>

            <?php
            #foreach para listar os dados do cliente e definica cada modal para alterar
            foreach ($clientes as $item) {
                ?>
                <!-- modal de exluir -->
                <div class="modal fade" id="excluir<?php echo $item[id] ?>" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
                                <h4 class="modal-title custom_align" id="Heading">Excluir Cliente</h4>
                            </div>
                            <div class="modal-body">

                                <?php
                                #inclui a view alterar cliente
                                include 'excluirCliente.php';
                                ?>       

                            </div>
                        </div>
                    </div>
                </div>
                <?php
            }
            ?> 



            <!-- Script -->
            <script>
                $(document).ready(function() {
                    $("#mytable #checkall").click(function() {
                        if ($("#mytable #checkall").is(':checked')) {
                            $("#mytable input[type=checkbox]").each(function() {
                                $(this).prop("checked", true);
                            });

                        } else {
                            $("#mytable input[type=checkbox]").each(function() {
                                $(this).prop("checked", false);
                            });
                        }
                    });

                    $("[data-toggle=tooltip]").tooltip();
                });
            </script>

    </body>
</html>
