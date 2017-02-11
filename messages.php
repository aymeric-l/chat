<?php
	$droit = 'blue';
	$contenu = $bdd->query("SELECT * FROM chat ORDER BY id DESC");
	//On parcoure le tableau et à chaque nouvelles lignes, on ajoute son contenu dans la variable $ligne
	foreach ($contenu as $ligne) {
		if($ligne['droit'] == 'admin'){$droit = 'red';}else if($ligne['droit'] == 'modo'){$droit = 'green';}
		echo $ligne['id'] . ') <span style="color:' . $droit . '; font-weight:bold;">' . ucfirst($ligne['pseudo']) . '</span> : ' .$ligne['message'] .  '</br>';
		$droit = 'blue';
	}
	if(isset($_SESSION["pseudo"], $_SESSION["password"])){
		echo "<form action='deconnexion.php' method='post'>";
		echo 	"<button type='submit' name='bouton'>Déconnexion</button>";
		echo "</form>";
	}
?>