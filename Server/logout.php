<?php
	session_start();
	session_unset();
	session_destroy();
	header("location: ../WebClient/index.php");
?>