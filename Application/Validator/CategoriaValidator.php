<?php
$errors = array();
$input = INPUT_POST;

if (filter_input(INPUT_SERVER, 'REQUEST_METHOD') === 'POST') {
    if (filter_has_var($input, 'nomeCat') && filter_input($input, 'nomeCat') != '') {
        $categoria = filter_input($input, 'nomeCat');
    } else {
        $errors['nomeCat'] = 'O nome para a categoria é inválido';
    }
}

if (isset($_POST['submeter'])) {
    $target_file = "Application/Resources/Images/Categorias/" . basename($_FILES["fotografiaCat"]["name"]);
    $move_target_file = "../Application/Resources/Images/Categorias/" . basename($_FILES["fotografiaCat"]["name"]);
    $file_name = basename($_FILES["fotografiaCat"]["name"]);
    $uploadOk = 1;
    $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);

    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
        $imgErrors['fotografiaCat'] = 'Tipo de ficheiro não suportado.';
        $uploadOk = 0;
    }
    if ($uploadOk == 0) {
        $imgErrors['fotografiaCat'] = 'Erro no upload da imagem.';
    } else {
        if (move_uploaded_file($_FILES["fotografiaCat"]["tmp_name"], $move_target_file) === FALSE) {
            $imgErrors['fotografiaCat'] = 'Erro no upload da img.';
        }
    }
}