<?php 
session_start();
	$droit = 'membre';
	$pseudo = $_SESSION["pseudo"];
	$bdd = new PDO('mysql:host=localhost;dbname=test', 'root', '' ); // Connexion à la base de données
	$message = $_POST['message']; // message saisi par l'utilisateur
	// Prepare la requete qui est : insert dans le tab 'chat' (catégorie pseudo et message)
	// des valeurs encore non définies ! 
	$recherche = $bdd->query('SELECT * FROM login');


	foreach ($recherche as $quelEstLeDroit) {
		if($quelEstLeDroit['pseudo'] == $_SESSION['pseudo'] AND $quelEstLeDroit['droit'] == 'admin'){
			$droit = 'admin';
		}else if($quelEstLeDroit['pseudo'] == $_SESSION['pseudo'] AND $quelEstLeDroit['droit'] == 'modo'){
			$droit = 'modo';
		}
	}


	$envoi = $bdd->prepare('INSERT INTO chat(pseudo, message, droit) VALUES(:pseudo, :message, :droit) ');
	// Execute la requete, en précisant que les valeurs qui étaient inconnues sont renseignées
	$envoi->execute(array('pseudo' => $pseudo, 'message' => $message, 'droit' => $droit));
	header('Location: index.php');
?>