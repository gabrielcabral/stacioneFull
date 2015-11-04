<?php
/**
 * Created by PhpStorm.
 * User: GABRIEL
 * Date: 30/10/2015
 * Time: 13:42
 */

include_once('../control/controlVeiculo.class.php');
$cv = new ControlVeiculo();
var_dump($_GET['id']);
$cv->delete($_GET['id']);