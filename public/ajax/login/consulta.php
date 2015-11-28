<?php
/**
 * Created by PhpStorm.
 * User: GABRIEL
 * Date: 30/10/2015
 * Time: 14:36
 */

require('../../../model/modelConexao.class.php');
$usuario = $_POST['login'];
$senha = $_POST['senha'];

$pdo = new ModelConexao();
$bd = $pdo->conectar();
$dados = $bd->prepare ("SELECT id_funcionario, nm_funcionario , cpf_funcionario , senha ,id_perfil FROM tb_funcionario WHERE login =  '".$usuario."'  AND senha = '" . substr(md5 ($senha), 0, 40) . "' and ativo = 1 LIMIT 1");

$dados->execute();

$resultado =$dados->fetch(PDO::FETCH_ASSOC);



echo json_encode($resultado);

?>