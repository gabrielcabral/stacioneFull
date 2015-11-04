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
$dados = $bd->prepare("SELECT  *
FROM tb_veiculo
where ID_fabricante = ".$_POST['id']);
$dados->execute();
$resultado =$dados->fetchAll(PDO::FETCH_ASSOC);
$result = array();
foreach($resultado as $value){
    $result+=[$value['id_veiculo'] => $value['veiculo']];

}

echo json_encode($result);

?>