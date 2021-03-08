<?php
include("../app/Talent.php");
if (isset($_POST['talent_edit'])) {
	$id = $_POST['id'];
	$generation = $_POST['generation'];
	$nom_fr = $_POST['nom_fr'];
	$nom_en = $_POST['nom_en'];
	$effet_combat = $_POST['effet_combat'];
	$effet_terrain = $_POST['effet_terrain'];
	$pdo = Pokemon::init();
	$stmt = $pdo->prepare("UPDATE talents SET generation=:generation, nom_fr=:nom_fr, nom_en=:nom_en, effet_combat=:effet_combat, effet_terrain=:effet_terrain WHERE id=:id");
	$stmt->bindParam(":id", $id);
	$stmt->bindParam(":generation", $generation);
	$stmt->bindParam(":nom_fr", $nom_fr);
	$stmt->bindParam(":nom_en", $nom_en);
	$stmt->bindParam(":effet_combat", $effet_combat);
	$stmt->bindParam(":effet_terrain", $effet_terrain);
	$stmt->execute();
	header("location:talent_index.php");
	exit;
}
if (!isset($_GET['id'])) {
	header("location:talent_index.php");
	exit;
}
$id = $_GET['id'];

$affichage = Talent::html_edit($id);
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
				<li><a href="talent_show.php?id=<?php echo $id; ?>">Retour au talent</a></li>
				<li><a href="talent_delete.php?id=<?php echo $id; ?>">Supprimer le talent</a></li>
			</ul>
		</nav>
		<footer>Intégration Web 3</footer>
		<div class="body">
			<?php echo $affichage; ?>
		</div>
	</div>
</body>

</html>