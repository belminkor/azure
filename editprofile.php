<?php
	include 'dbconnect.php';

	session_start();

	$korisnikID = $_SESSION['id'];

	if(isset($_POST['novoIme']) && (!empty($_POST['novoIme']))) {
		$noviIm = $_POST['novoIme']; 


		$stmt3 = $conn->prepare("UPDATE zaposlenici SET Ime= ? WHERE ID=?");
		$stmt3->bindParam(1,$noviIm, PDO::PARAM_STR);
		$stmt3->bindParam(2,$korisnikID, PDO::PARAM_STR);
		$stmt3->execute();

		echo "<h1>Ime promijenjeno</h1>";
	}

	if(isset($_POST['novoPrezime']) && (!empty($_POST['novoPrezime']))) {
		$novoPre = $_POST['novoPrezime']; 


		$stmt3 = $conn->prepare("UPDATE zaposlenici SET Prezime= ? WHERE ID=?");
		$stmt3->bindParam(1,$novoPre, PDO::PARAM_STR);
		$stmt3->bindParam(2,$korisnikID, PDO::PARAM_STR);
		$stmt3->execute();

		echo "<h1>Prezime promijenjeno</h1>";
	}

	if(isset($_POST['noviUsername']) && (!empty($_POST['noviUsername']))) {
		$noviUser = $_POST['noviUsername'];
		


		$stmt1 = $conn->prepare("UPDATE zaposlenici SET KorisnickoIme=? WHERE ID=?");
		$stmt1->bindParam(1,$noviUser, PDO::PARAM_STR);
		$stmt1->bindParam(2,$korisnikID, PDO::PARAM_STR);


		$stmt1->execute();

		echo "<h1>Korisničko ime promijenjeno</h1>";
	}

	if(isset($_POST['noviPassword']) && (!empty($_POST['noviPassword']))) {
		$noviPass = $_POST['noviPassword'];
		$hashNoviPass = md5($noviPass); 
		

		$stmt2 = $conn->prepare("UPDATE zaposlenici SET Sifra = ? WHERE ID = ?");

		$stmt2->bindParam(1,$hashNoviPass, PDO::PARAM_STR);
		$stmt2->bindParam(2,$korisnikID, PDO::PARAM_STR);
		$stmt2->execute();

		echo "<h1>Šifra promijenjena</h1>";
	}

	header( "refresh:3;url=login.php" );

	


?>