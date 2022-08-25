<?php
include_once 'config.php';

	$topic = explode('/', $_GET["topic"]);
	$msg = $_GET["message"];
	echo $_GET["topic"];
	echo '<br>';
	echo $_GET["message"];
	echo '<br>';

	$topic_len = count($topic);

	$chheader = 0;

	if ($topic[0] == "IsAlive")
	{
		if ($topic_len > 1)
		{
			if ($topic[1] == "all")
			{
           mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
                //On établit la connexion
                $conn = new mysqli($servername, $username, $password);

	            //On vérifie la connexion
        	    if($conn->connect_error){
                	die('Erreur : ' .$conn->connect_error);
                }

	            $conn->real_query('update mysql.mac set alive = "0"');
				echo "All alive reset";
				$chheader = 1;
			}
		}
	}

	$cmd = "/home/pi/mqtt.sh " . $_GET["topic"] . ' "' . $_GET["message"] . '"';

	$result = system($cmd);
	echo "<br>" . $result;
	echo "<br> en cour";

	if ($chheader == 1) {
		sleep(2);
		header("Location: index.php");
	}
?>
