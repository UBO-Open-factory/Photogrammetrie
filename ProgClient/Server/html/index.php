<html>
	<head>
		<title>Home sweet home</title>
		<meta charset="utf-8">
	</head>
	<body>
		<h1>Bases de données MySQL</h1>
		<?php
			$servername = 'ip.of.the.db';
			$username = 'db_username';
			$password = 'db_password';

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
					echo "<br>Client " . $row['address'] . " [Alive]";
					echo '<input type="text" placeholder="why reboot", id="Reboot' . $row['address'] . '"/><button class="RebootBut" data-name="RebootSolo" value="' . $row['address'] . '" type="button">Reboot</button>';
					echo '<input type="text" placeholder="why shutdown", id="Shutdown' . $row['address'] . '"/><button class="ShutdownBut" data-name="ShutdownSolo" value="' . $row['address'] . '" type="button">Shutdown</button>';
					echo '<button class="IsAliveBut" data-name="IsAliveSolo" value="' . $row['address'] . '" type="button">Is alive/flash</button>';
					echo '<button class="FlashBut" data-name="FlashSolo" value="' . $row['address'] . '" type="button">Stop flash</button>';
				}
				else
				{
					echo "<br>Client " . $row['address'] . " [Not alive]";
					echo '<button class="IsAliveBut" data-name="IsAliveSolo" value="' . $row['address'] . '" type="button">Is alive</button>';
				}
				echo '<button class="RemoveBut" data-name="RemoveSolo" value="' . $row['address'] . '" type="button">Remove</button>';
			}

			echo '<br><button><a href="preview.php">Photo</a></button>';
			echo '<br><button><a href="mqtt.php?topic=IsAlive/all&amp;message=is%20alive"> IsAlive </a></button>';
			echo '<br><button class="RemoveBut" data-name="Remove" type="button">Remove all no alive</button>';
			echo '<br><input type="text" placeholder="why reboot", id="Reboot"/><button class="RebootBut" data-name="Reboot" type="button">Reboot all</button>';
			echo '<br><input type="text" placeholder="why shutdown", id="Shutdown"/><button class="ShutdownBut" data-name="Shutdown" type="button">Shutdown all</button>';

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

	var RemoveBut = document.getElementsByClassName("RemoveBut");
	for(var i = 0; i < RemoveBut.length; i++) {
		RemoveBut[i].addEventListener("click", makeRequest);
	}

	var httpRequest;
	var action;
	httpRequest = new XMLHttpRequest();

	function makeRequest() {
		var txt;
		var url;
		var mac;
		action = this.getAttribute('data-name');

		switch(action)
		{
			case "Photo":
				txt = document.getElementById("project").value;
				txt = txt.replace(/ /g, '_');
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
			case "Remove":
				url = 'db.php?mac=all';
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
			case "RemoveSolo":
				mac = this.getAttribute('value');
				url = 'db.php?mac=';
				url = url.concat(mac);
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
				if ((action == "IsAliveSolo") || (action == "RemoveSolo") || (action == "Remove")) {
					window.location.reload();
				}
			} else {
				alert('There was a problem with the request.');
			}
		}
	}
})();
</script>

