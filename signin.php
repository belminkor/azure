<?php
include 'dbconnect.php';

if(isset($_POST['logUsername'], $_POST['logPassword']) && (!empty($_POST['logUsername']) && !empty($_POST['logPassword'])) )
{
	$var1 = $_POST['logUsername'];
	$var2 = $_POST['logPassword'];

	$login = $conn->prepare("
		SELECT ID, Ime, Prezime, KorisnickoIme, Sifra, RadnoMjesto, Spol, IDPozicija FROM zaposlenici WHERE ? = KorisnickoIme 
		");
	$login->bindParam(1, $var1, PDO::PARAM_STR);
	$login->execute();

	$result = $login->fetch(PDO::FETCH_ASSOC);
	

	if(!empty($result))
	{
		$hashPasswordFromDB = $result['Sifra'];
		$hashPasswordTyped = md5($var2);
		if($hashPasswordTyped == $hashPasswordFromDB) 
		{
			session_start();
			$_SESSION["loggedUsername"] = $result["KorisnickoIme"];
			$_SESSION["id"] = $result["ID"];
			$_SESSION["loggedEmail"] = $result["email"];
			$_SESSION['loggedIme'] = $result["Ime"];
			$_SESSION['loggedPrezime'] = $result["Prezime"];
			$_SESSION['loggedPozicija'] = $result["IDPozicija"]; 
			$_SESSION['loggedMjesto'] = $result["RadnoMjesto"];

			//echo "welcome".$_SESSION["loggedUsername"];
			header('Location: login.php');

		}
		else {
			echo "<h1>Pogrešan username/password</h1>";
			header( "refresh:5;url=index.php" );
		}
	}
	else {
		echo "<h1>Pogrešan username/password</h1>";
		header( "refresh:5;url=index.php" );
	}
}
else {
	echo "<h1>Niste unijeli username/password</h1>";
	header( "refresh:5;url=index.php" );
}
?>