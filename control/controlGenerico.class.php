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
 * Criado em <data>
 * Classe de <breve descrição da classe>
 * @author <nome do autor(e-mail)>
 * @version <versao>
 */
class ControlGenerico extends ControlGeral {

    /**
     * Método utilizado para <descrição do método>
     * @access public 
     * @param <parametros>
     * @return <tipo de retorno>
     */
    function consultar($parametros) {

        #invocar métódo  e passar parâmetros
        $obj = new ModelNomedaclasse();
        return $lista = $obj->consultar($parametros);
    }

    /**
     * Método utilizado para <descrição do método>
     * @access public 
     * @param <parametros>
     * @return <tipo de retorno>
     */
    function inserir($parametros) {

        #invocar métódo  e passar parâmetros
        $obj = new ModelNomedaclasse();

        #se for válido invocar o método de iserir
        if ($obj->inserir($parametros) == true) {
            #se for inserido com sucesso mostrar a mensagem
            $_SESSION['msg'] = "Inserido com sucesso!";
            #redirecionar
            header("location: ../view/modulo.php?modulo=<nome do modulo>&menu=<nome do menu>");
        } else {
            $_SESSION['msg'] = "Erro ao inserir!";
            #redirecionar
            header("location: ../view/modulo.php?modulo=<nome do modulo>&menu=<nome do menu>");
        }
    }

    /**
     * Método utilizado para <descrição do método>
     * @access public 
     * @param <parametros>
     * @return <tipo de retorno>
     */
    function alterar($id_tabela, $parametros) {

        #invocar métódo  e passar parâmetros
        $obj = new ModelNomedaclasse();

        if ($obj->alterar($id_tabela, $parametros) == true) {
            #se for alterado com sucesso mostrar a mensagem
            $_SESSION['msg'] = "Alterado com sucesso!";
            #redirecionar
            header("location: ../view/modulo.php?modulo=<nome do modulo>&menu=<nome do menu>");
        } else {
            $_SESSION['msg'] = "Erro ao alterar!";
            #redirecionar
            header("location: ../view/modulo.php?modulo=<nome do modulo>&menu=<nome do menu>");
        }
    }

    /**
     * Método utilizado para validar os dados dos usuarios e invocar o método excluirUsuario no model
     * @access public 
     * @param Int $id id do usuario
     * @return Boolean retorna TRUE se os dados for excluído sucesso
     */
    function excluir($id_tabela) {

        #invocar métódo  e passar parâmetros
        $obj = new ModelNomedaclasse();

        #invocar métódo  e passar parâmetros
        if ($obj->excluir($id_tabela) == true) {
            #se for excluído com sucesso mostrar a mensagem e redirecionar
            $_SESSION['msg'] = "Excluído com sucesso!";
            header("location: ../view/modulo.php?modulo=<nome do modulo>&menu=<nome do menu>");
        } else {
            $_SESSION['msg'] = "Erro ao excluir!";
            header("location: ../view/modulo.php?modulo=<nome do modulo>&menu=<nome do menu>");
        }
    }

} 
