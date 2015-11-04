<?php
#iniciar_sessao
session_start();

#carregar as classes dinamicamente
include_once 'autoload.php';

#função para resolver problema de header
ob_start();

#define codificação
header('Content-Type: text/html; charset=UTF-8');

/**
 * Criado em 01/01/2015
 * Classe de controle do cliente
 * @author Sérgio Lima (professor.sergiolima@gmail.com)
 * @version 1.0.0
 */
class ControlCliente extends ControlGeral {

    /**
     * Método utilizado para validar os dados dos clientes cadastrados e invocar o método consultarCliente no model
     * @access public 
     * @param Int $id id do cliente
     * @param String $nome nome do cliente
     * @return Array dados do cliente
     */
    function consultar($id, $nome) {

        $objCliente = new ModelCliente();
        return $listaCliente = $objCliente->consultarCliente($id, $nome);
    }

    /**
     * Método utilizado validar os dados dos clientes cadastrados e invocar o método inserirCliente no model
     * @access public 
     * @param String $nome nome do cliente
     * @param String $cpf CPF do cliente
     * @param String $dtNascimento data de nascimento do cliente
     * @param String $telefone telefone do cliente
     * @return Boolean retorna TRUE se os dados forem salvos com sucesso
     */
    function inserir($nome, $cpf, $dtNascimento, $telefone) {

        #invocar métódo  e passar parâmetros
        $objCliente = new ModelCliente();

        #tratar a data de nascimento
        $dtNascimento = $this->dataAmericano($dtNascimento);

        #se for válido invocar o método de iserir
        if ($objCliente->inserirCliente($nome, $cpf, $dtNascimento, $telefone) == true) {
            #se for inserido com sucesso mostrar a mensagem
            $_SESSION['msg'] = "Inserido com sucesso!";
            #redirecionar
            header("location: ../view/modulo.php?modulo=cliente&menu=consultar");
        } else {
            $_SESSION['msg'] = "Erro ao inserir!";
            #redirecionar
            header("location: ../view/modulo.php?modulo=cliente&menu=consultar");
        }
    }

    /**
     * Método utilizado validar os dados dos clientes e invocar o método alterarCliente no model
     * @access public 
     * @param Int $id id do cliente
     * @param String $nome nome do cliente
     * @param String $cpf CPF do cliente
     * @param String $dtNascimento data de nascimento do cliente
     * @param String $telefone telefone do cliente
     * @return Boolean retorna TRUE se os dados forem salvos com sucesso
     */
    function alterar($id, $nome, $cpf, $dtNascimento, $telefone) {

        #invocar métódo  e passar parâmetros
        $objCliente = new ModelCliente();

        if ($objCliente->alterarCliente($id, $nome, $cpf, $dtNascimento, $telefone) == true) {
            #se for alterado com sucesso mostrar a mensagem
            $_SESSION['msg'] = "Alterado com sucesso!";
            #redirecionar
            header("location: ../view/modulo.php?modulo=cliente&menu=consultar");
        } else {
            $_SESSION['msg'] = "Erro ao alterar!";
            #redirecionar
            header("location: ../view/modulo.php?modulo=cliente&menu=consultar");
        }
    }

    /**
     * Método utilizado para validar os dados dos clientes e invocar o método excluirCliente no model
     * @access public 
     * @param Int $id id do cliente
     * @return Boolean retorna TRUE se os dados for excluído sucesso
     */
    function excluir($id) {

        #invocar métódo  e passar parâmetros
        $objCliente = new ModelCliente();

        #invocar métódo  e passar parâmetros
        if ($objCliente->excluirCliente($id) == true) {
            #se for excluído com sucesso mostrar a mensagem e redirecionar
            $_SESSION['msg'] = "Excluído com sucesso!";
            header("location: ../view/modulo.php?modulo=cliente&menu=consultar");
        } else {
            $_SESSION['msg'] = "Erro ao excluir!";
            header("location: ../view/modulo.php?modulo=cliente&menu=consultar");
        }
    }
}
