<?php
#método para selecionar o cliente desejado
$clientes_alterar = $cc->consultar($item[id], null);

#verificar se o botão "alterar" foi acionado
if (isset($_POST["alterar"])) {
    #passa os novos dados do cliente para o controle realizar a alteração
    $cc->alterar($_POST["id"], $_POST["nome"], $_POST["cpf"], $_POST["dtNascimento"], $_POST["telefone"]);
    #mostrar dados do cliente selecionado depois de alterado
    $clientes = $cc->consultar($_POST["id"], null);
}

#mostrar os dados do cliente
foreach ($clientes_alterar as $item_alterar) {
    ?>
    <fieldset>
        <form method="post" action="">
            <!-- dados do cliente -->
            <label for="id">Código</label>
            <input class="form-control" name="id" type="text" readonly="true" id="id" value="<?php echo $item_alterar[id]; ?>" />
            <label for="nome">Nome</label>
            <input class="form-control"required type="text" name="nome" id="nome" value="<?php echo $item_alterar[nome]; ?>"/>
            <label for="cpf">CPF</label>
            <input class="form-control"required id="cpf" name="cpf" type="text" value="<?php echo $item_alterar[cpf]; ?>" title="Qual seu CPF?" maxlength="14" title="Digite o CPF somente numeros">
            <label for="dtNascimento">Data Nascimento</label>
            <input class="form-control"required id="dtNascimento" name="dtNascimento" value="<?php echo $item_alterar[dtNascimento]; ?>" type="date" title="Qual sua Data de Nascimento?" maxlength="14">
            <label for="telefone">Telefone</label>
            <input class="form-control" id="telefone" name="telefone" type="text" value="<?php echo $item_alterar[telefone]; ?>" title="Qual seu telefone?" maxlength="14">
            </br>
            <!-- input oculto para informar o id do cliente-->
            <input type="hidden" value="<?php echo $item_alterar[id]; ?>" >
            <!-- botao para submeter o formulário --> 
            <button type="submit" name="alterar" class="btn btn-warning btn-lg" style="width: 100%;"><span class="glyphicon glyphicon-ok-sign"></span>Alterar</button>
        </form>
    </fieldset>
    <?php
}
?>
