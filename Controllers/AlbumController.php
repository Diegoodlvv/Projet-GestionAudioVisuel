<?php 

require_once 'Models/album.php';
require_once 'Controllers/MediaController.php';
require_once 'Services/FileService.php';
require_once 'Models/File.php';

class albumController {
    static function library() {
        $albums = album::getalbums();
        require_once('views/album/library.php');
    }

    function createAlbum() {
        if(isset($_POST['title']) && isset($_POST['author']) && isset($_POST['available']) && isset($_POST['trackNumber']) && isset($_POST['editor'])){
            $title = $_POST['title'];
            $author = $_POST['author'];
            $available = isset($_POST['available']) ? 1 : 0;
            $trackNumber = $_POST['trackNumber'];
            $editor = $_POST['editor'];

            if (isset($_FILES['illustration']) && $_FILES['illustration']['error'] !== UPLOAD_ERR_NO_FILE) {
                $fileId = FileService::uploadIllustration(
                    $_FILES['illustration'],
                    $_SESSION['user_id']
                );
            } else {
                echo "Aucun fichier téléchargé.";

                require_once ('views/book/form.php');
            }

            if(!empty($title) && !empty($author) && !empty($trackNumber) && !empty($editor)){
                $albumId = Album::createAlbum($title, $author, $available, $trackNumber, $editor, $fileId);

                echo "L'album a été ajouté avec succès.";
                MediaController::library();
                require_once ('views/media/mediatheque.php');
            } else {
                echo "Veuillez remplir tous les champs."; 
                require_once ('views/album/form.php');
            }
        } else {
            require_once ('views/album/form.php');
        }
    }

    function updateAlbum(int $id) {
        $album = Album::getAlbumById($id);

        if (!$album) {
            echo "Album introuvable.";
            return;
        }

        $albumInfos = Media::getMediaById($album['media_id']);
        $fileId = $albumInfos['file_id'] ?? null;
        $currentFile = File::getFileById($fileId);
        var_dump($currentFile);

        $maxPostSize = ini_get('post_max_size');
        $maxPost = File::toBytes($maxPostSize);

        if(isset($_SERVER["CONTENT_LENGTH"]) && $_SERVER["CONTENT_LENGTH"] > $maxPost){
            echo "fichier trop volumineux";
            MediaController::library();
            require_once('views/media/mediatheque.php');
            return;
        } 

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $title = $_POST['title'];
            $author = $_POST['author'];
            $available = $_POST['available'];
            $trackNumber = $_POST['trackNumber'];
            $editor = $_POST['editor'];

            album::updatealbum($title, $author, $available, $fileId, $trackNumber, $editor, $id);

            if (isset($_FILES['illustration']) && $_FILES['illustration']['error'] !== UPLOAD_ERR_NO_FILE ) 
            {
                FileService::uploadIllustration(
                    $_FILES['illustration'],
                    $_SESSION['user_id']
                );
            }

            echo "L'album a bien été modifié";
            MediaController::library();
            require_once('views/media/mediatheque.php');
            return;
        }

        $albumInfos = Media::getMediaById($album['media_id']);
        require_once('views/album/form.php');
    }


    function deleteAlbum(int $id){
        $album = Album::getAlbumById($id);
        if(!$album){
            $message = "Album introuvable";
        } else {
            Album::deleteAlbum($id);
            echo "Suppression réussie";
        }
        MediaController::library();
        require_once ('views/media/mediatheque.php');
    }

    function emprunterAlbum(int $id) {
        try {
            Album::emprunter($id);
            echo "Vous avez emprunté cet album.";
        } catch (Exception $e) {
            echo $e->getMessage();
        }
        MediaController::library();
        require_once('views/media/mediatheque.php');
    }

    function rendreAlbum(int $id) {
        try {
            Album::rendre($id);
            echo "Vous avez rendu cet album.";
        } catch (Exception $e) {
            echo $e->getMessage();
        }
        MediaController::library();
        require_once('views/media/mediatheque.php');
    }
}