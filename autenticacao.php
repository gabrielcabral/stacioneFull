<?php

require_once 'conectar.php';
// Verifica se houve POST e se o usuário ou a senha é(são) vazio(s)
/*if (!empty($_POST) AND ( empty($_POST['login']) OR empty($_POST['senha']))) {
    header("Location:index.php");
    exit;
}*/

$usuario = mysql_real_escape_string($_POST['login']);
$senha = mysql_real_escape_string($_POST['senha']);

// Validação do usuário/senha digitados
$sql = "SELECT id_funcionario, nm_funcionario , cpf_funcionario , senha ,id_perfil FROM tb_funcionario WHERE (login = '" . $usuario . "') AND (senha = '" . substr(md5 ($senha), 0, 40) . "') and ativo = 1 LIMIT 1";
$query = mysql_query($sql);

if (@mysql_num_rows($query) != 1) {
    // Mensagem de erro quando os dados são inválidos e/ou o usuário não foi encontrado
    echo "<script>
            if($('#login').val()==''){
                    $(document).trigger(\"add-alerts\", [
                    {
                        'message': \"Campos obrigatórios não informados!\",
                        'priority': 'danger'
                    }
                ])
</script>";
   // echo "<script> location.href= ('index.php')</script>";
    exit;
} else {
    // Salva os dados encontados na variável $resultado
    $resultado = mysql_fetch_assoc($query);

    // Se a sessão não existir, inicia uma
    if (!isset($_SESSION)) {
        session_start();

        // Salva os dados encontrados na sessão
        $_SESSION['UsuarioID'] = $resultado['id_funcionario'];
        $_SESSION['UsuarioNome'] = $resultado['nm_funcionario'];
        $_SESSION['UsuarioNivel'] = $resultado['id_perfil'];

        header("Location: view/modulo.php?modulo=principal");
        exit;
    } else {
        header("Location: view/modulo.php?modulo=principal");
    }
}
?>