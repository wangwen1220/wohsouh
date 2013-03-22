<?php
class fdService {
	function fdService() {
		
	}
	function logIn($nfo) {
		$user = $nfo[0];
		$password = $nfo[1];
		mysql_connect("localhost", "root", "");
		mysql_select_db("flexdocs");
		$query = "SELECT * FROM `users` WHERE email = '$user'";
		$result = mysql_query($query);
		$row = mysql_fetch_assoc($result);
		if ($row["password"] == $password) {
			$ret[0] = "good";
			$ret[1] = $row["name"];
			$ret[2] = $row["id"];
			return $ret;
		}
		else {
			return "bad";
		}
	}
	
function register($nfo) {
		$user = $nfo[0];
		$password = $nfo[1];
		$friendlyName = $nfo[2];
		mysql_connect("localhost", "root", "");
		mysql_select_db("flexdocs");
		$query = "INSERT INTO `flexdocs`.`users` (`id`, `email`, `password`, `name`) VALUES (NULL, '$user', SHA1('$password'), '$friendlyName');";
		$result = mysql_query($query);
		if ($result == TRUE) {
			return 'good';
		}
		else {
			return 'bad';
		}
	}
	
function getDocs($id) {
	mysql_connect("localhost", "root", "");
	mysql_select_db("flexdocs");
	$query = "SELECT * FROM `docs` WHERE userID = '$id'";
	$result = mysql_query($query);
	while ($row = mysql_fetch_object($result)) {
		$ArrayOfDocs[] = $row;	
	};
	return $ArrayOfDocs;
	}
}
?>