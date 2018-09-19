<?php
	
	session_start();



	
	if(isset($_SESSION["loggedUsername"]) && !empty($_SESSION["loggedUsername"]))
	{ 


		echo '<h2> Dobrodosli, '.$_SESSION['loggedUsername']."</h2>"; 
?>
		<form action="signout.php" method="POST">
			<button type="submit" class="btn btn-default"> Odjavi se </button>
		</form>
	<?php 
    }
	else
	{
		header("Location: index.php");
	}


?>


