<?php
include_once('../control/controlVeiculo.class.php');
$cf = new ControlVeiculo();
$cf->delete($_GET['id']);