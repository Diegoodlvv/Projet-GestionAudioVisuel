<?php 

require_once 'Models/album.php';
require_once 'Controllers/MediaController.php';

class albumController {
    static function library() {
        $albums = album::getalbums();
        require_once('views/album/library.php');
    }

    function createAlbum() {
        if(isset($_POST['title']) && isset($_POST['author']) && isset($_POST['available']) && isset($_POST['trackNumber']) && isset($_POST['editor'])){
            $title = $_POST['title'];
            $author = $_POST['author'];
            $available = $_POST['available'];
            $trackNumber = $_POST['trackNumber'];
            $editor = $_POST['editor'];

            if(!empty($title) && !empty($author) && !empty($trackNumber) && !empty($editor)){
                $album = new Album(0, $title, $author, $available, $trackNumber, $editor);
                $album::createAlbum($title, $author, $available, $trackNumber, $editor);
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
            echo "Livre introuvable.";
            return;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $title = $_POST['title'];
            $author = $_POST['author'];
            $available = $_POST['available'];
            $trackNumber = $_POST['trackNumber'];
            $editor = $_POST['editor'];

            album::updatealbum($title, $author, $available, $trackNumber, $editor, $id);

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
}