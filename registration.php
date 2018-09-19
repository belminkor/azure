<?php

include 'dbconnect.php';



if(isset($_POST['username'], $_POST['password'], $_POST['ime'], $_POST['prezime'], $_POST['pozicija']) && (!empty($_POST['username'])) && (!empty($_POST['password'])) && (!empty($_POST['ime'])) && (!empty($_POST['prezime'])) && (!empty($_POST['pozicija'])) && $_POST['password'] == $_POST['rePassword']) {

	$var1 = $_POST['password'];
	$var2 = $_POST['username'];
	$var4 = $_POST['ime'];
	$var5 = $_POST['prezime'];
	$var6 = $_POST['pozicija'];
	$var3 = $_POST['radnoMjesto'];

	$provjera = $conn->prepare("SELECT KorisnickoIme FROM zaposlenici WHERE KorisnickoIme = :name");
    $provjera->bindParam(':name', $var2);
    $provjera->execute();

    if($provjera->rowCount() > 0){
        echo "<h1>Korisničko ime je zauzeto.</h1>";
        header( "refresh:5;url=login.php" );
    } 
    else {
    
	$hashPassword = md5($var1);


	//prepare statement
	$registracija = $conn->prepare("
		INSERT INTO zaposlenici (Ime, Prezime, KorisnickoIme, Sifra, RadnoMjesto, IDPozicija) VALUES (?,?,?,?,?,?)

		");
	$registracija->bindParam(1, $var4, PDO::PARAM_STR);
	$registracija->bindParam(2, $var5, PDO::PARAM_STR);
	$registracija->bindParam(3, $var2, PDO::PARAM_STR);
	$registracija->bindParam(4, $hashPassword, PDO::PARAM_STR);
	$registracija->bindParam(5, $var3, PDO::PARAM_STR);
	$registracija->bindParam(6, $var6, PDO::PARAM_STR);
	

	$registracija->execute();
	echo "<h1>Dodan novi zaposlenik</h1>";
	header( "refresh:5;url=login.php" );
	}
}
else {
	echo "<h1>Niste unijeli sve podatke.</h1>";
	header( "refresh:5;url=login.php" );
}

?>