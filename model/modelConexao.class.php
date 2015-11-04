<?php

#não mostrar erros de notice
error_reporting(~E_ALL & ~E_NOTICE & ~E_WARNING);

/**
 * Criado em 01/01/2015
 * Classe de conexão com PDO/MySQL
 * @author Sérgio Lima (professor.sergiolima@gmail.com)
 * @version 1.0.0
 */
class ModelConexao {

    /**
     * Atributos da classe
     */
    private $host;
    private $user;
    private $senha;
    private $dbase;
    private $link;

    /**
     * Métodos get e sets das classes
     */
    public function getHost() {
        return $this->host;
    }

    public function getUser() {
        return $this->user;
    }

    public function getSenha() {
        return $this->senha;
    }

    public function getDbase() {
        return $this->dbase;
    }

    public function getLink() {
        return $this->link;
    }

    public function setHost($host) {
        $this->host = $host;
    }

    public function setUser($user) {
        $this->user = $user;
    }

    public function setSenha($senha) {
        $this->senha = $senha;
    }

    public function setDbase($dbase) {
        $this->dbase = $dbase;
    }

    public function setLink($link) {
        $this->link = $link;
    }

    /**
     * Método para conexao com o banco de dados
     * @return $pdo retorna o link da conexão com o banco em caso de sucesso
     */
    public function conectar() {

        #setar as cofigurações do banco de dados
        $this->setHost("localhost");
        $this->setUser("root");
        $this->setSenha("root");
        $this->setDbase("dbstacione");

        #conecta ao banco de dados usando o PHP PDO
        try {
            $pdo = new PDO("mysql:host={$this->getHost()};dbname={$this->getDbase()}", "{$this->getUser()}", "{$this->getSenha()}", array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->setLink($pdo);
            return $pdo;
        } catch (PDOException $e) {
            $this->setLink(null);
            return false;
        }
    }
}
