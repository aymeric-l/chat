<?php 
	$non_existant = true;
	$bdd = new PDO('mysql:host=localhost;dbname=test', 'root', '');
	$liste_pseudo = $bdd->query('SELECT * FROM login');
	if($_POST['futur_pseudo'] != '' AND $_POST['futur_password'] != '' AND $_POST['futur_password_deux'] == $_POST['futur_password']){

		foreach ($liste_pseudo as $value) {
			if($value['pseudo'] == ucfirst($_POST['futur_pseudo'])){
				$non_existant = false;
				break;
			}
		}

		var_dump($non_existant, $value['pseudo'], $value['password']);
		if($non_existant == true){
		$inscription = $bdd->prepare('INSERT INTO login(pseudo, password) VALUES (:pseudo, :password) '); 
		$inscription->execute(array('pseudo' => ucfirst($_POST['futur_pseudo']), 'password' => $_POST['futur_password']));
		}
		//Header('Location: index.php');
	}

?>