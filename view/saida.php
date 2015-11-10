<?php
/**
 * Created by PhpStorm.
 * User: GABRIEL
 * Date: 30/10/2015
 * Time: 13:42
 */
require_once '../control/controlEstaciona.class.php';
$ce = new ControlEstaciona();
$ce->saida($_GET['id']);