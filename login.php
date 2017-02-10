<?php 
	$connect = false;
	$bdd = new PDO('mysql:host=localhost;dbname=test', 'root', '' );
	if(isset($_POST['pseudo'], $_POST['password'])){
		session_start();
		$_SESSION['pseudo']= $_POST['pseudo'];
		$_SESSION['password']= $_POST['password'];

		$utilisateurs = $bdd->query("SELECT * FROM login");
		foreach ($utilisateurs as $key => $login) {
			if($login['pseudo'] == $_SESSION['pseudo'] AND $login['password'] == $_SESSION['password']){
				$connect = true;
			}
		}

		if($connect == false){
			session_unset(); 
			session_destroy();
		}
	}
	header('Location: index.php');
?>