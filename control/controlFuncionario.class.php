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
 * Criado em 01/01/2015
 * Classe de controle do funcionario
 * @author Sérgio Lima (professor.sergiolima@gmail.com)
 * @version 1.0.0
 */
class ControlFuncionario extends ControlGeral
{

    /**
     * Método utilizado para validar os dados dos funcionarios cadastrados e invocar o método consultarFuncionario no model
     * @access public 
     * @param Int    $id   id do funcionario
     * @param String $nome nome do funcionario
     * @return Array dados do funcionario
     */
    function consultar($arrFuncionario = null) 
    {

        $objFuncionario = new ModelFuncionario();
        $arrFuncionario['cpf_funcionario']=$this->limpaCPF_CNPJ($arrFuncionario['cpf_funcionario']);
        return $listaFuncionario = $objFuncionario->consultar($arrFuncionario);
    }

    /**
     * Método utilizado validar os dados dos funcionarios cadastrados e invocar o método inserirFuncionario no model
     * @access public 
     * @param array do dados do funcionario
     * @return Boolean retorna TRUE se os dados forem salvos com sucesso
     */
    function inserir($dadosFuncionario) 
    {

        // invocar métódo  e passar parâmetros
        $objFuncionario = new ModelFuncionario();

        // tratar a data de nascimento
        $dadosFuncionario['dtNascimento'] = $this->dataAmericano(str_replace("/", "-", $dadosFuncionario['dtNascimento']));


        // se for válido invocar o método de iserir
        if ($objFuncionario->inserirFuncionario($dadosFuncionario) == true) {
            // se for inserido com sucesso mostrar a mensagem
            $_SESSION['msg'] = "Inserido com sucesso!";
            // redirecionar
            header("location: ../view/modulo.php?modulo=funcionario&menu=consultar");
        } else {
            $_SESSION['msg'] = "Erro ao inserir!";

        }
    }
    //
    //    /**
    //     * Método utilizado validar os dados dos funcionarios e invocar o método alterarFuncionario no model
    //     * @access public
    //     * @param Int $id id do funcionario
    //     * @param String $nome nome do funcionario
    //     * @param String $cpf CPF do funcionario
    //     * @param String $dtNascimento data de nascimento do funcionario
    //     * @param String $telefone telefone do funcionario
    //     * @return Boolean retorna TRUE se os dados forem salvos com sucesso
    //     */
    //    function alterar($dadosFuncionario) {
    //
    //        #invocar métódo  e passar parâmetros
    //        $objFuncionario = new ModelFuncionario();
    //        $objCidade = new ModelCidade();
    //
    //        $dadosFuncionario['dtNascimento'] = $this->dataAmericano(str_replace("/","-",$dadosFuncionario['dtNascimento'] ));
    //        if ($objFuncionario->alterarFuncionario($dadosFuncionario) == true) {
    //            #se for alterado com sucesso mostrar a mensagem
    //            $_SESSION['msg'] = "Alterado com sucesso!";
    //            #redirecionar
    //            header("location: ../view/modulo.php?modulo=funcionario&menu=consultar");
    //        } else {
    //            $_SESSION['msg'] = "Erro ao alterar!";
    //            #redirecionar
    //            header("location: ../view/modulo.php?modulo=funcionario&menu=consultar");
    //        }
    //    }
    //
    //    function alterarSenha($dadosSenha) {
    //
    //        #invocar métódo  e passar parâmetros
    //        $objFuncionario = new ModelFuncionario();
    //
    //
    //        $id_funcionario = $dadosSenha['id_funcionario'];
    //        $senhaAntiga = sha1($dadosSenha['senhaAntiga']);
    //        $senha = sha1($dadosSenha['senha']);
    //        $validaSenha = $objFuncionario->verificaSenha($senhaAntiga,$id_funcionario);
    //        if($validaSenha['existe']== 0){
    //            $_SESSION['msg'] = "Senha Antiga Incorreta!";
    //            return false;
    //        }
    //
    //        if ($objFuncionario->alterarSenha($senha,$id_funcionario) == true) {
    //            #se for alterado com sucesso mostrar a mensagem
    //            $_SESSION['msg'] = "Alterado com sucesso!";
    //            #redirecionar
    //            header("location: ../view/modulo.php?modulo=principal");
    //        } else {
    //            $_SESSION['msg'] = "Erro ao alterar!";
    //            #redirecionar
    //            header("location: ../view/modulo.php?modulo=principal");
    //        }
    //    }
    //
    //    /**
    //     * Método utilizado para validar os dados dos funcionarios e invocar o método excluirFuncionario no model
    //     * @access public
    //     * @param Int $id id do funcionario
    //     * @return Boolean retorna TRUE se os dados for excluído sucesso
    //     */
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
}
