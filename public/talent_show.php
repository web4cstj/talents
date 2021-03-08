<?php
include("../app/Pokemon.php");
include("../app/Talent.php");
if (!isset($_GET['id'])) {
	header("location:talent_index.php");
	exit;
}
$id = $_GET['id'];
$affichage = Talent::html_show($id);
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
				<li><a href="talent_edit.php?id=<?php echo $id; ?>">Modifier le talent</a></li>
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