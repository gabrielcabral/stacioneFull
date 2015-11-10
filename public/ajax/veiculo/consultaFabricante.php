<?php
/**
 * Created by PhpStorm.
 * User: GABRIEL
 * Date: 30/10/2015
 * Time: 14:36
 */

require('../../../model/modelConexao.class.php');
$pdo = new ModelConexao();
$bd = $pdo->conectar();
$dados = $bd->prepare("SELECT * FROM tb_fabricante WHERE tipo_veiculo = '".$_POST['id']."'");
$dados->execute();
$resultado =$dados->fetchAll(PDO::FETCH_ASSOC);
$result = array();
foreach($resultado as $value){
    $result+=[$value['id_fabricante'] => $value['nome_fabricante']];

}

echo json_encode($result);

?>