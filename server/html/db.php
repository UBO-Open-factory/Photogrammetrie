 <?php
	include_once 'config.php';

	mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
	//On établit la connexion
	$conn = new mysqli($servername, $username, $password);

	//On vérifie la connexion
	if($conn->connect_error){
		die('Erreur : ' .$conn->connect_error);
	}
	$cmd = 0;

	if ($_GET['mac'] == 'all')
	{
		$cmd = 'DELETE FROM mysql.mac WHERE alive="0"';
	}
	else
	{
		$cmd = 'DELETE FROM mysql.mac WHERE address="'. $_GET['mac'] .'"';
	}

	echo $cmd;
	$conn->real_query($cmd);
	$result = $conn->use_result();

	echo $result;
	$conn->close
?>
