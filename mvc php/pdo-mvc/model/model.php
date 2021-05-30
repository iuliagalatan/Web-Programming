<?php

require_once '../repo/DBUtils.php';
require_once 'entity/document.php';



class Model {
	private $db;

	public function __construct() {
		$this->db = new DBUtils ();
	}

	public function getDocumentByType($type) {
		$resultset = $this->db->selectDocumentsByType($type);
		$documents = array();
		foreach($resultset as $key=>$val) {
			$doc = new Document($val['documentid'], $val['author'], $val['title'], $val['nrpages'], $val['format'], $val['type']);
			array_push($documents, $doc);
		}
		return $documents;
	}

	public function getDocumentByFormat($format) {
		$resultset = $this->db->selectDocumentsByFormat($format);
		$documents = array();
		foreach($resultset as $key=>$val) {
			$doc = new Document($val['documentid'], $val['author'], $val['title'], $val['nrpages'], $val['format'], $val['type']);
			array_push($documents, $doc);
		}
		return $documents;
	}

	public function getAllDocuments() {
		$resultset = $this->db->selectAllDocuments();
		$documents = array();
		foreach($resultset as $key=>$val) {
			$doc = new Document($val['documentid'], $val['author'], $val['title'], $val['nrpages'], $val['format'], $val['type']);
	    	array_push($documents, $doc);
		}

	    return $documents;
	}

	
	public function addDocument($author, $title, $nrpages, $format, $type) {
		return $this->db->addDocumentForDocuments($author, $title, $nrpages, $format, $type);
	}

	public function updateDocument($documentid,$author, $title, $nrpages, $format, $type) {
		return $this->db->updateDocumentForDocuments($documentid,$author, $title, $nrpages, $format, $type);
	}

	public function removeDocument($documentid) {
		return $this->db->removeDocumentForDocuments($documentid);
	}

}

?>
