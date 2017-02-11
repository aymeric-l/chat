<?php 
	$bdd = new PDO('mysql:host=localhost;dbname=test', 'root', '');
	if($_POST['futur_pseudo'] != '' AND $_POST['futur_password'] != '' AND $_POST['futur_password_deux'] == $_POST['futur_password']){
		$inscription = $bdd->prepare('INSERT INTO login(pseudo, password) VALUES (:pseudo, :password) '); 
		$inscription->execute(array('pseudo' => ucfirst($_POST['futur_pseudo']), 'password' => $_POST['futur_password']));
		Header('Location: index.php');
	}

?>