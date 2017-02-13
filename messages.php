<?php 
session_start();
$bdd = new PDO('mysql:host=localhost;dbname=test', 'root', '' );
$contenu = $bdd->query("SELECT * FROM chat ORDER BY id DESC");
$droit = 'blue';
$suppr = "<div style='display:flex; padding:0px; margin:-8px;'><form action='suppr.php' method='post'><input type='text' name ='sup' value='";
$supprDeux = "' style='display:none'/><input type='submit' name='boutonSubmit' value='X'></form>";
	//On parcoure le tableau et à chaque nouvelles lignes, on ajoute son contenu dans la variable $ligne
	foreach ($contenu as $ligne) {
		if($ligne['droit'] == 'admin'){$droit = 'red';}else if($ligne['droit'] == 'modo'){$droit = 'green';}

		if(isset($_SESSION['droit'])){if($_SESSION['droit'] == 'admin'){echo $suppr . $ligne['id'] . $supprDeux;}}
		echo '<span style="color:' . $droit . '; font-weight:bold;">' . ucfirst($ligne['pseudo']) . '</span> : ' .
		$ligne['message'] . '</div></br>';
		$droit = 'blue';
	}
?>