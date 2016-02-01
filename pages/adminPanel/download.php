<?php
	session_start();
	if(isset($_SESSION['userType'])){
		if($_SESSION['userType']==1){
			if(isset($_GET['fileName'])){
			$file = 'backups/'.$_GET['fileName'];
				if (file_exists($file)) {

					header('Content-Description: File Transfer');
					header('Content-Type: application/octet-stream');
					header('Content-Disposition: attachment; filename='.basename($file));
					header('Expires: 0');
					header('Cache-Control: must-revalidate');
					header('Pragma: public');
					header('Content-Length: ' . filesize($file));
					readfile($file);
					exit;
				}
			}
		}
	}
?>