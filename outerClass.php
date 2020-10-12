<?php

require_once('pages/database/db.php');

class GlobalConnection
{

	private $conn;

		
	function getDate(){
		$tz_oject = new DateTimeZone('Asia/manila');
		$datetime = new DateTime();
		$datetime->setTimezone($tz_oject);
		return $datetime->format('Y-m-d');
	}



}


?>