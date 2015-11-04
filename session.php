<?php

function validarSessao() {
    session_start();
    if (!isset($_SESSION['UsuarioID']))
        header("Location: ../index.php");
}

