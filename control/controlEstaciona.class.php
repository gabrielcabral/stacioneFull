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
 * Classe de controle do funcionario
 * @author Sérgio Lima (professor.sergiolima@gmail.com)
 * @version 1.0.0
 */
class ControlEstaciona extends ControlGeral {

    /**
     * Método utilizado para validar os dados dos funcionarios cadastrados e invocar o método consultarFuncionario no model
     * @access public 
     * @param Int $id id do funcionario
     * @param String $nome nome do funcionario
     * @return Array dados do funcionario
     */
    function consultar($arrEntrada = null) {

        $objEntrada = new ModelEstaciona();
        $arrEntrada['entrada'] = $this->dataAmericano($arrEntrada['entrada']);
        $arrEntrada['saida'] = $this->dataAmericano($arrEntrada['saida']);
        return $listaEntrada = $objEntrada->consultar($arrEntrada);
    }
    /**
     * Método utilizado para validar os dados dos funcionarios cadastrados e invocar o método consultarFuncionario no model
     * @access public
     * @param Int $id id do funcionario
     * @param String $nome nome do funcionario
     * @return Array dados do funcionario
     */
    function consultarParaPagamento($arrEntrada = null) {

        $objEntrada = new ModelEstaciona();
        return $listaEntrada = $objEntrada->consultarParaPagamento($arrEntrada);
    }

    /**
     * Método utilizado para validar os dados dos funcionarios cadastrados e invocar o método consultarFuncionario no model
     * @access public
     * @param Int $id id do funcionario
     * @param String $nome nome do funcionario
     * @return Array dados do funcionario
     */
    function consultarVeiculos() {

        $objveiculo = new ModelEstaciona();
        return $listaEntrada = $objveiculo->consultarVeiculo();
    }

    /**
     * Método utilizado para validar os dados dos funcionarios cadastrados e invocar o método consultarFuncionario no model
     * @access public
     * @param Int $id id do funcionario
     * @param String $nome nome do funcionario
     * @return Array dados do funcionario
     */
    function consultarVagas() {

        $objveiculo = new ModelEstaciona();
        return $listaEntrada = $objveiculo->consultarVagas();

    }
    /**
     * Método utilizado para validar os dados dos funcionarios cadastrados e invocar o método consultarFuncionario no model
     * @access public
     * @param Int $id id do funcionario
     * @param String $nome nome do funcionario
     * @return Array dados do funcionario
     */
    function consultarPreco() {

        $objEstaciona = new ModelEstaciona();
        return $listaEntrada = $objEstaciona->consultarPreco();

    }

    /**
     * Método utilizado para validar os dados dos funcionarios cadastrados e invocar o método consultarFuncionario no model
     * @access public
     * @param Int $id id do funcionario
     * @param String $nome nome do funcionario
     * @return Array dados do funcionario
     */
    function alterarVaga($arrVaga) {

        $objEntrada = new ModelEstaciona();

        #se for válido invocar o método de iserir
        if ($objEntrada->alteraVaga($arrVaga) == true) {
            #se for inserido com sucesso mostrar a mensagem
            $_SESSION['msg'] = "Alterado com sucesso!";
            $_SESSION['tipoMsg'] = 2;
            #redirecionar
            header("location: ../view/modulo.php?modulo=vaga&menu=alterar");
        } else {
            $_SESSION['msg'] = "Erro ao inserir!";
            $_SESSION['tipoMsg'] = 0;
            #redirecionar
            header("location: ../view/modulo.php?modulo=vaga&menu=alterar");
        }

    }
    function alterarPreco($arrVaga) {

        $objEntrada = new ModelEstaciona();

        #se for válido invocar o método de iserir
        if ($objEntrada->alterarPreco($arrVaga) == true) {
            #se for inserido com sucesso mostrar a mensagem
            $_SESSION['msg'] = "Alterado com sucesso!";
            $_SESSION['tipoMsg'] = 2;
            #redirecionar
            header("location: ../view/modulo.php?modulo=preco&menu=alterar");
        } else {
            $_SESSION['msg'] = "Erro ao alterar!";
            $_SESSION['tipoMsg'] = 0;
            #redirecionar
            header("location: ../view/modulo.php?modulo=preco&menu=alterar");
        }

    }



    /**
     * Método utilizado validar os dados dos funcionarios cadastrados e invocar o método inserirFuncionario no model
     * @access public
     * @param String $nome nome do funcionario
     * @param String $cpf CPF do funcionario
     * @param String $dtNascimento data de nascimento do funcionario
     * @param String $telefone telefone do funcionario
     * @return Boolean retorna TRUE se os dados forem salvos com sucesso
     */
   function inserir($dadosEntrada) {

        #invocar métódo  e passar parâmetros
        $objEntrada = new ModelEstaciona();
        $objImagem = new ModelImagem();
        $idImagem =  $objImagem->consultar();
       $dadosEntrada['id_imagem']=$idImagem['id_imagem'];
        #se for válido invocar o método de iserir
        if ($objEntrada->inserirEntrada($dadosEntrada) == true) {
            #se for inserido com sucesso mostrar a mensagem
            $_SESSION['msg'] = "Inserido com sucesso!";
            $_SESSION['tipoMsg'] = 2;
            #redirecionar
            header("location: ../view/modulo.php?modulo.php?modulo=principal");
        } else {
            $_SESSION['msg'] = "Erro ao inserir!";
            $_SESSION['tipoMsg'] = 0;
            #redirecionar
            header("location: ../view/modulo.php?modulo=entrada&menu=inserir");
        }
    }

    /**
     * Método utilizado validar os dados dos funcionarios cadastrados e invocar o método inserirFuncionario no model
     * @access public
     * @param String $nome nome do funcionario
     * @param String $cpf CPF do funcionario
     * @param String $dtNascimento data de nascimento do funcionario
     * @param String $telefone telefone do funcionario
     * @return Boolean retorna TRUE se os dados forem salvos com sucesso
     */
    /*function inserirImagem($dadosFuncionario) {

        #invocar métódo  e passar parâmetros
        $objFuncionario = new ModelFuncionario();

        $tpPerfil= $dadosFuncionario['tpPerfil'];
        #tratar a data de nascimento
        $dtNascimento = $this->dataAmericano(str_replace("/","-",$dtNascimento));


        #se for válido invocar o método de iserir
        if ($objFuncionario->inserirFuncionario($nome, $cpf, $dtNascimento, $telefone,$senha,$tpPerfil,$id_cidade) == true) {
            #se for inserido com sucesso mostrar a mensagem
            $_SESSION['msg'] = "Inserido com sucesso!";
            #redirecionar
            header("location: ../view/modulo.php?modulo=funcionario&menu=consultar");
        } else {
            $_SESSION['msg'] = "Erro ao inserir!";
            #redirecionar
            header("location: ../view/modulo.php?modulo=funcionario&menu=consultar");
        }
    }*/

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
    function delete($id) {

        #invocar métódo  e passar parâmetros
        $objFuncionario = new ModelFuncionario();

        #invocar métódo  e passar parâmetros
        if ($objFuncionario->excluirFuncionario($id) == true) {
            #se for excluído com sucesso mostrar a mensagem e redirecionar
            $_SESSION['msg'] = "Excluído com sucesso!";
            $_SESSION['tipoMsg'] = 2;
            header("location: ../view/modulo.php?modulo=funcionario&menu=consultar");
        } else {
            $_SESSION['msg'] = "Erro ao excluir!";
            $_SESSION['tipoMsg'] = 0;
            header("location: ../view/modulo.php?modulo=funcionario&menu=consultar");
        }
    }


    function saida($id) {

        #invocar métódo  e passar parâmetros
        $objsaida = new ModelEstaciona();

        #invocar métódo  e passar parâmetros
        if ($objsaida->saida($id) == true) {
            #se for excluído com sucesso mostrar a mensagem e redirecionar
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
