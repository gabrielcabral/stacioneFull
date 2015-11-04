<?php
/**
 * Created by PhpStorm.
 * User: GABRIEL
 * Date: 30/10/2015
 * Time: 13:42
 */

include_once('../control/controlFuncionario.class.php');
$cf = new ControlFuncionario();

$cf->delete($_GET['id']);