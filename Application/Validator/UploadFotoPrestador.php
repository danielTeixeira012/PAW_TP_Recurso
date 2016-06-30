<?php

$imgErrors = array();
if (isset($_POST['confirmP'])) {
    $target_file = "Application/Uploads/Images/" . basename($_FILES["fotografiaP"]["name"]);
    $file_name = basename($_FILES["fotografiaP"]["name"]);
    $uploadOk = 1;
    $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);

    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
        $imgErrors['img'] = 'Tipo de ficheiro não suportado.';
        $uploadOk = 0;
    }
    if ($uploadOk == 0) {
        $imgErrors['img'] = 'Erro no upload da imagem.';
    } else {
        if (move_uploaded_file($_FILES["fotografiaP"]["tmp_name"], $target_file) === FALSE) {
            $imgErrors['img'] = 'Erro no upload da img.';
        }
    }
}