<?php

class ImagesUpload {
    protected $pathFile;

    function upload(array $files) : bool {
        $this->_flash = new Flash();
        // check image
        $target_dir = "public/images/";
        $target_file = $target_dir.time().'-'.basename($files["fileToUpload"]["name"]);
        $target_file = str_replace(' ', '', $target_file);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
        if($check !== false) {
            $uploadOk = 1;
        } else {
            $this->_flash->setFlash("Le fichier n'est pas une image.");
            $uploadOk = 0;
            return false;
        }
        // Allow certain file formats
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif" ) {
            $this->_flash->setFlash("Désolé, seuls les fichiers JPG, JPEG, PNG et GIF sont autorisés.");
            $uploadOk = 0;
            return false;
        }
        if ($uploadOk == 0) {
            $this->_flash->setFlash("Désolé, votre fichier n'a pas été téléchargé.");
            $uploadOk = 0;
            return false;
        } else { // if everything is ok, try to upload file
            if (move_uploaded_file($files["fileToUpload"]["tmp_name"], $target_file)) {
                $this->setPathFile($target_file);
                return true;
            } else {
                $this->_flash->setFlash("Désolé, une erreur s'est produite lors du téléchargement de votre fichier.");
                $uploadOk = 0;
                return false;
            }
        }
    }

    function setPathFile($data) {
        $this->pathFile = $data;
    }

    function getPathFile() {
        return $this->pathFile;
    }
}