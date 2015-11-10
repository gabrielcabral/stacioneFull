<?php

// inclui arquivo da classe de conexão
require_once '../model/modelConexao.class.php';

/**
 * Criado em 01/01/2015
 * Classe de CRUD com PDO para
 * @author Sérgio Lima (professor.sergiolima@gmail.com)
 * @version 1.0.0
 */
class ModelRelatorio extends ModelConexao
{


    /**
     * Atributos da classe
     */
    /**
     * Atributos da classe
     */

    private $id_entrada_saida;
    private $entrada;
    private $saida;
    private $id_funcionario;
    private $id_veiculo;
    private $id_imagem;
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
     * @param array
     * @return Array dados do pet
     */
    public function consultarDados($arrEntrada)
    {

        // setar os valores
        $this->setPlaca($arrEntrada['placa']);
        $this->setEntrada($arrEntrada['entrada']);

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


}
