<?php

// inclui arquivo da classe de conexão
require_once '../model/modelConexao.class.php';


/**
 * Criado em 01/08/2015
 * Classe de conexão com PDO/MySQL
 * @author gabriel cabral de almeida
 * @version 1.0.0
 */
class ModelVeiculo extends ModelConexao
{

    /**
     * Atributos da classe
     */
    private $id_veiculo;
    /**
     * @var
     */
    private $id_fabricante;
    /**
     * @var
     */
    private $nome_veiculo;
    /**
     * @var
     */
    private $tipo_veiculo;


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
    public function getIdFabricante()
    {
        return $this->id_fabricante;
    }

    /**
     * @param mixed $id_fabricante
     */
    public function setIdFabricante($id_fabricante)
    {
        $this->id_fabricante = $id_fabricante;
    }

    /**
     * @return mixed
     */
    public function getModelo()
    {
        return $this->modelo;
    }

    /**
     * @param mixed $modelo
     */
    public function setModelo($modelo)
    {
        $this->modelo = $modelo;
    }

    /**
     * @return mixed
     */
    public function getVeiculo()
    {
        return $this->veiculo;
    }

    /**
     * @param mixed $veiculo
     */
    public function setVeiculo($veiculo)
    {
        $this->veiculo = $veiculo;
    }

    /**
     * @return mixed
     */
    public function getNomeVeiculo()
    {
        return $this->nome_veiculo;
    }

    /**
     * @param mixed $nome_veiculo
     */
    public function setNomeVeiculo($nome_veiculo)
    {
        $this->nome_veiculo = $nome_veiculo;
    }

    /**
     * @return mixed
     */
    public function getTipoVeiculo()
    {
        return $this->tipo_veiculo;
    }

    /**
     * @param mixed $tipo_veiculo
     */
    public function setTipoVeiculo($tipo_veiculo)
    {
        $this->tipo_veiculo = $tipo_veiculo;
    }


    /**
     * método mágico para não permitir clonar a classe
     */
    public function __clone() 
    {
        ;
    }

    /**
     * Método utilizado para consultar os Veiculo cadastrados
     * @access public 
     * @param Int    $id   id do veiculo
     * @param String $nome nome do veiculo
     * @return Array dados do veiculo
     */
    public function consultar($arrVeiculo) 
    {

        // setar os valores

        $this->setIdVeiculo($arrVeiculo['id_veiculo']);
        $this->setNomeVeiculo($arrVeiculo['modelo']);
        $this->setIdFabricante($arrVeiculo['nome_fabricante']);
        $this->setTipoVeiculo($arrVeiculo['tpveiculo']);

        // montar a consultar (whre 1 serve para selecionar todos os registros)
        $sql = "select * from tb_veiculo v INNER JOIN tb_fabricante f on f.ID_fabricante = v.id_fabricante WHERE TRUE";

        // verificar se foi passado algum valor de $id_veiculo    
        if ($this->getIdVeiculo() != null) {
            $sql.= " and v.id_veiculo=:id_veiculo";
        }
        if ($this->getNomeVeiculo() != null) {
            $sql.= " and v.id_veiculo=:nome_veiculo";
        }
         // verificar se foi passado algum valor de $id_veiculo
        if ($this->getIdFabricante() != null) {
            $sql.= " and v.id_fabricante=:id_fabricante";
        }
        // verificar se foi passado algum valor de $id_veiculo
        if ($this->getTipoVeiculo() != null) {
            $sql.= " and v.tipo_veiculo=:tipoVeiculo";
        }
        $sql.=" ORDER BY v.nome_veiculo ASC ";

        // executa consulta e controi um array com o resultado da consulta
        try {
            $bd = $this->conectar();
            $query = $bd->prepare($sql);


            // verificar se foi passado algum valor de $id_veiculo
            if ($this->getIdVeiculo() != null) {
                $query->bindValue(':id_veiculo', $this->getIdVeiculo(), PDO::PARAM_INT);
            }
            // verificar se foi passado algum valor de $id_veiculo
            if ($this->getIdFabricante() != null) {
                $query->bindValue(':id_fabricante', $this->getIdFabricante(), PDO::PARAM_INT);
            }
            if ($this->getNomeVeiculo() != null) {
                  $query->bindValue(':nome_veiculo', $this->getNomeVeiculo(), PDO::PARAM_STR);
            }
            // verificar se foi passado algum valor de $id_veiculo
            if ($this->getTipoVeiculo() != null) {
                $query->bindValue(':tipoVeiculo', $this->getTipoVeiculo(), PDO::PARAM_STR);
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
     * Método utilizado para consultar os Veiculo cadastrados
     * @access public
     * @param Int    $id   id do veiculo
     * @param String $nome nome do veiculo
     * @return Array dados do veiculo
     */
    public function consultarVeiculo($idfabricante) 
    {

        // setar os valores


        $this->setIdFabricante($idfabricante);

        // montar a consultar (whre 1 serve para selecionar todos os registros)
        $sql = "select DISTINCT veiculo from tb_veiculo where id_fabricante = :id_fabricante ORDER BY veiculo asc limit 10";



        // executa consulta e controi um array com o resultado da consulta
        try {
            $bd = $this->conectar();
            $query = $bd->prepare($sql);
            // verificar se foi passado algum valor de $id_veiculo
            $query->bindValue(':id_fabricante', $idfabricante, PDO::PARAM_INT);
            $query->execute();
            $this->resultado = $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            $e->getMessage();

            $this->resultado = null;
        }
        return $this->resultado;
    }
    /**
     * Método utilizado para consultar os Veiculo cadastrados
     * @access public
     * @param Int    $id   id do veiculo
     * @param String $nome nome do veiculo
     * @return Array dados do veiculo
     */
    public function consultaFabricante() 
    {


        // montar a consultar (whre 1 serve para selecionar todos os registros)
        $sql = "select * from tb_fabricante";

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
     * Método utilizado para inserir um veiculo
     * @access public 
     * @param Array $arrVeiculo
     * @return Boolean retorna TRUE se os dados forem salvos com sucesso
     */
    function inserirVeiculo($arrVeiculo)
    {

        // setar os valores

        $this->setIdFabricante($arrVeiculo['nome_fabricante']);
        $this->setModelo($arrVeiculo['modelo']);
        $this->setTipoVeiculo($arrVeiculo['tpveiculo']);

        // montar a consulta
        $sql = "INSERT INTO tb_veiculo
                    (
                    id_veiculo,
                    nome_veiculo,
                    id_fabricante,
                    tipo_veiculo)
                    VALUES
                    (
                    '".date('ymdhsi')."',
                    :nome_veiculo,
                    :id_fabricante,
                    :tipo_veiculo)
                    ";

        // realizar a blidagem dos dados
        try {
            $bd = $this->conectar();
            $query = $bd->prepare($sql);
            $query->bindValue(':nome_veiculo', $this->getModelo(), PDO::PARAM_STR);
            $query->bindValue(':id_fabricante', $this->getIdFabricante(), PDO::PARAM_STR);
            $query->bindValue(':tipo_veiculo', $this->getTipoVeiculo(), PDO::PARAM_STR);

            $query->execute();
            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    /**
     * Método utilizado para alterar um veiculo
     * @access public 
     * @param Int    $id           id do veiculo
     * @param String $nome         nome do veiculo
     * @param String $cpf          CPF do veiculo
     * @param String $dtNascimento data de nascimento do veiculo
     * @param String $telefone     telefone do veiculo
     * @return Boolean retorna TRUE se os dados forem salvos com sucesso
     */
    public function alterarVeiculo($arrVeiculo)
    {

        // setar os dados
        $this->setIdVeiculo($arrVeiculo['id_veiculo']);
        $this->setIdFabricante($arrVeiculo['nome_fabricante']);
        $this->setNomeVeiculo($arrVeiculo['modelo']);
        $this->setTipoVeiculo($arrVeiculo['tpveiculo']);


        // montar a consulta
        $sql = "UPDATE tb_veiculo
                SET
                    nome_veiculo = :nome_veiculo,
                    id_fabricante = :id_fabricante,
                    tipo_veiculo = :tipo_veiculo
                WHERE
                    ID_veiculo = :ID_veiculo";

        // realizar a blidagem dos dados
        try {
            $bd = $this->conectar();
            $query = $bd->prepare($sql);
            $query->bindValue(':nome_veiculo', $this->getModelo(), PDO::PARAM_STR);
            $query->bindValue(':id_fabricante', $this->getIdFabricante(), PDO::PARAM_STR);
            $query->bindValue(':tipo_veiculo', $this->getTipoVeiculo(), PDO::PARAM_STR);
            $query->bindValue(':ID_veiculo', $this->getIdVeiculo(), PDO::PARAM_STR);

            $query->execute();
            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    /**
     * Método utilizado para excluir um veiculo cadastrado
     * @access public 
     * @param Int $id id do veiculo
     * @return Boolean retorna TRUE se os dados for excluído sucesso
     */
    public function excluir($id_veiculo) 
    {

        // setar os dados
        $this->setIdVeiculo($id_veiculo);

        // montar a consulta
        $sql = "delete from tb_veiculo
                WHERE
                    id_veiculo = :id_veiculo";

        // realizar a blidagem dos dados
        try {
            $bd = $this->conectar();
            $query = $bd->prepare($sql);
            $query->bindValue(':id_veiculo', $this->getIdVeiculo(), PDO::PARAM_INT);
            $query->execute();
            return true;
        } catch (PDOException $e) {
            $e->getMessage();
            return false;
        }
    }

}
