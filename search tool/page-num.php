<?php
	session_start();

	echo 'Page ' . ($_SESSION['currentSearchPage']+1) . ' of ' . $_SESSION['numofpages'];

?>