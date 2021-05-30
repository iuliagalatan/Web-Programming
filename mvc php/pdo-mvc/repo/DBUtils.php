<?php



class DBUtils {
	private $host = '127.0.0.1';
	private $db   = 'lab5';
	private $user = 'root';
	private $pass = '';
	private $charset = 'utf8';	

	private $pdo;
	private $error;

	public function __construct () {
		$dsn = "mysql:host=$this->host;dbname=$this->db;charset=$this->charset";
		$opt = array(PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
			PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
			PDO::ATTR_EMULATE_PREPARES   => false);
		try {
			$this->pdo = new PDO($dsn, $this->user, $this->pass, $opt);		
		} // Catch any errors
		catch(PDOException $e){
			$this->error = $e->getMessage();
			echo "Error connecting to DB: " . $this->error;
		}
	}

	public function selectDocumentsByType($type) {
        $stmt = $this->pdo->query("SELECT * FROM documents where type='" . $type ."'");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function selectDocumentsByFormat($format) {
            $stmt = $this->pdo->query("SELECT * FROM documents where format='" . $format ."'");
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

    public function selectAllDocuments() {
    	$stmt = $this->pdo->query("SELECT * FROM documents");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    

	public function addDocumentForDocuments($author, $title, $nrpages, $format, $type) {
		$affected_rows = $this->pdo->exec("INSERT into documents(author, title, nrpages, format, type) values( " . "'" .
							$author."'". " , '" . $title . "', " . $nrpages .  ", '" . $format .  "', " . "'".$type ."')");
		return $affected_rows;
	}

	public function updateDocumentForDocuments($documentid, $author, $title, $nrpages, $format, $type) {
		$affected_rows = $this->pdo->exec("UPDATE documents set author=" . "'" . $author .
						    "' , title = " . "'". $title . "', nrpages = " . $nrpages . ", format = '" . $format . + "', type = " ."'". $type . "' where doc_id=" . $documentid );
		return $affected_rows;
	}

	public function removeDocumentForDocuments($documentid) {
		$affected_rows = $this->pdo->exec("DELETE from documents where doc_id=" . $documentid);

		return $affected_rows;
	}


	private function select($table) {
		$stmt = $this->pdo->query("SELECT * FROM " . $table);
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}

	private function insert($id, $value) {
		$affected_rows = $this->pdo->exec("INSERT into table values(" . $id . ",'" . $value ."');");
		return $affected_rows;
	}

	private function delete ($id) {
		$affected_rows = $this->pdo->exec("DELETE from table where id=" . $id);
		return $affected_rows;
	}

	private function update ($id, $value) {
		$affected_rows = $this->pdo->exec("UPDATE table SET field='" . $value ."' where id=" . $id);

	}
}
 

?>

