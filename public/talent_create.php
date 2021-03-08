<?php
include("../app/Talent.php");
if (isset($_POST['talent_create'])) {
	$generation = $_POST['generation'];
	$nom_fr = $_POST['nom_fr'];
	$nom_en = $_POST['nom_en'];
	$effet_combat = $_POST['effet_combat'];
	$effet_terrain = $_POST['effet_terrain'];
	$pdo = Pokemon::init();
	$stmt = $pdo->prepare("INSERT INTO talents (generation, nom_fr, nom_en, effet_combat, effet_terrain) VALUES (:generation, :nom_fr, :nom_en, :effet_combat, :effet_terrain)");
	$stmt->bindParam(":generation", $generation);
	$stmt->bindParam(":nom_fr", $nom_fr);
	$stmt->bindParam(":nom_en", $nom_en);
	$stmt->bindParam(":effet_combat", $effet_combat);
	$stmt->bindParam(":effet_terrain", $effet_terrain);
	$stmt->execute();
	header("location:talent_index.php");
	exit;
}


$affichage = Talent::html_create();
?><!DOCTYPE html>
<html lang="fr">

<head>
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<meta http-equiv="X-UA-Compatible" content="ie=edge" />
	<link rel="stylesheet" href="pokemon.css" />
	<title>Monde Pokémons</title>
</head>

<body>
	<div id="app">
		<header>
			<h1>Monde Pokémons</h1>
		</header>
		<nav>
			<ul>
				<li><a href="talent_index.php">Retour à la liste</a></li>
			</ul>
		</nav>
		<footer>Intégration Web 3</footer>
		<div class="body">
			<?php echo $affichage; ?>
		</div>
	</div>
</body>

</html>