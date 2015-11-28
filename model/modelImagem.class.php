<?php

// inclui arquivo da classe de conexão
require_once '../model/modelConexao.class.php';


/**
 * Criado em 01/08/2015
 * Classe de conexão com PDO/MySQL
 * @author gabriel cabral de almeida
 * @version 1.0.0
 */
class ModelImagem extends ModelConexao
{

    /**
     * Atributos da classe
     */

    private $id_imagem;
    /**
     * @var
     */
    private $imagem;

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
    public function getImagem()
    {
        return $this->imagem;
    }

    /**
     * @param mixed $imagem
     */
    public function setImagem($imagem)
    {
        $this->imagem = $imagem;
    }


    /**
     * Método utilizado para consultar imagem cadastrados
     * @access public 

     * @return Array dados da imagem
     */
    public function consultar() 
    {

        // montar a consultar (whre 1 serve para selecionar todos os registros)
        $sql = "SELECT
                    id_imagem,
                    imagem
                FROM
                    tb_imagem
                ORDER BY
                    id_imagem DESC
                LIMIT 1";

        // executa consulta e controi um array com o resultado da consulta
        try {
            $bd = $this->conectar();
            $query = $bd->prepare($sql);

            $query->execute();

            $this->resultado = $query->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            $e->getMessage();

            $this->resultado = null;
        }
        return $this->resultado;
    }

    /**
     * Método utilizado para inserir imagem
     * @access public
     * @param Int    $$strImagem
     * @return Array dados da imagem
     */
    public function inserirImagem($strImagem)
    {

        $this->setImagem('$strImagem');
        // montar a consulta
        $sql = "INSERT INTO tb_imagem
                    (imagem)
                    VALUES
                    (:imagem)";

        // realizar a blidagem dos dados
        try {
            $bd = $this->conectar();
            $query = $bd->prepare($sql);
            $query->bindValue(':imagem', $this->getImagem(), PDO::PARAM_STR);
            $query->execute();
            return true;
        } catch (PDOException $e) {
            $e->getMessage();
            return false;
        }
    }

}
