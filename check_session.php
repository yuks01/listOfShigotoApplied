<?php 
	session_start();
	if( isset($_SESSION['user']) ) print 'authentified';
?>