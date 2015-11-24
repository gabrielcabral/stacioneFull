<?php

// iniciar_sessao
//session_start();

// função para resolver problema de header
ob_start();

// define codificação
header('Content-Type: text/html; charset=UTF-8');

/**
 * Criado em 01/01/2015
 * Classe de controle geral
 * @author Sérgio Lima (professor.sergiolima@gmail.com)
 * @version 1.0.0
 */
class ControlGeral
{

    /**
     * Método utilizado para transforma para para o formato brasileiro
     * @access public 
     * @param Date $data data no formato americado (Y-m-d)
     * @return Date data no formato brasileiro (d/m/Y)
     */
    function dataBrasileiro($data) 
    {

        if ($data == null) {
            return '';
        } else {
            return date('d/m/Y', strtotime($data));
        }
    }

    /**
     * Método utilizado para transforma para para o formato americado
     * @access public 
     * @param Date $data data no formato brasileiro (d/m/Y) 
     * @return Date data no formato americano (Y-m-d)
     */
    function dataAmericano($data) 
    {

        if ($data == null) {
            return '';
        } else {
            return date('Y-m-d', strtotime($data));
        }
    }

    /**
     * Método utilizado para transforma para validar e-mail
     * @access public 
     * @param String $email e-mail a ser validado
     * @return Boolean retorna TRUE se o e-mail for válido
     */
    public static function validarEmail($email) 
    {
        return preg_match("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$^", $email);
    }

    /**
     * Método utilizado para mostrar mensagens do sistema
     * @access public 
     * @param String $msg mensagem a ser exibida
     */
    function alertaInfo($msg) 
    {
        $alerta = '';
        if (!empty($msg)) {
            $alerta = '<div class="alert alert-info"  data-fade="3000">';
            $alerta.='<button type="button" class="close" data-dismiss="alert">×</button>';
            $alerta.='<strong>Informação: </strong>' . $msg . '</div>';
            echo $alerta;
        }
        unset($_SESSION['msg']);
        unset($_SESSION['tipoMsg']);
    }
    /**
     * Método utilizado para mostrar mensagens do sistema
     * @access public
     * @param String $msg mensagem a ser exibida
     */
    function alertaError($msg) 
    {
        $alerta = '';
        if (!empty($msg)) {
            $alerta = '<div class="alert alert-danger"  data-fade="3000">';
            $alerta.='<button type="button" class="close" data-dismiss="alert">×</button>';
            $alerta.='<strong>Informação: </strong>' . $msg . '</div>';
            echo $alerta;
        }
        unset($_SESSION['msg']);
        unset($_SESSION['tipoMsg']);
    }
    /**
     * Método utilizado para mostrar mensagens do sistema
     * @access public
     * @param String $msg mensagem a ser exibida
     */
    function alertaSuccess($msg) 
    {
        $alerta = '';
        if (!empty($msg)) {
            $alerta = '<div class="alert alert-success"  data-fade="3000">';
            $alerta.='<button type="button" class="close" data-dismiss="alert" >×</button>';
            $alerta.='<strong>Informação: </strong>' . $msg . '</div>';
            echo $alerta;
        }
        unset($_SESSION['msg']);
        unset($_SESSION['tipoMsg']);
    }
    /**
     * Método utilizado para mostrar mensagens do sistema
     * @access public
     * @param String $msg mensagem a ser exibida
     */


    function mascara($val, $mask)
    {
        $maskared = '';
        $k = 0;
        for($i = 0; $i<=strlen($mask)-1; $i++)
        {
            if($mask[$i] == '#') {
                if(isset($val[$k])) {
                    $maskared .= $val[$k++]; 
                }
            }
            else
            {
                if(isset($mask[$i])) {
                    $maskared .= $mask[$i]; 
                }
            }
        }
        return $maskared;
    }


    /**
     * @param $strValor
     * @return mixed|string
     */
    public function limpaCPF_CNPJ($strValor)
    {
        $strValor = trim($strValor);
        $strValor = str_replace(".", "", $strValor);
        $strValor = str_replace(",", "", $strValor);
        $strValor = str_replace("-", "", $strValor);
        $strValor = str_replace("/", "", $strValor);
        return $strValor;
    }




    /**
     * Método utilizado para mostrar o menu do sistema
     * @access public 
     * @param String $nomeSistema nome do sistema a ser exibido
     */
    function menu($nomeSistema = 'Stacione') 
    {
        echo' <nav class="navbar-default navbar-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav" id="main-menu">
            <li class="text-center">
                <img src="../bootstrap/img/logo.JPG" class="user-image img-responsive"/>
            </li>
           <li>
                <a class="active-menu"  href="modulo.php?modulo=principal"><i class="fa fa-dashboard fa-2x"></i> Inicio</a>
            </li>
             <li>
                <a href="#"><i class="fa fa-user fa-2x"></i> Funcionário<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="modulo.php?modulo=funcionario&menu=consultar">Consultar</a>
                    </li>
                    <li>
                        <a href="modulo.php?modulo=funcionario&menu=inserir">Inserir</a>
                    </li>
                </ul>
            </li>
            <li>
                 <a href="#"><i class="fa fa-car fa-2x"></i> Veículos<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="modulo.php?modulo=veiculo&menu=consultar">Consultar</a>
                    </li>
                   <!-- <li>
                        <a href="modulo.php?modulo=veiculo&menu=inserir">Inserir</a>
                    </li>-->
                </ul>
            </li>
            <li>
                <a  href="modulo.php?modulo=preco&menu=alterar"><i class="fa fa-usd fa-2x"></i>Tabela de Preços</a>
            </li>
            <li>
                <a  href="modulo.php?modulo=vaga&menu=alterar"><i class="fa fa-battery-full fa-2x"></i>Vagas</a>
            </li>



          <li  >
                <a  href="modulo.php?modulo=relatorio&menu=consultar"><i class="fa fa-line-chart fa-2x"></i> Relatório</a>
            </li>
           <li>
                  <a class="menu"  href="modulo.php?modulo=funcionario&menu=alterarSenha"><i class="fa fa-bolt fa-2x"></i> Aletrar Senha</a>
           </li>

            <li  >
                <a  href="../logoff.php"><i class="fa fa-power-off fa-2x"></i> Sair</a>
            </li>
        </ul>
    </div>
</nav>';
    }

    /**
     *
     */
    function topo()
    {
        echo '<nav class="navbar navbar-default navbar-cls-top " role="navigation" style="margin-bottom: 0">
                <div class="navbar-header">

                    <a class="navbar-brand" href="index.html">Stacione</a>
                </div>
                <div style="color: white;
        padding: 15px 50px 5px 50px;
        float: right;
        font-size: 16px;">Usuário logado '.$_SESSION["UsuarioNome"] .' no dia  '. date("d/m/Y").' </div>
            </nav>';
    }




}
