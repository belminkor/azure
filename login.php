<?php 
	session_start();
?>

<?php

	
	$user = "bela";
	$pass = "1234";

	try{
		$conn = new PDO("mysql:dbname=hotel-database; host=localhost; charset=utf8", $user, $pass);

		$zaposlenik = $conn->query("select ID, Ime, Prezime, KorisnickoIme, RadnoMjesto, IDPozicija from zaposlenici");
		$pozicija = $conn->query("select ID, Naziv, NivoPristupa from pozicija");
		$mjesto = $conn->query("select ID, Lokacija from hoteli");

		$pozicija1 = $conn->query("select ID, Naziv, NivoPristupa from pozicija");
		$mjesto1 = $conn->query("select ID, Lokacija from hoteli");	
		$result = $zaposlenik->fetchAll(PDO::FETCH_ASSOC);	
    	
	}
	catch(PDOException $ex)
	{
		echo $ex->getMessage();
	}

?>

<!DOCTYPE html>
<html>
<head>
	<title>Profil</title>
	<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Lato">
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Leckerli+One">
  <link rel="stylesheet" href="style.css">
  

  
</head>
<body>
	<nav class="navbar navbar-inverse navbar-fixed-top">
  <div class="container-fluid">
    <div class="navbar-header">
      <img id="logo-navbar" src="images/hotel-logo.png">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav" id="navigacija-lijevo">
      </ul>
      <ul class="nav navbar-nav navbar-right" id="navigacija-desno">
        <li class="nav-link"><a href="index.php">Početna</a></li>
        <li class="nav-link"><a href="#">O nama</a></li>
        <li class="nav-link"><a href="#">Rezervacije</a></li>
        
        
		    	    	<?php
		    	    		if(isset($_SESSION["loggedUsername"]) && !empty($_SESSION["loggedUsername"]))
							{ 
								?>
								<li class="usernameLogin"> <a href="login.php">

								<?php
								echo $_SESSION['loggedUsername'];

							}
							else {
								?>
								<li class="nav-link"><a id="login-dugme" type="button" data-toggle="modal" data-target="#loginModal">Prijava</a></li>

								<?php
							}
		    	    	?>
		    	    	</a>
		    	    </li>
      </ul>
    </div>
  </div>
</nav>
<br>

	<div class="container-fluid">
		 
				<?php
					if(isset($_SESSION["loggedUsername"]) && !empty($_SESSION["loggedUsername"])) { 
				?>
			<div class="row">
			<div class="col-md-4 col-sm-4 col-xs-12 text-center"> 
				
				<div class="okvir">
					<?php 
					if($_SESSION['loggedPozicija'] == 1 || $_SESSION['loggedPozicija'] == 2) {
					?>
					<img src="https://www.w3schools.com/w3css/img_avatar3.png">
					<?php 
					}
					else { ?>
						<img src="https://i2.wp.com/cdn2.iconfinder.com/static/2ae174f07522a6b8c7c997bf4b62a821/assets/img/default-avatar-user.png?ssl=1">
					<?php
					} 
					?>
				</div>
				
			</div>
			
			<div class="col-md-7 col-sm-7 col-xs-12 text-left">
						<h1>
						<?php 
						foreach ($pozicija as $p) {  
							if($p['ID'] == $_SESSION['loggedPozicija']) {
								echo $p['Naziv'].", ".$_SESSION['loggedIme'];
							}
						}
						?>
						</h1>
						<br>
						<h2>Osnovni podaci</h2>
						<hr>
						
						<h3>Ime:
						<?php 
							echo $_SESSION['loggedIme'];
						?>

						</h3>

						<h3>Prezime:
						<?php 
							echo $_SESSION['loggedPrezime'];
						?>	
						</h3>
			
								 
				
  						<h3>Korisničko ime: <?php 
  								echo $_SESSION['loggedUsername'];
  							?>
  						</h3>
  						<h3>Id: <?php 
  							echo $_SESSION['id'];
  							?> 
  						</h3>
  						<h3>Radno mjesto: 
  						<?php
  							foreach ($mjesto as $m) {
  								if($m['ID'] == $_SESSION['loggedMjesto']) {
  									echo $m['Lokacija'];
  								}
  							}
  							
  							?>
  						</h3>
  						<hr>

  						<?php 
  						if($_SESSION['loggedPozicija'] == 1 || $_SESSION['loggedPozicija'] == 2)
  						{
  						?>
  						<br>
  						<button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal3">
			  				Registracija novog zaposlenika
						</button>
						<br><br>
						<button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal4">
			  				Svi zaposlenici
						</button>
						<?php 
						}
						else if($_SESSION['loggedPozicija'] == 4) {
						?>
						<button type="button" class="btn btn-primary btn-lg" onclick="">
			  				Check in
						</button>
						<button type="button" class="btn btn-primary btn-lg" onclick="">
			  				Check out
						</button>

						<?php 
						}
						?>
						</div>

			<div class="col-md-1 col-sm-1 col-xs-12 text-center"> 
				
			</div>
		</div>
		<br>
		<div class="row">
							<div class="col-md-3 col-sm-3 col-xs-12 text-center"> 
								<button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#editModal">
			  						Izmjena podataka
								</button>
							</div>

							<div class="col-md-7 col-sm-7 col-xs-12 text-center"> 

							</div>

							<div class="col-md-2 col-sm-2 col-xs-12 text-center"> 
								<form action="signout.php" method="POST">
							<button type="submit" class="btn btn-default"> Odjavi se </button>
						</form>
							</div>
						</div>
					
						

						<?php 
						 } 
						 else { 
					    ?>
					    	<div style="text-align: center; padding: 100px;">
					    	<h1 style="text-align: center">Niste prijavljeni?</h1>
							<button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal1">
  							Prijava
							</button>
							</div>
							<br><br><br><br><br><br><br><br><br><br><br><br><br>

							<!-- Button trigger register modal -->
							<!--<button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal2">
			  				Sign up
							</button> -->
					<?php	}  ?>

					
				
				<!-- Button trigger login modal -->
				

						
		
	</div>
	<br><br><br><br><br><br>
<div id=footer>
 <h3 class="text-center">CopyrightⒸ  Azure 2017</h3>
</div>

<!-- Modal1 Login-->
<div class="modal fade" id="myModal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Prijava</h4>
      </div>
      <div class="modal-body">
        <div class="container-fluid">
			<div class="row">
			<div class="col-md-1 col-sm-1 col-xs-12 text-center"> 
				
			</div>
			
			<div class="col-md-10 col-sm-10 col-xs-12 text-center"> 
				<span class="glyphicon glyphicon-user" style="font-size: 3em"></span>
				<br><br>
				<form action="signin.php" method="post">
				<div class="form-group">
    				<label for="exampleInputEmail1">Korisničko ime</label>
    				<input type="username" class="form-control" id="exampleInputUsername1" placeholder="Username" name="logUsername">
  				</div>
  				<br>
  				<div class="form-group">
    				<label for="exampleInputPassword1">Šifra</label>
    				<input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password" name="logPassword">
  				</div>
  				<br>
  				<button type="button" class="btn btn-default" data-dismiss="modal">Zatvori</button>
        		<button type="submit" class="btn btn-primary" name="submitReg">Potvrdi</button>
        		</form>
  				
  				

			</div>

			<div class="col-md-1 col-sm-1 col-xs-12 text-center"> 
				
			</div>
		</div>
	</div>
      </div>
      
    </div>
  </div>
</div>

<!-- Modal2 Registracija -->
<div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Registracija</h4>
      </div>
      <div class="modal-body">
        <div class="container-fluid">
			<div class="row">
			<div class="col-md-1 col-sm-1 col-xs-12 text-center"> 
				
			</div>
			
			<div class="col-md-10 col-sm-10 col-xs-12 text-center"> 
				<form action="registration.php" method="post">
				<div class="form-group">
					<span class="glyphicon glyphicon-pencil" style="font-size: 3em"></span>
					<br><br>
    				<label for="exampleInputEmail1">Korisničko ime</label>
    				<input type="username" class="form-control" id="exampleInputUsername1" placeholder="Username" name="username">
  				</div>
  				<br>
  				<div class="form-group">
    				<label for="exampleInputPassword1">Šifra</label>
    				<input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password" name="password">
  				</div>
  				<br>
  				<div class="form-group">
    				<label for="exampleInputPassword1">Potvrdite šifru</label>
    				<input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password" name="rePassword">
  				</div>
  				<br>
  				<div class="form-group">
    				<label for="exampleInputEmail1">Email</label>
    				<input type="email" class="form-control" id="exampleInputEmail1" placeholder="Email" name="email">
  				</div>
  				<br>

  				

  				<button type="button" class="btn btn-default" data-dismiss="modal">Zatvori</button>
        		<button type="submit" class="btn btn-primary" name="submitReg">Potvrdi</button>
  				</form>
  				
  				

			</div>

			<div class="col-md-1 col-sm-1 col-xs-12 text-center"> 
				
			</div>
		</div>
	</div>
      </div>
      
    </div>
  </div>
</div>

<!-- Modal3 Registracija novog zaposlenika -->
<div class="modal fade" id="myModal3" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Registracija novog zaposlenika</h4>
      </div>
      <div class="modal-body">
        <div class="container-fluid">
			<div class="row">
			<div class="col-md-1 col-sm-1 col-xs-12 text-center"> 
				
			</div>
			
			<div class="col-md-10 col-sm-10 col-xs-12 text-center"> 
				<form action="registration.php" method="post">

				<div class="form-group">
					<span class="glyphicon glyphicon-pencil" style="font-size: 3em"></span>
					<br><br>
    				<label for="exampleInputEmail1">Ime</label>
    				<input type="text" class="form-control" id="exampleInputName1" placeholder="Name" name="ime">
  				</div>
  				<br>
  				<div class="form-group">
    				<label for="exampleInputPrezime1">Prezime</label>
    				<input type="text" class="form-control" id="exampleInputPrezime1" placeholder="Last name" name="prezime">
  				</div>
  				<br>
				<div class="form-group">
    				<label for="exampleInputEmail1">Korisničko ime</label>
    				<input type="username" class="form-control" id="exampleInputUsername1" placeholder="Username" name="username">
  				</div>
  				<br>
  				<div class="form-group">
    				<label for="exampleInputPassword1">Šifra</label>
    				<input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password" name="password">
  				</div>
  				<br>
  				<div class="form-group">
    				<label for="exampleInputPassword1">Unesite ponovo šifru</label>
    				<input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password" name="rePassword">
  				</div>
  				<br>

  				<label for="pozicije">Pozicija</label> <br>
  				<select class="form-control" name="pozicija">
					<?php foreach ($pozicija1 as $po) { ?>
				
					<option value="<?php echo $po['ID'] ?>"> <?php echo $po['Naziv']; ?> </option>
			
					<?php } ?>
				</select>
				<br>
				<label for="radnoMjesto">Radno Mjesto</label> <br>
  				<select class="form-control" name="radnoMjesto">
					<?php foreach ($mjesto1 as $mj) { ?>
				
					<option value="<?php echo $mj['ID'] ?>"> <?php echo $mj['Lokacija']; ?> </option>
			
					<?php } ?>
				</select>

				
				<br><br><br>
  				<button type="button" class="btn btn-default" data-dismiss="modal">Zatvori</button>
        		<button type="submit" class="btn btn-primary" name="submitReg">Potvrdi</button>
  				</form>
  				
  				

			</div>

			<div class="col-md-1 col-sm-1 col-xs-12 text-center"> 
				
			</div>
		</div>
	</div>
      </div>
      
    </div>
  </div>
</div>
<!-- Modal Edit profila-->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Izmjena korisničkih podataka</h4>
      </div>
      <div class="modal-body">
        <div class="container-fluid">
			<div class="row">
			<div class="col-md-1 col-sm-1 col-xs-12 text-center"> 
				
			</div>
			
			<div class="col-md-10 col-sm-10 col-xs-12 text-center"> 
				<form action="editprofile.php" method="post">
				<div class="form-group">
					<div class="form-group">
					<span class="glyphicon glyphicon-pencil" style="font-size: 3em"></span>
					<br><br>
    				<label for="exampleInputEmail1">Ime</label>
    				<input type="username" class="form-control" id="exampleInputUsername1" placeholder="Username" name="novoIme">
  				</div>
  				<br>
  				<div class="form-group">
    				<label for="exampleInputEmail1">Prezime</label>
    				<input type="username" class="form-control" id="exampleInputUsername1" placeholder="Username" name="novoPrezime">
  				</div>
  				<br>
  				<div class="form-group">
    				<label for="exampleInputEmail1">Novo korisničko ime</label>
    				<input type="username" class="form-control" id="exampleInputUsername1" placeholder="Username" name="noviUsername">
  				</div>
  				<br>
  				<div class="form-group">
    				<label for="exampleInputPassword1">Nova šifra</label>
    				<input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password" name="noviPassword">
  				</div>
  				<br>
  				<!--<div class="form-group">
    				<label for="exampleInputPassword1">Confirm Password</label>
    				<input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password" name="noviRePassword">
  				</div>
  				<br> -->

  				

  				<button type="button" class="btn btn-default" data-dismiss="modal">Zatvori</button>
        		<button type="submit" class="btn btn-primary" name="submitReg">Potvrdi</button>
  				</form>
  				
  				

			</div>

			<div class="col-md-1 col-sm-1 col-xs-12 text-center"> 
				
			</div>
		</div>
	</div>
      </div>
      
    </div>
  </div>
</div>
</div>

<!-- Modal4 Svi zaposlenici -->
<div class="modal fade" id="myModal4" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Svi zaposlenici</h4>
      </div>
      <div class="modal-body">
        <div class="container-fluid">
			<div class="row">
			<div class="col-md-1 col-sm-1 col-xs-12 text-center"> 
				
			</div>
			
			<div class="col-md-10 col-sm-10 col-xs-12 text-center"> 
				
				<div class="form-group">
				<span class="glyphicon glyphicon-briefcase" style="font-size: 3em"></span>
				<br><br>
				<table class="tabela" style="border: 1px solid; text-align: left; border-collapse: collapse; width: 100%; padding: 10px;">
					<tr style="border: 1px solid">
						<th>ID</th>
						<th>Ime</th>
						<th>Prezime</th>
						<th>Pozicija</th>
						<th>Radno mjesto</th>
					</tr>

    			<?php foreach ($result as $r) { 
					?>
					<tr> 
						<td>
					<?php
					echo $r['ID'];
					?>
						</td>
						<td>
						<?php
					echo $r['Ime'];
					?>
					</td>
					<td>
					<?php 
					echo $r['Prezime'];
					?>
					</td>
					<td>
					<?php 
					
					if($r['IDPozicija'] == 1) {
							echo "CEO";	
					}
					else if($r['IDPozicija'] == 2) {
						echo "Hotel manager";
					}
					else if($r['IDPozicija'] == 3) {
						echo "Finansije";
					}
					else if($r['IDPozicija'] == 4) {
						echo "Recepcija";
					}
					else if($r['IDPozicija'] == 5) {
						echo "Restoran";
					}
					else if($r['IDPozicija'] == 6) {
						echo "Kuhinja";
					}
					else if($r['IDPozicija'] == 7) {
						echo "Odrzavanje";
					}
						
					
					
					?>
					</td>
					<td>
					<?php 
					
  					if($r['RadnoMjesto'] == 1) {
  						echo "Dubrovnik";
  					}
  					else {
  						echo "Ibiza";	
  					}
  							
					?>
					</td>
					</tr>
					<?php
					} ?>

  				</table>
  				<br><br>
  				<button type="button" class="btn btn-default" data-dismiss="modal">Zatvori</button>
        		
  				
  				

			</div>

			<div class="col-md-1 col-sm-1 col-xs-12 text-center"> 
				
			</div>
		</div>
	</div>
      </div>
      
    </div>
  </div>
</div>
</div>




</body>
</html>