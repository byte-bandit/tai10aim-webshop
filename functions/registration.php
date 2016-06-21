<?php
  require_once('../../confidential/_GLOBALS.php');
  require_once('../class/classloader.php');
  session_start();
function showRegistration($name,$prename,$login,$email)
{
?>
	<form method="POST" action='registration_func.php'>
		<input name='name' type='text' placeholder='Name' value='<?=$name?>' required autofocus> Ihr Name</input> <br/>
		<input name='prename' type='text' placeholder='Vorname' value='<?=$prename?>' > Ihr Vorname</input><br/><br/>
		<input name='login' type='text' placeholder='Anmeldename' value='<?=$login?>' required> Ihr Anmeldename</input><br/>
		<input name='mail1' type='email' placeholder='Email-Adresse' value='<?=$email?>' required> Ihre Email-Adresse</input><br/>
		<input name='mail2' type='email' placeholder='Email-Adresse' value='<?=$email?>' required> Zur Sicherheit gleich nochmal</input><br/><br/>

		<input name='pw1' type='password' placeholder='Passwort' required> Ihr Passwort</input><br/>
		<input name='pw2' type='password' placeholder='Passwort' required> Zur Sicherheit gleich nochmal</input><br/><br/><br/>

		<input type='checkbox' name='agb' required /> Hiermit bestätige ich, dass ich alles Rechtliche gelesen habe und mit den <a href='../data/agb.php' target="_blank">AGB´s</a> einverstanden bin<br />

		<input type='Submit' Value='Registrieren'>
	</form>
<?
}
?>
<html>
	<head >
		<title>Registrierung beim Web Shop</title>
		<link href="../style.css" rel="stylesheet" type="text/css" />
	</head>
	<body id="register">
		<h1>
		Registrierung
		</h1>
		<?php
		$name=NULL;
		$prename=NULL;
		$login=NULL;
		$mail=NULL;
		$pw_bool=false;

		if(isset($_POST["mail1"]))
		{
			$mail=$_POST["mail1"];
		}

		if(isset($_POST["login"]))
		{
			$login=$_POST["login"];
		}

		if(isset($_POST["name"]))
		{
			$name=$_POST["name"];
		}

		if(isset($_POST["pw1"]))
		{
			$pw_bool=True;
		}

		if(isset($_POST["prename"]))
		{
			$prename=$_POST["prename"];
		}

		if($_POST["mail1"]!=$_POST["mail2"])
		{
			echo("<p style='color:red;'>Bitte überprüfen sie nochmal die eingegebenen E-Mail-Adressen</p>");
			$mail=NULL;
		}

		if($_POST["pw1"]==$_POST["pw2"])
		{
			$pw_bool=True;
		}
		else{
			echo("<p style='color:red;'>Bitte überprüfen sie nochmal die eingegebenen Passwörter</p>");
			$pw_bool=false;
		}

		showRegistration($name,$prename,$login,$mail);

		?>
	</body>
</html>