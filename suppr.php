<?php 
	session_start();
	$bdd = new PDO('mysql:host=localhost;dbname=test', 'root', '' );
	$contenu = $bdd->query("SELECT * FROM chat");
	$supprime = $_POST['sup'];

	foreach ($contenu as $value) {
		if($value['id'] == $supprime){
			$envoi = $bdd->prepare("DELETE FROM chat WHERE id=(:nombre)");
			$envoi->execute(array('nombre' => $supprime));
		}
	}
	header('Location: index.php');

?>