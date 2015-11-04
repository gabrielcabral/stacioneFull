<?php
#invoca o método cosultar do controle e passa como parâmetro o id do cliente
$clientes_excluir = $cc->consultar($item[id], null);

#verificar se o botão "excluir" foi acionado
if (isset($_POST["excluir"])) {
    #passa o id do cliente para o controle realizar a exclusão
    $cc->excluir($_POST["id"]);
}

#mostrar os dados do cliente
foreach ($clientes_excluir as $item_excluir) {
    ?>
    <fieldset>
        <form id="cliente" name="cliente" method="post" action="">
            <!-- dados do cliente -->
            <label for="id">Código</label>
            <input class="form-control"name="id" type="text" readonly="true" id="id" value="<?php echo $item_excluir[id]; ?>" />
            <label for="nome">Nome</label>
            <input class="form-control"required type="text" readonly="true" name="nome" id="nome" value="<?php echo $item_excluir[nome]; ?>"/>
            <label for="cpf">CPF</label>
            <input class="form-control"required id="cpf" readonly="true" name="cpf" type="text" value="<?php echo $item_excluir[cpf]; ?>" title="Qual seu CPF?" maxlength="14" title="Digite o CPF somente numeros">
            <label for="dtNascimento">Data Nascimento</label>
            <input class="form-control"required id="dtNascimento" readonly="true" name="dtNascimento" value="<?php echo $item_excluir[dtNascimento]; ?>" type="date" title="Qual sua Data de Nascimento?" maxlength="14">
            <label for="telefone">Telefone</label>
            <input class="form-control" id="telefone" name="telefone" readonly="true" type="text" value="<?php echo $item_excluir[telefone]; ?>" title="Qual seu telefone?" maxlength="14">
            <!-- input oculto para informar o id do cliente-->
            <input type="hidden" value="<?php echo $item_excluir[id]; ?>" >
            </br>
            <!-- botao para submeter o formulário -->
            <button id="enviar" type="submit" name="excluir"  class="btn btn-danger btn-lg" style="width: 100%;"><span class="glyphicon glyphicon-ok-sign"></span>Excluir</button>
        </form>
    </fieldset>
<?php } ?>
