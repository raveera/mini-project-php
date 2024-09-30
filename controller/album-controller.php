<?php
    require '../check-session.php';
    require '../model/band-model.php';
    require '../model/album-model.php';

    class AlbumController extends CheckSession
    {
        private $albumModel;
        private $bandModel;
        
        function __construct()
        {
            parent::__construct();
            $this->albumModel = new AlbumModel;
            $this->bandModel = new BandModel;
        }

        public function getRecordByBandId($bandId)
        {
            return $this->bandModel->getRecordByBandId($bandId);
        }

        public function addAlbum($albumName, $bandId, $recordId)
        {
            $albumNameExists = $this->albumModel->getAlbumId($albumName, $bandId);

            if ($albumNameExists) {
                $err = 'This Album Name is Exists';

                return $err;
            }

            $this->albumModel->addAlbum($albumName, $bandId, $recordId);
            header('location: ' . ALBUM_CONTROLLER_PATH . '?page=album-list&band-id=' . $bandId);
        }

        public function showAllAlbum($bandId)
        {
            return $this->albumModel->getAllAlbum($bandId);
        }

        public function getAlbumName($albumId)
        {
            return $this->albumModel->getAlbumName($albumId);
        }

        public function editAlbum($albumName, $bandId, $albumOldName, $albumId, $recordId)
        {
            if ($albumName !== $albumOldName) {
                $albumNameExists = $this->albumModel->getAlbumId($albumName, $bandId);

                if ($albumNameExists) {
                    $err = 'This Album Name is Exists';
                    
                    return $err;
                }
            }
            
            $this->albumModel->updateAlbum($albumName, $albumId, $recordId);
            header('location: ' . ALBUM_CONTROLLER_PATH . '?page=album-list&band-id=' . $bandId);
        }

        public function delAlbum($albumId, $bandId)
        {
            $this->albumModel->delAlbum($albumId);
            header('location: ' . ALBUM_CONTROLLER_PATH . '?page=album-list&band-id=' . $bandId );
        }
    }

    $page = $_GET['page'];
    $bandId = $_GET['band-id'];
    $albumId = $_GET['album-id'];

    if (!$page) {
        header('location: ' . ALBUM_CONTROLLER_PATH . '?page=album-list&band-id=' . $bandId);
    }

    $albumController = new AlbumController;
    $recordId = $albumController->getRecordByBandId($bandId);
    $isPost = $_SERVER['REQUEST_METHOD'] === 'POST';
    $albumName = $_POST['album_name'];
    $showAlbumListPath = ALBUM_CONTROLLER_PATH . '?page=album-list&band-id=' . $bandId;

    switch ($page) {
        case 'album-list':
            $albumList = $albumController->showAllAlbum($bandId);
            include '../view/album-show-page.php';
            break;
        case 'add-album':
            if ($isPost) {
                $err = $albumController->addAlbum($albumName, $bandId, $recordId);
            }

            include '../view/album-add-page.php';
            break;
        case 'edit-album':
            $albumOldName = $albumController->getAlbumName($albumId);

            if ($isPost) {
                $err = $albumController->editAlbum($albumName, $bandId, $albumOldName, $albumId, $recordId);
            }

            include '../view/album-edit-page.php';
            break;
        case 'del-album':
            $albumController->delAlbum($albumId, $bandId);
            break;
        default:
            echo '404 Page not found';
            break;
    }
