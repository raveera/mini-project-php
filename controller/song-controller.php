<?php
    require '../check-session.php';
    require '../model/song-model.php';

    class SongController extends CheckSession
    {
        private $songModel;

        function __construct()
        {
            $this->songModel = new SongModel;
        }

        public function addSong($songName, $albumId)
        {
            $songNameExists = $this->songModel->getSongName($songName, $albumId);

            if ($songNameExists) {
                $err = 'This Song Name is Exitst';
                
                return $err;
            }

            $this->songModel->addSong($songName, $albumId);
            header('location: ' . SONG_CONTROLLER_PATH . '?page=song-list&album-id=' . $albumId);
        }
    }

    $page = $_GET['page'];
    $albumId = $_GET['album-id'];

    if (!$page) {
        header('location: ' . SONG_CONTROLLER_PATH . '?page=song-list&album-id=' . $albumId);
    }

    $isPost = $_SERVER['REQUEST_METHOD'] === 'POST';

    switch ($page) {
        case 'song-list':
            include '../view/song-show-page.php';
            break;
        case 'add-song':
            include '../view/song-add-page.php';
            break;
        default:
            echo '404 Page not found';
            break;
    }
    