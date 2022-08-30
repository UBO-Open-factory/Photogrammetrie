<html>
	<head>
		<title>Preview</title>
		<meta charset="utf-8">
	</head>
	<body>
		<h1>Preview</h1>
		<?php

include_once 'config.php';

			echo '<a href="index.php"> Back </a>';

			mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
			//On établit la connexion
			$conn = new mysqli($servername, $username, $password);

			//On vérifie la connexion
			if($conn->connect_error){
				die('Erreur : ' .$conn->connect_error);
			}

			$conn->real_query("SELECT * FROM mysql.mac");
			$result = $conn->use_result();

			foreach ($result as $row) {
				if ($row['alive'] == 1)
				{
					$path = '/var/www/html/Preview/'. $row['address'] .'.jpg';
					if (!file_exists($path))
					{
						$cmd = "curl -f http://169.254.138.104/mqtt.php?topic=Photo/" . $row['address'] . "/send&message=Preview -o /dev/null > /dev/null 2> /dev/null";
						exec($cmd);
					}
					echo "<br>Client " . $row['address'] . " [Alive]";
					echo '<button class="PhotoBut" data-name="PhotoSolo" value="' . $row['address'] . '" type="button"><img src="Preview/'. $row['address'] .'.jpg?1" id="'. $row['address'] .'"></button>';
					echo '<button class="IsAliveBut" data-name="IsAliveSolo" value="' . $row['address'] . '" type="button">Start flash</button>';
					echo '<button class="FlashBut" data-name="FlashSolo" value="' . $row['address'] . '" type="button">Stop flash</button>';
				}
			}

			echo '<br><input type="text" placeholder="Entrez nom projet", id="project"/><button class="PhotoBut" data-name="Photo" type="button">Photo all</button>';

			$conn->close
		?>
	</body>
</html>

<script>
(function() {
	var PhotoBut = document.getElementsByClassName("PhotoBut");
	for(var i = 0; i < PhotoBut.length; i++) {
		PhotoBut[i].addEventListener("click", makeRequest);
	}

	var RebootBut = document.getElementsByClassName("RebootBut");
	for(var i = 0; i < RebootBut.length; i++) {
		RebootBut[i].addEventListener("click", makeRequest);
	}

	var ShtudownBut = document.getElementsByClassName("ShutdownBut");
	for(var i = 0; i < ShtudownBut.length; i++) {
		ShtudownBut[i].addEventListener("click", makeRequest);
	}

	var IsAliveBut = document.getElementsByClassName("IsAliveBut");
	for(var i = 0; i < IsAliveBut.length; i++) {
		IsAliveBut[i].addEventListener("click", makeRequest);
	}

	var FlashBut = document.getElementsByClassName("FlashBut");
	for(var i = 0; i < FlashBut.length; i++) {
		FlashBut[i].addEventListener("click", makeRequest);
	}

	var httpRequest;
	var action;
	var mac;
	httpRequest = new XMLHttpRequest();

	function makeRequest() {
		var txt;
		var url;
		action = this.getAttribute('data-name');

		switch(action)
		{
			case "Photo":
				txt = document.getElementById("project").value;
				if (txt[0] === undefined) {
					alert("Enter project name");
					return false;
				}
				txt = txt.replace(/ /g, '_');
				txt = txt.replace(/:/g, '_');
				txt = txt.replace(/\*/g, '_');
				txt = txt.replace(/"/g, '_');
				txt = txt.replace(/\//g, '_');
				txt = txt.replace(/\\/g, '_');
				txt = txt.replace(/\|/g, '_');
				txt = txt.replace(/\?/g, '_');
				txt = txt.replace(/</g, '_');
				txt = txt.replace(/>/g, '_');
				url = 'mqtt.php?topic=Photo/all&message=';
				url = url.concat(txt);
				break;
			case "Reboot":
				txt = document.getElementById("Reboot").value;
				txt = txt.replace(/ /g, '_');
				url = 'mqtt.php?topic=Reboot/all&message=';
				url = url.concat(txt);
				break;
			case "Shutdown":
				txt = document.getElementById("Shutdown").value;
				txt = txt.replace(/ /g, '_');
				url = 'mqtt.php?topic=Shutdown/all&message=';
				url = url.concat(txt);
				break;
			case "PhotoSolo":
				mac = this.getAttribute('value');
                                url = 'mqtt.php?topic=Photo/';
                                url = url.concat(mac, "/send&message=Preview");
                                break;
                        case "RebootSolo":
				mac = this.getAttribute('value');
                                txt = document.getElementById("Reboot".concat(mac)).value;
                                txt = txt.replace(/ /g, '_');
                                url = 'mqtt.php?topic=Reboot/';
                                url = url.concat(mac, "&message=", txt);
                                break;
                        case "ShutdownSolo":
				mac = this.getAttribute('value');
                                txt = document.getElementById("Shutdown".concat(mac)).value;
                                txt = txt.replace(/ /g, '_');
                                url = 'mqtt.php?topic=Shutdown/';
                                url = url.concat(mac, "&message=", txt);
                                break;
			case "IsAliveSolo":
                                mac = this.getAttribute('value');
                                url = 'mqtt.php?topic=IsAlive/';
                                url = url.concat(mac, "&message=is%20alive");
                                break;
			case "FlashSolo":
				mac = this.getAttribute('value');
				url = 'mqtt.php?topic=IsAlive/';
				url = url.concat(mac, "/ok&message=is%20alive");
				break;
			default:
				alert("Error action not defined");
				break;
		}

		if (!httpRequest) {
			alert('Giving up :( Cannot create an XMLHTTP instance');
			return false;
		}

		httpRequest.onload = alertContents;
		httpRequest.open("GET", url, 'true');
		httpRequest.send();
		alert(url);
	}

	function alertContents() {
		if (httpRequest.readyState === XMLHttpRequest.DONE) {
			if (httpRequest.status === 200) {
				//alert(httpRequest.responseText);
				if (action == "PhotoSolo") {
					setTimeout(function (){document.getElementById(mac).src = "Preview/".concat(mac, ".jpg?1", new Date()*Math.random());}, 1000);
				}
				else if (action == "Photo") {
					window.location = "index.php";
				}
			} else {
				alert('There was a problem with the request.');
			}
		}
	}
})();
</script>


