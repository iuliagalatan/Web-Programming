<?php

class Document implements JsonSerializable {
	private $id;
	private $author;
	private $title;
	private $nrpages;	
	private $format;
	private $type;

	public function __construct($id, $author, $title, $nrpages, $format, $type) {
		$this->id = $id;
		$this->author = $author;
		$this->title = $title;
		$this->nrpages = $nrpages;
		$this->format = $format;
		$this->type = $type;

	}

	public function getId() {
		return $this->id;
	}
	public function getName() {
		return $this->author;
	}
	public function getTitle() {
		return $this->title;
	}
	public function getNrpages() {
		return $this->nrpages;
	}
	public function getFormat() {
		return $this->format;
	}


	public function getType() {
		return $this->format;
	}


	public function setName($author) {
		$this->author = $author;
	}
	public function setTitle($title) {
		$this->title = $title;
	}
	public function setNrpages($nrpages) {
		$this->nrpages = $nrpages;
	}
	public function setFormat($format) {
		$this->format = $format;
	}

	public function setType($format) {
		$this->type = $format;
	}

	public function jsonSerialize() {
        $vars = get_object_vars($this);
        return $vars;
    }
}

?>
