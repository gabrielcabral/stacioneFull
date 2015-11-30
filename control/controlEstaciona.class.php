<?php
// iniciar_sessao
session_start();
// carregar as classes dinamicamente
require_once 'autoload.php';
// função para resolver problema de header
ob_start();
// define codificação
header('Content-Type: text/html; charset=UTF-8');

/**
 * Criado em 18/11/2015
 * Classe de controle de entrada e saida de veiculos
 * @author gabriel cabral de almeida
 * @version 1.0.0
 */
class ControlEstaciona extends ControlGeral
{

    /**
     * Método utilizado para validar os dados cadastrados e invocar o método consultar no model
     * @access public 
     * @array arrEntrada
     * @return Array dados de entrada de veiculo
     */
    function consultar($arrEntrada = null) 
    {

        $objEntrada = new ModelEstaciona();
        $arrEntrada['entrada'] = $this->dataAmericano($arrEntrada['entrada']);
        $arrEntrada['saida'] = $this->dataAmericano($arrEntrada['saida']);
        return $listaEntrada = $objEntrada->consultar($arrEntrada);
    }
    /**
     * Método utilizado para validar os dados cadastrados e invocar o método consultarParaPagamento no model
     * @access public
     * @array arrEntrada
     * @return Array
     */
    function consultarParaPagamento($arrEntrada = null) 
    {
        $objEntrada = new ModelEstaciona();
        return $listaEntrada = $objEntrada->consultarParaPagamento($arrEntrada);
    }
    /**
     * Método utilizado para validar os dados cadastrados e invocar o método consultarVeiculo no model
     * @access public
     * @return Array
     */
    function consultarVeiculos() 
    {
        $objveiculo = new ModelEstaciona();
        return $listaEntrada = $objveiculo->consultarVeiculo();
    }
    /**
     * Método utilizado para validar os dados cadastrados e invocar o método consultarVagas no model
     * @access public
     * @return Array
     */
    function consultarVagas() 
    {
        $objveiculo = new ModelEstaciona();
        return $listaEntrada = $objveiculo->consultarVagas();
    }
    /**
     * Método utilizado para validar os dados cadastrados e invocar o método consultarPreco no model
     * @access public
     * @return Array
     */
    function consultarPreco() 
    {
        $objEstaciona = new ModelEstaciona();
        return $listaEntrada = $objEstaciona->consultarPreco();
    }

    /**
     * Método utilizado para validar os dados cadastrados e invocar o método alteraVaga no model
     * @param $arrVaga
     * @access public
     * @return Array
     */
    function alterarVaga($arrVaga) 
    {
        $objEntrada = new ModelEstaciona();
        // se for válido invocar o método de iserir
        if ($objEntrada->alteraVaga($arrVaga) == true) {
            // se for inserido com sucesso mostrar a mensagem
            $_SESSION['msg'] = "Alterado com sucesso!";
            $_SESSION['tipoMsg'] = 2;
            // redirecionar
            header("location: ../view/modulo.php?modulo=vaga&menu=alterar");
        } else {
            $_SESSION['msg'] = "Erro ao inserir!";
            $_SESSION['tipoMsg'] = 0;
            // redirecionar
            header("location: ../view/modulo.php?modulo=vaga&menu=alterar");
        }
    }

    /**
     * Método utilizado para validar os dados cadastrados e invocar o método alteraVaga no model
     * @param $arrPreco
     * @access public
     * @return Array
     */
    function alterarPreco($arrPreco)
    {
        $objEntrada = new ModelEstaciona();
        // se for válido invocar o método de iserir
        if ($objEntrada->alterarPreco($arrPreco) == true) {
            // se for inserido com sucesso mostrar a mensagem
            $_SESSION['msg'] = "Alterado com sucesso!";
            $_SESSION['tipoMsg'] = 2;
            // redirecionar
            header("location: ../view/modulo.php?modulo=preco&menu=alterar");
        } else {
            $_SESSION['msg'] = "Erro ao alterar!";
            $_SESSION['tipoMsg'] = 0;
            // redirecionar
            header("location: ../view/modulo.php?modulo=preco&menu=alterar");
        }
    }
    /**
     * Método utilizado validar os dados  cadastrados e invocar o método inserirEntrada no model
     * @access public
     * @param Array $dadosEntrada
     * @return Boolean retorna TRUE se os dados forem salvos com sucesso
     */
    function inserir($dadosEntrada) 
    {

        // invocar métódo  e passar parâmetros
        $objEntrada = new ModelEstaciona();
        $objImagem = new ModelImagem();
        $idImagem =  $objImagem->consultar();
        $dadosEntrada['id_imagem']=$idImagem['id_imagem'];
        // se for válido invocar o método de iserir
        if ($objEntrada->inserirEntrada($dadosEntrada) == true) {
            // se for inserido com sucesso mostrar a mensagem
            $_SESSION['msg'] = "Registrado com sucesso! ";
            $_SESSION['tipoMsg'] = 2;
            // redirecionar
            header("location: ../view/modulo.php?modulo.php?modulo=principal");
        } else {
            $_SESSION['msg'] = "Erro ao inserir!";
            $_SESSION['tipoMsg'] = 0;
            // redirecionar
            header("location: ../view/modulo.php?modulo=entrada&menu=inserir");
        }
    }

    /**
     * Método utilizado validar os dados  cadastrados e invocar o método inserirPagamento no model
     * @access public
     * @param Array $arrPagamento
     * @return Boolean retorna TRUE se os dados forem salvos com sucesso
     */
    function efetuarPagamento($arrPagamento) {
        //invocar métódo  e passar parâmetros
        $objEntrada = new ModelEstaciona();
        #se for válido invocar o método de iserir
        if ($objEntrada->inserirPagamento($arrPagamento) == true) {
            #se for inserido com sucesso mostrar a mensagem
            $_SESSION['msg'] = "Pagamento efetuado com sucesso!";
            $_SESSION['tipoMsg'] = 2;
            #redirecionar
            header("location: ../view/modulo.php?modulo=principal");
        } else {
            $_SESSION['msg'] = "Erro ao efetuar O pagamento!";
            $_SESSION['tipoMsg'] = 0;
            #redirecionar
            header("location: ../view/modulo.php?modulo=pagamento&menu=efetuar&id=".$arrPagamento['ID_ENTRADA_SAIDA']);
        }
    }

    /**
     * Método utilizado para invocar o método excluirFuncionario no model
     * @access public
     * @param $id
     * @return Boolean retorna TRUE se os dados forem salvos com sucesso
     */
    function delete($id)
    {
        // invocar métódo  e passar parâmetros
        $objFuncionario = new ModelFuncionario();
        // invocar métódo  e passar parâmetros
        if ($objFuncionario->excluirFuncionario($id) == true) {
            // se for excluído com sucesso mostrar a mensagem e redirecionar
            $_SESSION['msg'] = "Excluído com sucesso!";
            $_SESSION['tipoMsg'] = 2;
            header("location: ../view/modulo.php?modulo=funcionario&menu=consultar");
        } else {
            $_SESSION['msg'] = "Erro ao excluir!";
            $_SESSION['tipoMsg'] = 0;
            header("location: ../view/modulo.php?modulo=funcionario&menu=consultar");
        }
    }
    /**
     * Método utilizado para invocar o método saida no model
     * @access public
     * @param $id
     * @return Boolean retorna TRUE se os dados forem salvos com sucesso
     */
    function saida($id)
    {
        $objsaida = new ModelEstaciona();
        if ($objsaida->saida($id) == true) {
            // se for excluído com sucesso mostrar a mensagem e redirecionar
            $_SESSION['msg'] = "Saida efetuada com sucesso!";
            $_SESSION['tipoMsg'] = 2;
            header("location: ../view/modulo.php?modulo=pagamento&menu=efetuar&id=".$id);
        } else {
            $_SESSION['msg'] = "Erro ao dar a saida!";
            $_SESSION['tipoMsg'] = 0;
            header("location: ../view/modulo.php?modulo.php?modulo=principal");
        }
    }
}
