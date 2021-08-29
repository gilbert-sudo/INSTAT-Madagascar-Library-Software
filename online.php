<!DOCTYPE html>
<html>

<body onload="isOnline();">
	<p id="demo" style="padding-top: 11px"><span id="globe" class="glyphicon glyphicon-circle-arrow-down" aria-hidden="true"></span>&nbsp;</p>
	

	<script>
		function isOnline() {

			if (navigator.onLine) {
				document.getElementById(
				"demo").innerHTML += "Mettre à jour!";
				 document.getElementById("globe").style.color
                                = "green";
			} else {
				document.getElementById(
				"demo").innerHTML += "Hors connexion";
				document.getElementById("globe").style.color
                                = "red";
			}
		}
	</script>

</body>

</html>
