<?php
include_once "Pokemon.php";
class Talent {
    /**
     * Méthode html_index retourne la liste des talents en ordre alphabétique
     * @return string
     */
    static public function html_index() {
        $pdo = Pokemon::init();
        $stmt = $pdo->prepare('SELECT id, nom_fr FROM talents ORDER BY nom_fr');
		$stmt->setFetchMode(PDO::FETCH_CLASS, self::class);
        $stmt->execute();
        $affichage = '';
        $affichage .= '';
        $affichage .= '<ul>';
        while (($talent = $stmt->fetch()) !== false) {
            $affichage .= '<li>';
            $affichage .= '<a href="talent_show.php?id='.$talent->id.'">';
            $affichage .= $talent->nom_fr;
            $affichage .= '</a>';
            $affichage .= '</li>';

        }
        $affichage .= '</ul>';
        return $affichage;
    }
    /**
     * Méthode html_show retourne les détails d'un talent en fonction du id fourni
     * @param string $id Le id du talent que l'on affiche
     * @return string
     */
    static public function html_show($id) {
        $pdo = Pokemon::init();
        $stmt = $pdo->prepare('SELECT * FROM talents WHERE id=:id');
		$stmt->bindParam(":id", $id);
        $stmt->setFetchMode(PDO::FETCH_CLASS, self::class);
        $stmt->execute();
        $talent = $stmt->fetch();
        $resultat = '';
        $resultat .= '<table class="talent">';
        $resultat .= '<tr>';
        $resultat .= '<th>Id</th>';
        $resultat .= '<td>'.$talent->id.'</td>';
        $resultat .= '</tr>';
        $resultat .= '<tr>';
        $resultat .= '<th>Génération</th>';
        $resultat .= '<td>'.$talent->generation.'</td>';
        $resultat .= '</tr>';
        $resultat .= '<tr>';
        $resultat .= '<th>Nom français</th>';
        $resultat .= '<td>'.$talent->nom_fr.'</td>';
        $resultat .= '</tr>';
        $resultat .= '<tr>';
        $resultat .= '<th>Nom anglais</th>';
        $resultat .= '<td>'.$talent->nom_en.'</td>';
        $resultat .= '</tr>';
        $resultat .= '<tr>';
        $resultat .= '<th>Effet combat</th>';
        $resultat .= '<td>'.$talent->effet_combat.'</td>';
        $resultat .= '</tr>';
        $resultat .= '<tr>';
        $resultat .= '<th>Effet terrain</th>';
        $resultat .= '<td>'.$talent->effet_terrain.'</td>';
        $resultat .= '</tr>';
        $resultat .= '</table>';
        return $resultat;
    }
    /**
     * Méthode html_create retourne le formulaire de création d'un talent
     * @return string
     */
    static public function html_create() {
        $resultat = '';
        $resultat .= '<form action="" method="post">';
        $resultat .= '<table class="talent">';
        $resultat .= '<tr>';
        $resultat .= '<th>Génération</th>';
        $resultat .= '<td><input type="number" name="generation" id="generation" min="1" max="10"/></td>';
        $resultat .= '</tr>';
        $resultat .= '<tr>';
        $resultat .= '<th>Nom français</th>';
        $resultat .= '<td><input type="text" name="nom_fr" id="nom_fr"/></td>';
        $resultat .= '</tr>';
        $resultat .= '<tr>';
        $resultat .= '<th>Nom anglais</th>';
        $resultat .= '<td><input type="text" name="nom_en" id="nom_en"/></td>';
        $resultat .= '</tr>';
        $resultat .= '<tr>';
        $resultat .= '<th>Effet combat</th>';
        $resultat .= '<td><input type="text" name="effet_combat" id="effet_combat"/></td>';
        $resultat .= '</tr>';
        $resultat .= '<tr>';
        $resultat .= '<th>Effet terrain</th>';
        $resultat .= '<td><input type="text" name="effet_terrain" id="effet_terrain"/></td>';
        $resultat .= '</tr>';
        $resultat .= '<tr>';
        $resultat .= '<th colspan="2"><input type="submit" value="Envoyer"><input type="hidden" name="talent_create"></th>';
        $resultat .= '</tr>';
        $resultat .= '</table>';
        $resultat .= '</form>';
        return $resultat;
    }
    /**
     * Méthode html_edit retourne le formulaire de modification en fonction du id fourni
     * @param string $id Le id du talent que l'on modifie
     * @return string
     */
    static public function html_edit($id) {
        $pdo = Pokemon::init();
        $stmt = $pdo->prepare('SELECT * FROM talents WHERE id=:id');
		$stmt->bindParam(":id", $id);
        $stmt->setFetchMode(PDO::FETCH_CLASS, self::class);
        $stmt->execute();
        $talent = $stmt->fetch();
        $resultat = '';
        $resultat .= '<form action="" method="post">';
        $resultat .= '<table class="talent">';
        $resultat .= '<tr>';
        $resultat .= '<th>Génération</th>';
        $resultat .= '<td><input type="number" name="generation" id="generation" min="1" max="10" value="'.$talent->generation.'"/></td>';
        $resultat .= '</tr>';
        $resultat .= '<tr>';
        $resultat .= '<th>Nom français</th>';
        $resultat .= '<td><input type="text" name="nom_fr" id="nom_fr" value="'.$talent->nom_fr.'"/></td>';
        $resultat .= '</tr>';
        $resultat .= '<tr>';
        $resultat .= '<th>Nom anglais</th>';
        $resultat .= '<td><input type="text" name="nom_en" id="nom_en" value="'.$talent->nom_en.'"/></td>';
        $resultat .= '</tr>';
        $resultat .= '<tr>';
        $resultat .= '<th>Effet combat</th>';
        $resultat .= '<td><input type="text" name="effet_combat" id="effet_combat" value="'.$talent->effet_combat.'"/></td>';
        $resultat .= '</tr>';
        $resultat .= '<tr>';
        $resultat .= '<th>Effet terrain</th>';
        $resultat .= '<td><input type="text" name="effet_terrain" id="effet_terrain" value="'.$talent->effet_terrain.'"/></td>';
        $resultat .= '</tr>';
        $resultat .= '<tr>';
        $resultat .= '<th colspan="2">';
        $resultat .= '<input type="submit" value="Envoyer">';
        $resultat .= '<input type="hidden" name="talent_edit">';
        $resultat .= '<input type="hidden" name="id" value="'.$talent->id.'">';
        $resultat .= '</th>';
        $resultat .= '</tr>';
        $resultat .= '</table>';
        $resultat .= '</form>';
        return $resultat;
    }
}