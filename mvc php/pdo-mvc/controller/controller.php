<?php
// enable CORS - required for Angular UI
header("Access-Control-Allow-Origin: *");

require_once '../model/model.php';
require_once '../view/view.php';

class Controller
{
    private $view;
    private $model;	

    public function __construct(){
    	$this->model = new Model ();
        $this->view = new View();
    }

    public function service() {
	   if (isset($_GET['action']) && !empty($_GET['action'])) {
            if ($_GET['action'] == "getDocumentByFormat") {
   	            $this->{$_GET['action']}($_GET['format']);
            } else if ($_GET['action'] == "getAllDocuments") {
                $this->{$_GET['action']}();
            } else if ($_GET['action'] == "getDocumentByType") {
                $this->{$_GET['action']}($_GET['type']);
            } else if ($_GET['action'] == "addDocument") {
                $this->{$_GET['action']}($_GET['author'], $_GET['title'], $_GET['nrpages'], $_GET['format'], $_GET['type']);
            } else if ($_GET['action'] == "updateDocument") {
                $this->{$_GET['action']}($_GET['documentid'], $_GET['author'], $_GET['title'], $_GET['nrpages'], $_GET['format'], $_GET['type']);
            } else if ($_GET['action'] == "removeDocument") {
                $this->{$_GET['action']}($_GET['documentid']);
            }
	   }
    }


    private function getAllDocuments() {
       $documents = $this->model->getAllDocuments();
       return $this->view->output($documents);
    }
    private function getDocumentByFormat($format) {
       $documents = $this->model->getDocumentByFormat($format);
       return $this->view->output($documents);
    }

    private function getDocumentByType($type) {
        $documents = $this->model->getDocumentByType($type);
        return $this->view->output($documents);
    }

    private function addDocument($author, $title, $nrpages, $format, $type) {
        $result = $this->model->addDocument($author, $title, $nrpages, $format, $type);
        if ($result>0) { $r = "Success"; } 
        else { $r = "Failure"; }
        $this->view->returnResult($r);
    }

    private function updateDocument($id, $author, $title, $nrpages, $format, $type) {
        $result = $this->model->updateDocument($id, $author, $title, $nrpages, $format, $type);
        if ($result>0) { $r = "Success"; }
        else { $r = "Failure"; }
        $this->view->returnResult($r);
    }

    private function removeDocument($documentid) {
        $result = $this->model->removeDocument($documentid);
        if ($result>0) { $r = "Success"; }
        else { $r = "Failure"; }
        $this->view->returnResult($r);
    }

}

$controller = new Controller();
$controller->service();

?>
