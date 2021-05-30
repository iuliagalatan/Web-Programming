<?php

require_once '../model/entity/document.php';

class View
{
    public function __construct() {
    }

    public function outputDocument($doc) {
        /*echo "ID" . $student->getId() . "<br/>";
		echo "Name: " . $student->getName() . "<br/>";
		echo "Password: " . $student->getPassword() . "<br/>";
		echo "Group ID: " . $student->getGroup_id() . "<br/>";*/

		echo json_encode($doc);
    }

    public function output($param) {
    	echo json_encode($param);
    }

    public function returnResult($result) {
        echo "{\"result\" : \"$result\"}";
    }
}

?>
