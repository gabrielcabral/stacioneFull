<?php



    $uploadDir = 'uploads';



if(!is_dir($uploadDir)) {
    if (!mkdir($structure, 0777, true)) {
        print "ERRO: Não foi possível criar o diretório [uploads]";
    }
}

if(!is_writable($uploadDir)) {
    chmod($uploadDir, 0777);
}

    $name = $uploadDir.'/image_'.date('YmdHis').'.jpg';

    $file = file_put_contents($name, file_get_contents('php://input'));
if (!$file) {
    print "ERRO: Falha de escrita para o arquivo [$name], É necessário dar permissão de escrita na pasta [$uploadDir]\n";
    exit();
}

$bd = new PDO("mysql:host=localhost; dbname=dbstacione; charset=utf8;", "root", "root");
$sql ="INSERT INTO tb_imagem
                    (imagem)
                    VALUES
                    ('".$name."')";

    $query = $bd->prepare($sql);
    $query->execute();
//    header("location: ../view/modulo.php?modulo=entrada&menu=inserir");

?>
