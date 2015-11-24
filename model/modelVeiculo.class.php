<?php

// inclui arquivo da classe de conexão
require_once '../model/modelConexao.class.php';


/**
 * Class ModelVeiculo
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
     * Método utilizado para consultar os funcionarios cadastrados
     * @access public 
     * @param Int    $id   id do funcionario
     * @param String $nome nome do funcionario
     * @return Array dados do funcionario
     */
    public function consultar($arrVeiculo) 
    {

        // setar os valores

        $this->setIdVeiculo($arrVeiculo['modelo']);
        $this->setIdFabricante($arrVeiculo['nome_fabricante']);
        $this->setTipoVeiculo($arrVeiculo['tpveiculo']);

        // montar a consultar (whre 1 serve para selecionar todos os registros)
        $sql = "select * from tb_veiculo v INNER JOIN tb_fabricante f on f.ID_fabricante = v.id_fabricante WHERE TRUE";

        // verificar se foi passado algum valor de $id_funcionario    
        if ($this->getIdVeiculo() != null) {
            $sql.= " and v.id_veiculo=:id_veiculo";
        }
         // verificar se foi passado algum valor de $id_funcionario
        if ($this->getIdFabricante() != null) {
            $sql.= " and v.id_fabricante=:id_fabricante";
        }
        // verificar se foi passado algum valor de $id_funcionario
        if ($this->getTipoVeiculo() != null) {
            $sql.= " and v.tipo_veiculo=:tipoVeiculo";
        }
        $sql.=" ORDER BY v.nome_veiculo ASC ";

        // executa consulta e controi um array com o resultado da consulta
        try {
            $bd = $this->conectar();
            $query = $bd->prepare($sql);


            // verificar se foi passado algum valor de $id_funcionario
            if ($this->getIdVeiculo() != null) {
                $query->bindValue(':id_veiculo', $this->getIdVeiculo(), PDO::PARAM_INT);
            }
            // verificar se foi passado algum valor de $id_funcionario
            if ($this->getIdFabricante() != null) {
                $query->bindValue(':id_fabricante', $this->getIdFabricante(), PDO::PARAM_INT);
            }
            // verificar se foi passado algum valor de $id_funcionario
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
     * Método utilizado para consultar os funcionarios cadastrados
     * @access public
     * @param Int    $id   id do funcionario
     * @param String $nome nome do funcionario
     * @return Array dados do funcionario
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
            // verificar se foi passado algum valor de $id_funcionario
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
     * Método utilizado para consultar os funcionarios cadastrados
     * @access public
     * @param Int    $id   id do funcionario
     * @param String $nome nome do funcionario
     * @return Array dados do funcionario
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
     * Método utilizado para inserir um funcionario
     * @access public 
     * @param String $nome         nome do funcionario
     * @param String $cpf          CPF do funcionario
     * @param String $dtNascimento data de nascimento do funcionario
     * @param String $telefone     telefone do funcionario
     * @return Boolean retorna TRUE se os dados forem salvos com sucesso
     */
    function inserirfuncionario($arrFuncionario) 
    {

        // setar os valores
        $this->setIdFuncionario($arrFuncionario['id_funcionario']);
        $this->setNmFuncionario($arrFuncionario['nome_funcionario']);
        $this->setCpfFuncionario($arrFuncionario['cpf_funcionario']);
        $this->setRgFuncionario($arrFuncionario['rg_funcionario']);
        $this->setDtNascimento($arrFuncionario['dtNascimento']);
        $this->setIdPerfil($arrFuncionario['id_perfil']);
        $this->setLogin($arrFuncionario['login']);
        $this->setSenha($arrFuncionario['senha']);
        $this->setTelefone($arrFuncionario['telefone']);

        // montar a consulta
        $sql = "INSERT INTO tb_funcionario
                            (
                            NM_FUNCIONARIO,
                            CPF_FUNCIONARIO,
                            RG_FUNCIONARIO,
                            DT_NASCIMENTO,
                            LOGIN,
                            SENHA,
                            TELEFONE,
                            ATIVO)
                            VALUES
                            (
                            :NM_FUNCIONARIO ,
                            :CPF_FUNCIONARIO ,
                            :RG_FUNCIONARIO ,
                            :DT_NASCIMENTO ,
                            :LOGIN ,
                            :SENHA ,
                            :TELEFONE,
                             1);";

        // realizar a blidagem dos dados
        try {
            $bd = $this->conectar();
            $query = $bd->prepare($sql);
            $query->bindValue(':ID_PERFIL', $this->getIdPerfil(), PDO::PARAM_STR);
            $query->bindValue(':NM_FUNCIONARIO', $this->getNmFuncionario(), PDO::PARAM_STR);
            $query->bindValue(':CPF_FUNCIONARIO', $this->getCpfFuncionario(), PDO::PARAM_STR);
            $query->bindValue(':RG_FUNCIONARIO', $this->getRgFuncionario(), PDO::PARAM_STR);
            $query->bindValue(':DT_NASCIMENTO', $this->getDtNascimento(), PDO::PARAM_STR);
            $query->bindValue(':LOGIN', $this->getLogin(), PDO::PARAM_STR);
            $query->bindValue(':SENHA', $this->getSenha(), PDO::PARAM_STR);
            $query->bindValue(':TELEFONE', $this->getTelefone(), PDO::PARAM_STR);
            $query->execute();
            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    /**
     * Método utilizado para alterar um funcionario
     * @access public 
     * @param Int    $id           id do funcionario
     * @param String $nome         nome do funcionario
     * @param String $cpf          CPF do funcionario
     * @param String $dtNascimento data de nascimento do funcionario
     * @param String $telefone     telefone do funcionario
     * @return Boolean retorna TRUE se os dados forem salvos com sucesso
     */
    public function alterarfuncionario($arrFuncionario) 
    {

        // setar os dados
        $this->setIdFuncionario($arrFuncionario['id_funcionario']);
        $this->setNmFuncionario($arrFuncionario['nome_funcionario']);
        $this->setCpfFuncionario($arrFuncionario['cpf_funcionario']);
        $this->setRgFuncionario($arrFuncionario['rg_funcionario']);
        $this->setDtNascimento($arrFuncionario['dtNascimento']);
        $this->setIdPerfil($arrFuncionario['id_perfil']);
        $this->setLogin($arrFuncionario['login']);
        $this->setSenha($arrFuncionario['senha']);
        $this->setTelefone($arrFuncionario['telefone']);

        // montar a consulta
        $sql = "UPDATE tb_funcionario
                SET
                 ID_PERFIL = : ID_PERFIL,
                 NM_FUNCIONARIO = : NM_FUNCIONARIO,
                 CPF_FUNCIONARIO = : CPF_FUNCIONARIO,
                 RG_FUNCIONARIO = : RG_FUNCIONARIO,
                 DT_NASCIMENTO = : DT_NASCIMENTO,
                 LOGIN = : LOGIN,
                 SENHA = : SENHA,
                 TELEFONE = : TELEFONE
                WHERE
                    ID_FUNCIONARIO = :ID_FUNCIONARIO";

        // realizar a blidagem dos dados
        try {
            $bd = $this->conectar();
            $query = $bd->prepare($sql);
            $query->bindValue(':ID_PERFIL', $this->getIdPerfil(), PDO::PARAM_STR);
            $query->bindValue(':NM_FUNCIONARIO', $this->getNmFuncionario(), PDO::PARAM_STR);
            $query->bindValue(':CPF_FUNCIONARIO', $this->getCpfFuncionario(), PDO::PARAM_STR);
            $query->bindValue(':RG_FUNCIONARIO', $this->getRgFuncionario(), PDO::PARAM_STR);
            $query->bindValue(':DT_NASCIMENTO', $this->getDtNascimento(), PDO::PARAM_STR);
            $query->bindValue(':LOGIN', $this->getLogin(), PDO::PARAM_STR);
            $query->bindValue(':SENHA', $this->getSenha(), PDO::PARAM_STR);
            $query->bindValue(':TELEFONE', $this->getTelefone(), PDO::PARAM_STR);
            $query->bindValue(':ID_FUNCIONARIO', $this->getIdFuncionario(), PDO::PARAM_INT);
            $query->execute();
            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    /**
     * Método utilizado para excluir um funcionario cadastrado
     * @access public 
     * @param Int $id id do funcionario
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
