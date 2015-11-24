<?php

// inclui arquivo da classe de conexão
require_once '../model/modelConexao.class.php';


/**
 * Class ModelEstaciona
 */
class ModelEstaciona extends ModelConexao
{

    /**
     * Atributos da classe
     */

    private $id_entrada_saida;
    /**
     * @var
     */
    private $entrada;
    /**
     * @var
     */
    private $saida;
    /**
     * @var
     */
    private $id_funcionario;
    /**
     * @var
     */
    private $id_veiculo;
    /**
     * @var
     */
    private $id_imagem;
    /**
     * @var
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
     * método mágico para não permitir clonar a classe
     */
    public function __clone() 
    {
        ;
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
     * Método utilizado para consultar os funcionarios cadastrados
     * @access public
     * @param Int    $id   id do funcionario
     * @param String $nome nome do funcionario
     * @return Array dados do funcionario
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
     * Método utilizado para consultar os funcionarios cadastrados
     * @access public
     * @param Int    $id   id do funcionario
     * @param String $nome nome do funcionario
     * @return Array dados do funcionario
     */
    public function consultarVeiculo() 
    {

        // setar os valores


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
     * Método utilizado para consultar os funcionarios cadastrados
     * @access public
     * @param Int    $id   id do funcionario
     * @param String $nome nome do funcionario
     * @return Array dados do funcionario
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
     * Método utilizado para consultar os funcionarios cadastrados
     * @access public
     * @param Int    $id   id do funcionario
     * @param String $nome nome do funcionario
     * @return Array dados do funcionario
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
     * Método utilizado para inserir um funcionario
     * @access public 
     * @param String $nome         nome do funcionario
     * @param String $cpf          CPF do funcionario
     * @param String $dtNascimento data de nascimento do funcionario
     * @param String $telefone     telefone do funcionario
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
     * Método utilizado para alterar um funcionario
     * @access public 
     * @param Int $id id do funcionario
     * @param String $nome nome do funcionario
     * @param String $cpf CPF do funcionario
     * @param String $dtNascimento data de nascimento do funcionario
     * @param String $telefone telefone do funcionario
     * @return Boolean retorna TRUE se os dados forem salvos com sucesso
     */


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

    /**
     * @param $arrVaga
     * @return bool
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
     * @param $arrVaga
     * @return bool
     */
    public function alterarPreco($arrVaga)
    {


        // montar a consulta
        $sql = "UPDATE tb_preco
                    SET
                    PRECO_MINUTO = ".$arrVaga['preco']."
                    WHERE
                    ID_PRECO = ".$arrVaga['id_preco'];

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
     * @param $id
     * @return bool
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

}
