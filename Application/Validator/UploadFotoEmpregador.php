<?php

$imgErrorsE = array();
if (isset($_POST['confirmE'])) {
    $target_fileE = "Application/Uploads/Images/" . basename($_FILES["fotografiaE"]["name"]);
    $file_name = basename($_FILES["fotografiaE"]["name"]);
    $uploadOk = 1;
    $imageFileType = pathinfo($target_fileE, PATHINFO_EXTENSION);

    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
        $imgErrorsE['img'] = 'Tipo de ficheiro não suportado.';
        $uploadOk = 0;
    }
    if ($uploadOk == 0) {
        $imgErrorsE['img'] = 'Erro no upload da imagem.';
    } else {
        if (move_uploaded_file($_FILES["fotografiaE"]["tmp_name"], $target_fileE) === FALSE) {
            $imgErrorsE['img'] = 'Erro no upload da img.';
        }
    }
}