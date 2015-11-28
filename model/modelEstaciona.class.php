<?php

// inclui arquivo da classe de conexão
require_once '../model/modelConexao.class.php';


/**
 * Criado em 01/08/2015
 * Classe de  Estaciona
 * @author gabriel cabral de almeida
 * @version 1.0.0
 */
class ModelEstaciona extends ModelConexao
{

    /**
     * Atributos da classe
     */
    /**
     * @var  $id_entrada_saida
     */
    private $id_entrada_saida;
    /**
     * @var $entrada
     */
    private $entrada;
    /**
     * @var $saida
     */
    private $saida;
    /**
     * @var $id_funcionario
     */
    private $id_funcionario;
    /**
     * @var  $id_veiculo
     */
    private $id_veiculo;
    /**
     * @var $id_imagem
     */
    private $id_imagem;
    /**
     * @var $placa
     */
    private $placa;

    /**
     * @return mixed
     */
    public function getIdEntradaSaida()
    {
        return $this->id_entrada_saida;
    }

    /**
     * @param mixed $id_entrada_saida
     */
    public function setIdEntradaSaida($id_entrada_saida)
    {
        $this->id_entrada_saida = $id_entrada_saida;
    }

    /**
     * @return mixed
     */
    public function getEntrada()
    {
        return $this->entrada;
    }

    /**
     * @param mixed $entrada
     */
    public function setEntrada($entrada)
    {
        $this->entrada = $entrada;
    }

    /**
     * @return mixed
     */
    public function getSaida()
    {
        return $this->saida;
    }

    /**
     * @param mixed $saida
     */
    public function setSaida($saida)
    {
        $this->saida = $saida;
    }

    /**
     * @return mixed
     */
    public function getIdFuncionario()
    {
        return $this->id_funcionario;
    }

    /**
     * @param mixed $id_funcionario
     */
    public function setIdFuncionario($id_funcionario)
    {
        $this->id_funcionario = $id_funcionario;
    }

    /**
     * @return mixed
     */
    public function getIdVeiculo()
    {
        return $this->id_veiculo;
    }

    /**
     * @param mixed $id_veiculo
     */
    public function setIdVeiculo($id_veiculo)
    {
        $this->id_veiculo = $id_veiculo;
    }

    /**
     * @return mixed
     */
    public function getIdImagem()
    {
        return $this->id_imagem;
    }

    /**
     * @param mixed $id_imagem
     */
    public function setIdImagem($id_imagem)
    {
        $this->id_imagem = $id_imagem;
    }

    /**
     * @return mixed
     */
    public function getPlaca()
    {
        return $this->placa;
    }

    /**
     * @param mixed $placa
     */
    public function setPlaca($placa)
    {
        $this->placa = $placa;
    }


    /**
     * Método utilizado para consultar a entrada cadastrados
     * @access public 
     * @param Int
     * @param String
     * @return Array dados do entrada
     */
    public function consultar($arrEntrada) 
    {

        // setar os valores
        $this->setPlaca($arrEntrada['placa']);
        $this->setEntrada($arrEntrada['entrada']);
        $this->setIdEntradaSaida($arrEntrada['id']);
        // montar a consultar (whre 1 serve para selecionar todos os registros)
        $sql = "SELECT
                    *
                FROM
                    tb_entrada_saida es
                INNER JOIN tb_veiculo v ON v.id_veiculo = es.ID_VEICULO
                INNER JOIN tb_fabricante f ON f.ID_fabricante = v.id_fabricante
                INNER JOIN tb_imagem i ON i.id_imagem = es.ID_IMAGEM
                WHERE
                    1 = 1
                   ";

        // verificar se foi passado algum valor de $id_funcionario    
        if ($this->getPlaca() != null) {
            $sql.= " and es.PLACA  =:placa";
        }
        // verificar se foi passado algum valor de $id_
        if ($this->getIdEntradaSaida() != null) {
            $sql.= " and es.ID_ENTRADA_SAIDA  =:id";
        }
        // verificar se foi passado algum valor de $id_funcionario
        if ($this->getEntrada() != null) {
            $sql.= " and es.ENTRADA BETWEEN :entrada and :saida";
        }

        $sql.= " and  es.SAIDA IS NULL ORDER By es.ENTRADA ASC ";
        // executa consulta e controi um array com o resultado da consulta
        try {
            $bd = $this->conectar();
            $query = $bd->prepare($sql);
            // verificar se foi passado algum valor de $id_funcionario
            if ($this->getPlaca() != null) {
                $query->bindValue(':placa', $this->getPlaca(), PDO::PARAM_STR);
            }
            // verificar se foi passado algum valor de $id_funcionario
            if ($this->getIdEntradaSaida() != null) {
                $query->bindValue(':id', $this->getIdEntradaSaida(), PDO::PARAM_INT);
            }
            // verificar se foi passado algum valor de $id_funcionario
            if ($this->getEntrada() != null) {
                $query->bindValue(':entrada', $this->getEntrada(), PDO::PARAM_STR);
                $query->bindValue(':saida', $this->getEntrada(), PDO::PARAM_STR);
            }
            $query->execute();

            $this->resultado = $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            $e->getMessage();

            $this->resultado = null;
        }
        return $this->resultado;
    }

    /**
     * Método utilizado para consultar os pagementos cadastrados
     * @access public
     * @param Array $arrEntrada
     * @return Array dados do pagamentos
     */
    public function consultarParaPagamento($arrEntrada) 
    {

        // setar os valores
        $this->setPlaca($arrEntrada['placa']);
        $this->setEntrada($arrEntrada['entrada']);
        $this->setIdEntradaSaida($arrEntrada['id']);
        // montar a consultar (whre 1 serve para selecionar todos os registros)
        $sql = "SELECT
                    *
                FROM
                    tb_entrada_saida es
                INNER JOIN tb_veiculo v ON v.id_veiculo = es.ID_VEICULO
                INNER JOIN tb_fabricante f ON f.ID_fabricante = v.id_fabricante
                WHERE TRUE
                   ";
        // verificar se foi passado algum valor de $id_
        if ($this->getIdEntradaSaida() != null) {
            $sql.= " and es.ID_ENTRADA_SAIDA  =:id";
        }
        // executa consulta e controi um array com o resultado da consulta
        try {
            $bd = $this->conectar();
            $query = $bd->prepare($sql);
            // verificar se foi passado algum valor de $id_funcionario
            if ($this->getIdEntradaSaida() != null) {
                $query->bindValue(':id', $this->getIdEntradaSaida(), PDO::PARAM_INT);
            }
            $query->execute();
            $this->resultado = $query->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            $e->getMessage();

            $this->resultado = null;
        }
        return $this->resultado;
    }
    /**
     * Método utilizado para consultar os veiculos cadastrados
     * @access public
     * @return Array dados do veiculos
     */
    public function consultarVeiculo() 
    {
        // montar a consultar (whre 1 serve para selecionar todos os registros)
        $sql = "SELECT
                 DISTINCT( veiculo ),id_veiculo
                FROM
                     tb_veiculo  ORDER BY  veiculo ASC ";

        // executa consulta e controi um array com o resultado da consulta
        try {
            $bd = $this->conectar();
            $query = $bd->prepare($sql);
            $query->execute();
            $this->resultado = $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            $e->getMessage();

            $this->resultado = null;
        }
        return $this->resultado;
    }
    /**
     * Método utilizado para consultar os vagas cadastrados
     * @access public
     * @return Array dados do vagas
     */
    public function consultarVagas() 
    {
        // montar a consultar (whre 1 serve para selecionar todos os registros)
        $sql = "SELECT
                *
                FROM
                     tb_vaga";

        // executa consulta e controi um array com o resultado da consulta
        try {
            $bd = $this->conectar();
            $query = $bd->prepare($sql);
            $query->execute();
            $this->resultado = $query->fetch();
        } catch (PDOException $e) {
            $e->getMessage();

            $this->resultado = null;
        }
        return $this->resultado;
    }
    /**
     * Método utilizado para consultar os preco cadastrados
     * @access public
     * @return Array dados do preco
     */
    public function consultarPreco() 
    {
        // montar a consultar (whre 1 serve para selecionar todos os registros)
        $sql = "SELECT * from tb_preco";

        // executa consulta e controi um array com o resultado da consulta
        try {
            $bd = $this->conectar();
            $query = $bd->prepare($sql);
            $query->execute();
            $this->resultado = $query->fetch();
        } catch (PDOException $e) {
            $e->getMessage();

            $this->resultado = null;
        }
        return $this->resultado;
    }
    /**
     * Método utilizado para inserir um entrada de veiculos
     * @access public 
     * @param Array $arrEntrada
     * @return Boolean retorna TRUE se os dados forem salvos com sucesso
     */
    function inserirEntrada($arrEntrada) 
    {

        // setar os valores
        $this->setIdFuncionario($_SESSION['UsuarioID']);
        $this->setIdVeiculo($arrEntrada['modelo']);
        $this->setIdImagem($arrEntrada['id_imagem']);
        $this->setPlaca(strtoupper($arrEntrada['placa']));

        // montar a consulta
        $sql = "INSERT INTO tb_entrada_saida (
                    PLACA,
                    ENTRADA,
                    ID_FUNCIONARIO,
                    ID_VEICULO,
                    ID_IMAGEM
                )
                VALUES
                    (
                        :PLACA,
                        CURRENT_TIMESTAMP,
                        :ID_FUNCIONARIO,
                        :ID_VEICULO,
                        :ID_IMAGEM
                    )";

        // realizar a blidagem dos dados
        try {
            $bd = $this->conectar();
            $query = $bd->prepare($sql);
            $query->bindValue(':PLACA', $this->getPlaca(), PDO::PARAM_STR);
            $query->bindValue(':ID_FUNCIONARIO', $this->getIdFuncionario(), PDO::PARAM_STR);
            $query->bindValue(':ID_VEICULO', $this->getIdVeiculo(), PDO::PARAM_STR);
            $query->bindValue(':ID_IMAGEM', $this->getIdImagem(), PDO::PARAM_STR);
            $query->execute();
            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }



    /**
     * Método utilizado para aletrar vagas
     * @access public
     * @param Array $arrVaga
     * @return Boolean retorna TRUE se os dados forem salvos com sucesso
     */
    public function alteraVaga($arrVaga)
    {

        $this->setIdFuncionario($_SESSION['UsuarioID']);
        // montar a consulta
        $sql = "UPDATE tb_vaga
                    SET
                    qt_vaga = ".$arrVaga['vaga'].",
                    dt_atualizacao = CURRENT_TIMESTAMP,
                    ID_FUNCIONARIO = :id_funcionario
                    WHERE
                    id_vaga = 1";

        // realizar a blidagem dos dados
        try {
            $bd = $this->conectar();
            $query = $bd->prepare($sql);
            $query->bindValue(':id_funcionario', $this->getIdFuncionario(), PDO::PARAM_INT);
            $query->execute();
            return true;
        } catch (PDOException $e) {
            $e->getMessage();
            return false;
        }
    }


    /**
     * Método utilizado para aletrar preco
     * @access public
     * @param Array $arrPreco
     * @return Boolean retorna TRUE se os dados forem salvos com sucesso
     */
    public function alterarPreco($arrPreco)
    {


        // montar a consulta
        $sql = "UPDATE tb_preco
                    SET
                    PRECO_MINUTO = ".$arrPreco['preco']."
                    WHERE
                    ID_PRECO = ".$arrPreco['id_preco'];

        // realizar a blidagem dos dados
        try {
            $bd = $this->conectar();
            $query = $bd->prepare($sql);
            $query->execute();
            return true;
        } catch (PDOException $e) {
            $e->getMessage();
            return false;
        }
    }

    /**
     * Método utilizado para inserir um saida de veiculos
     * @access public
     * @param int $id
     * @return Boolean retorna TRUE se os dados forem salvos com sucesso
     */
    public function saida($id)
    {
        $this->setIdFuncionario($_SESSION['UsuarioID']);
        $this->setIdEntradaSaida($id);
        // montar a consulta
        $sql = "UPDATE tb_entrada_saida
                    SET
                    SAIDA = CURRENT_TIMESTAMP,
                    ID_FUNCIONARIO = :id_funcionario
                    WHERE
                    ID_ENTRADA_SAIDA = :id";

        // realizar a blidagem dos dados
        try {
            $bd = $this->conectar();
            $query = $bd->prepare($sql);
            $query->bindValue(':id_funcionario', $this->getIdFuncionario(), PDO::PARAM_STR);
            $query->bindValue(':id', $this->getIdEntradaSaida(), PDO::PARAM_STR);
            $query->execute();
            return true;
        } catch (PDOException $e) {
            $e->getMessage();
            return false;
        }
    }


    /**
     * Método utilizado para inserir um pagamentos
     * @access public
     * @param Array $arrEntrada
     * @return Boolean retorna TRUE se os dados forem salvos com sucesso
     */
    public function inserirPagamento($arrPagamento)
    {
        $this->setIdFuncionario($_SESSION['UsuarioID']);
        $this->setIdEntradaSaida($arrPagamento['ID_ENTRADA_SAIDA']);
        // montar a consulta
        $sql = "INSERT INTO tb_pagamento
                (VL_APAGAR,
                VL_PAGO,
                VL_TROCO,
                DT_PAGAMENTO,
                ID_ENTRADA_SAIDA,
                ID_FUNCIONARIO)
                VALUES
                (:VL_APAGAR,
                :VL_PAGO,
                :VL_TROCO,
                CURRENT_TIMESTAMP(),
                :ID_ENTRADA_SAIDA,
                :ID_FUNCIONARIO)";

        // realizar a blidagem dos dados
        try {
            $bd = $this->conectar();
            $query = $bd->prepare($sql);
            $query->bindValue(':id_funcionario', $this->getIdFuncionario(), PDO::PARAM_STR);
            $query->bindValue(':id', $this->getIdEntradaSaida(), PDO::PARAM_STR);
            $query->execute();
            return true;
        } catch (PDOException $e) {
            $e->getMessage();
            return false;
        }
    }

}
