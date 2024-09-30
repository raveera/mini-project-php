<?php
    require '../check-session.php';
    require '../model/band-model.php';
    require '../model/album-model.php';

    class BandController extends CheckSession
    {
        private $bandModel;
        private $albumModel;

        function __construct()
        {
            parent::__construct();
            $this->bandModel = new BandModel;
            $this->albumModel = new AlbumModel;
        }

        public function addBand($bandName, $recordId)
        {
            $bandNameExists = $this->bandModel->getBandId($bandName, $recordId);

            if ($bandNameExists) {
                $err = 'This Band Name Exists';

                return $err;
            }

            $this->bandModel->addBand($bandName, $recordId);
            header('location: ' . BAND_CONTROLLER_PATH . '?page=band-list&record-id=' . $recordId);
        }

        public function showBand($recordId)
        {
            return $this->bandModel->getAllBand($recordId);
        }

        public function getBandName($bandId)
        {
            return $this->bandModel->getBandName($bandId);
        }

        public function editBandName($bandName, $recordId, $bandOldName, $bandId)
        {
            if ($bandOldName !== $bandName) {
                $bandNameExists = $this->bandModel->getBandId($bandName, $recordId);

                if ($bandNameExists) {
                    $err = 'This Band Name is Exists';

                    return $err;
                }
            }

            $this->bandModel->updateBand($bandName, $bandId);
            header('location: ' . BAND_CONTROLLER_PATH . '?page=band-list&record-id=' . $recordId);
        }

        public function delBand($bandId, $recordId)
        {
            $this->albumModel->delAlbumByBandId($bandId);
            $this->bandModel->delBand($bandId);
            header('location: ' . BAND_CONTROLLER_PATH . '?page=band-list&record-id=' . $recordId);
        }
    }
        
    $page = $_GET['page'];
    $recordId = $_GET['record-id'];
    $bandId = $_GET['band-id'];
    
    if (!$page) {
        header('location: ' . BAND_CONTROLLER_PATH . '?page=band-list&record-id=' . $recordId);
    }

    $bandController = new BandController;
    $isPost = $_SERVER['REQUEST_METHOD'] === 'POST';
    $bandName = $_POST['band_name'];
    $showBandListPath = BAND_CONTROLLER_PATH . '?record-id=' . $recordId;
    $addBandPath = BAND_CONTROLLER_PATH . '?page=add-band&record-id=' . $recordId;
    $editBandPath = BAND_CONTROLLER_PATH . '?page=edit-band&record-id=' . $recordId . '&band-id=' . $bandId;

    switch ($page) {
        case 'band-list':
            $bandList = $bandController->showBand($recordId);
            include '../view/band-show-page.php';
            break;
        case 'add-band':
            if ($isPost) {
               $err = $bandController->addBand($bandName, $recordId);
            }
            
            include '../view/band-add-page.php';
            break;
        case 'edit-band':
            $bandOldName = $bandController->getBandName($bandId);

            if ($isPost) {
                $err = $bandController->editBandName($bandName, $recordId, $bandOldName, $bandId);
            }

            include '../view/band-edit-page.php';
            break;
        case 'del-band':
            $bandController->delBand($bandId, $recordId);
            break;
        default:
            echo '404 Page not found';
            break;
    }
