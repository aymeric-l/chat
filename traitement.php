<?php 
session_start();
	$pseudo = $_SESSION["pseudo"];
	$bdd = new PDO('mysql:host=localhost;dbname=test', 'root', '' ); // Connexion à la base de données
	$message = $_POST['message']; // message saisi par l'utilisateur
	// Prepare la requete qui est : insert dans le tab 'chat' (catégorie pseudo et message)
	// des valeurs encore non définies ! 
	$envoi = $bdd->prepare('INSERT INTO chat(pseudo, message) VALUES(:pseudo, :message) ');
	// Execute la requete, en précisant que les valeurs qui étaient inconnues sont renseignées
	$envoi->execute(array('pseudo' => $pseudo, 'message' => $message));
	//header('Location: index.php');
	header('Location: index.php');
?>