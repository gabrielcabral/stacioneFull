<?php

// inclui arquivo da classe de conexão
require_once '../model/modelConexao.class.php';


/**
 * Class ModelFuncionario
 */
class ModelFuncionario extends ModelConexao
{

    /**
     * Atributos da classe
     */
    private $id_funcionario;
    /**
     * @var
     */
    private $nm_funcionario;
    /**
     * @var
     */
    private $cpf_funcionario;
    /**
     * @var
     */
    private $rg_funcionario;
    /**
     * @var
     */
    private $dt_nascimento;
    /**
     * @var
     */
    private $login;
    /**
     * @var
     */
    private $senha;
    /**
     * @var
     */
    private $telefone;
    /**
     * @var
     */
    private $id_perfil;

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
    public function getNmFuncionario()
    {
        return $this->nm_funcionario;
    }

    /**
     * @param mixed $nm_funcionario
     */
    public function setNmFuncionario($nm_funcionario)
    {
        $this->nm_funcionario = $nm_funcionario;
    }

    /**
     * @return mixed
     */
    public function getCpfFuncionario()
    {
        return $this->cpf_funcionario;
    }

    /**
     * @param mixed $cpf_funcionario
     */
    public function setCpfFuncionario($cpf_funcionario)
    {
        $this->cpf_funcionario = $cpf_funcionario;
    }

    /**
     * @return mixed
     */
    public function getRgFuncionario()
    {
        return $this->rg_funcionario;
    }

    /**
     * @param mixed $rg_funcionario
     */
    public function setRgFuncionario($rg_funcionario)
    {
        $this->rg_funcionario = $rg_funcionario;
    }

    /**
     * @return mixed
     */
    public function getDtNascimento()
    {
        return $this->dt_nascimento;
    }

    /**
     * @param mixed $dt_nascimento
     */
    public function setDtNascimento($dt_nascimento)
    {
        $this->dt_nascimento = $dt_nascimento;
    }

    /**
     * @return mixed
     */
    public function getLogin()
    {
        return $this->login;
    }

    /**
     * @param mixed $login
     */
    public function setLogin($login)
    {
        $this->login = $login;
    }

    /**
     * @return mixed
     */
    public function getSenha()
    {
        return $this->senha;
    }

    /**
     * @param mixed $senha
     */
    public function setSenha($senha)
    {
        $this->senha = $senha;
    }

    /**
     * @return mixed
     */
    public function getIdPerfil()
    {
        return $this->id_perfil;
    }

    /**
     * @return mixed
     */
    public function getTelefone()
    {
        return $this->telefone;
    }

    /**
     * @param mixed $telefone
     */
    public function setTelefone($telefone)
    {
        $this->telefone = $telefone;
    }

    /**
     * @param mixed $id_perfil
     */
    public function setIdPerfil($id_perfil)
    {
        $this->id_perfil = $id_perfil;
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
    public function consultar($arrFuncionario) 
    {

        // setar os valores

        $this->setIdFuncionario($arrFuncionario['id_funcionario']);
        $this->setNmFuncionario($arrFuncionario['nm_funcionario']);
        $this->setCpfFuncionario($arrFuncionario['cpf_funcionario']);

        // montar a consultar (whre 1 serve para selecionar todos os registros)
        $sql = "select * from tb_funcionario where ATIVO = 1  ";

        // verificar se foi passado algum valor de $id_funcionario    
        if ($this->getIdFuncionario() != null) {
            $sql.= " and id_funcionario=:id_funcionario";
        }
        // verificar se foi passado algum valor de $id_funcionario
        if ($this->getCpfFuncionario() != null) {
            $sql.= " and cpf_funcionario=:cpf_funcionario";
        }

        // verificar se foi passado algum valor de $nome 
        if ($this->getNmFuncionario() != null) {
            $sql.= " and nm_funcionario LIKE :nome_funcionario ";
        }

        // executa consulta e controi um array com o resultado da consulta
        try {
            $bd = $this->conectar();
            $query = $bd->prepare($sql);

            // verificar se foi passado algum valor de $id_funcionario   
            if ($this->getIdFuncionario() != null) {
                $query->bindValue(':id_funcionario', $this->getIdFuncionario(), PDO::PARAM_INT);
            }

            // verificar se foi passado algum valor de $id_funcionario
            if ($this->getCpfFuncionario() != null) {
                $query->bindValue(':cpf_funcionario', $this->getCpfFuncionario(), PDO::PARAM_STR);

            }
            // verificar se foi passado algum valor de $nome 
            if ($this->getNmFuncionario() != null) {
                $this->setNmFuncionario("%" . $this->getNmFuncionario() . "%");
                $query->bindValue(':nome_funcionario', $this->getNmFuncionario(), PDO::PARAM_STR);
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
     * Método utilizado para inserir um funcionario
     * @access public 
     * @param Array de dados
     * @return Boolean retorna TRUE se os dados forem salvos com sucesso
     */
    function inserirfuncionario($arrFuncionario) 
    {

        // setar os valores

        $this->setNmFuncionario($arrFuncionario['nm_funcionario']);
        $this->setCpfFuncionario($arrFuncionario['cpf_funcionario']);
        $this->setRgFuncionario($arrFuncionario['rg_funcionario']);
        $this->setDtNascimento($arrFuncionario['dtNascimento']);
        $this->setIdPerfil($arrFuncionario['perfil']);
        $this->setLogin($arrFuncionario['login']);
        $this->setSenha(sha1($arrFuncionario['senha']));
        $this->setTelefone($arrFuncionario['telefone']);

        // montar a consulta
        $sql = "INSERT INTO tb_funcionario
                            (
                            ID_PERFIL,
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
                            :ID_PERFIL,
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
    var_dump($arrFuncionario);
        // setar os dados
        $this->setIdFuncionario($arrFuncionario['id_funcionario']);
        $this->setNmFuncionario($arrFuncionario['nm_funcionario']);
        $this->setCpfFuncionario($arrFuncionario['cpf_funcionario']);
        $this->setRgFuncionario($arrFuncionario['rg_funcionario']);
        $this->setDtNascimento($arrFuncionario['dtNascimento']);
        $this->setIdPerfil($arrFuncionario['perfil']);
         $this->setTelefone($arrFuncionario['telefone']);

        // montar a consulta
        $sql = "UPDATE tb_funcionario
                SET
                 ID_PERFIL = :ID_PERFIL,
                 NM_FUNCIONARIO = :NM_FUNCIONARIO,
                 CPF_FUNCIONARIO = :CPF_FUNCIONARIO,
                 RG_FUNCIONARIO = :RG_FUNCIONARIO,
                 DT_NASCIMENTO = :DT_NASCIMENTO,
                 TELEFONE = :TELEFONE
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
    public function excluirfuncionario($id_funcionario) 
    {

        // setar os dados
        $this->setIdFuncionario($id_funcionario);

        // montar a consulta
        $sql = "UPDATE tb_funcionario
                SET
                   ATIVO = 0
                WHERE
                    ID_FUNCIONARIO = :id_funcionario";

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

}
