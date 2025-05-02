<?php
// Inclure les fichiers nécessaires
include('inscriptionAdherent.php');
include('licencié.php');

// Vérifier si le formulaire a été soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        // Initialiser la connexion (décommentez et adaptez avec vos paramètres)
        $bdd = new PDO("mysql:host=$IPserveur;dbname=$nomBase;charset=utf8", $nomUtil, $mdpUtil, [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ]);

        // Récupération et validation des données
        $pseudo = htmlspecialchars($_POST['pseudo']);
        $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
        if (!$email) {
            throw new Exception("Email invalide");
        }

        // Vérification des mots de passe
        if ($_POST['mdp'] !== $_POST['mdp2']) {
            throw new Exception("Les mots de passe ne correspondent pas");
        }
        $mdp = password_hash($_POST['mdp'], PASSWORD_DEFAULT);

        // Autres champs avec vérification des valeurs nulles
        $phoneNumber = htmlspecialchars($_POST['phoneNumber'] ?? '', ENT_QUOTES, 'UTF-8');
        $nom = htmlspecialchars($_POST['nom'] ?? '', ENT_QUOTES, 'UTF-8');
        $prenom = htmlspecialchars($_POST['prenom'] ?? '', ENT_QUOTES, 'UTF-8');
        $dtnaissance = $_POST['dtnaissance'] ?? null;
        $genre = htmlspecialchars($_POST['genre'] ?? '', ENT_QUOTES, 'UTF-8');
        $ligue = htmlspecialchars($_POST['ligue'] ?? '', ENT_QUOTES, 'UTF-8');
        $numero_licence = htmlspecialchars($_POST['numero_licence'] ?? '', ENT_QUOTES, 'UTF-8');
        $adresse = htmlspecialchars($_POST['adresse'] ?? '', ENT_QUOTES, 'UTF-8');
        $ville = htmlspecialchars($_POST['ville'] ?? '', ENT_QUOTES, 'UTF-8');
        $codepostal = htmlspecialchars($_POST['codepostal'] ?? '', ENT_QUOTES, 'UTF-8');

        // Requête préparée sécurisée
        $requete = "INSERT INTO membre (pseudo, email, mdp, nom, prenom, dtnaissance, genre, ligue, `numero_licence`, phoneNumber, adresse, ville, codepostal) 
        VALUES (:pseudo, :email, :mdp, :nom, :prenom, :dtnaissance, :genre, :ligue, :numero_licence, :phoneNumber, :adresse, :ville, :codepostal)";

        $stmt = $bdd->prepare($requete);
        $stmt->execute([
        ':pseudo' => $pseudo,
        ':email' => $email,
        ':mdp' => $mdp,
        ':nom' => $nom,
        ':prenom' => $prenom,
        ':dtnaissance' => $dtnaissance,
        ':genre' => $genre,
        ':ligue' => $ligue,
        ':numero_licence' => $numero_licence, // Ici on utilise $n_licence au lieu de $numero_licence
        ':phoneNumber' => $phoneNumber,
        ':adresse' => $adresse,
        ':ville' => $ville,
        ':codepostal' => $codepostal
        ]);

            echo "Inscription réussie!";

    } catch (Exception $e) {
        // Gestion propre des erreurs
        die("Erreur lors de l'inscription: " . $e->getMessage());
    }
} else {
    die("Accès invalide au script");
}

// En environnement de développement
ini_set('display_errors', 1);
error_reporting(E_ALL);
?>