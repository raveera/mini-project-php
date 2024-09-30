<?php
    require '../check-session.php';
    require '../model/record-model.php';
    require '../model/band-model.php';
    require '../model/album-model.php';

    class RecordController extends CheckSession
    {
        private $recordModel;
        private $bandModel;
        private $albumModel;

        function __construct()
        {
            parent::__construct();
            $this->recordModel = new RecordModel;
            $this->bandModel = new BandModel;
            $this->albumModel = new AlbumModel;
        }

        public function addRecord($recordName, $userId)
        {
            $recordIdExists = $this->recordModel->getRecordId($recordName);

            if ($recordIdExists) {
                $err = 'This Record name is exists';

                return $err;
            }

            $this->recordModel->addRecord($recordName, $userId);
            header('location: ' . RECORD_CONTROLLER_PATH . '?page=record-list');
        }

        public function showRecord()
        {
            return $this->recordModel->getAllRecord();
        }

        public function getRecordName($recordId)
        {
            return $this->recordModel->getRecordName($recordId);
        }

        public function editRecord($recordName, $recordId, $recordOldName)
        {
            if ($recordOldName !== $recordName) {
                $recordIdExists = $this->recordModel->getRecordId($recordName);
                
                if ($recordIdExists) {
                    $err = 'This Record name is exists';
                    
                    return $err;
                }
            }

            $this->recordModel->editRecord($recordName, $recordId);
            header('location: ' . RECORD_CONTROLLER_PATH . '?page=record-list');
        }

        public function delRecord($recordId)
        {
            $this->albumModel->delAlbumByRecordId($recordId);
            $this->bandModel->delBandByRecordId($recordId);
            $this->recordModel->delRecord($recordId); 
            header('location: ' . RECORD_CONTROLLER_PATH . '?page=record-list');
        }
    }

    $page = $_GET['page'];

    if (!$page) {
        header('location: ' . RECORD_CONTROLLER_PATH . '?page=record-list');
    }

    $recordController = new RecordController;
    $isPost = $_SERVER['REQUEST_METHOD'] === 'POST';
    $recordName = $_POST['record_name'];
    $userId = $_SESSION['user_id'];
    $recordId = $_GET['record-id'];
    $addRecordPath = RECORD_CONTROLLER_PATH . '?page=add-record';

    switch ($page) {
        case 'record-list':
            $recordList = $recordController->showRecord();
            include '../view/record-show-page.php';
            break;
        case 'add-record':
            if ($isPost) {
                $err = $recordController->addRecord($recordName, $userId);
            }

            include '../view/record-add-page.php';
            break;
        case 'edit-record':
            $recordOldName = $recordController->getRecordName($recordId);

            if ($isPost) {
                $err = $recordController->editRecord($recordName, $recordId, $recordOldName);
            }

            include '../view/record-edit-page.php';
            break;
        case 'del-record':
            $recordController->delRecord($recordId);
            break;
        default:
            echo '404 Page not found';
            break;
    }
