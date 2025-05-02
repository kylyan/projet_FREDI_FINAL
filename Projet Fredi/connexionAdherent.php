<?php
// Activer l'affichage des erreurs pour le débogage
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

// Connexion à la base de données avec gestion des erreurs
try {
    $bdd = new PDO(
        "mysql:host=localhost;dbname=Licencié;charset=utf8",
        'root',
        '',
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ]
    );
} catch(PDOException $e) {
    die("Erreur de connexion à la base de données : " . $e->getMessage());
}

// Traitement du formulaire de connexion
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['connexion'])) {
    // Vérification des champs obligatoires
    if (empty($_POST['pseudo']) || empty($_POST['mdp'])) {
        $error = "Veuillez remplir tous les champs !";
    } else {
        // Nettoyage des entrées
        $pseudo = trim($_POST['pseudo']);
        
        try {
            // Récupération de l'utilisateur
            $recupUser = $bdd->prepare('SELECT id, pseudo, mdp FROM membre WHERE pseudo = ?');
            $recupUser->execute([$pseudo]);
            $user = $recupUser->fetch();

            // Vérification du mot de passe
            if ($user && password_verify($_POST['mdp'], $user['mdp'])) {
                // Connexion réussie
                $_SESSION['user'] = 
                [
                    'id' => $user['id'],
                    'pseudo' => $user['pseudo'],
                    'ip' => $_SERVER['REMOTE_ADDR'] // Sécurité supplémentaire
                ];

                // Régénération de l'ID de session pour éviter les fixation de session
                session_regenerate_id(true);

                // Redirection
                header('Location: actualité.html');
                exit();
            } else {
                $error = "Identifiants incorrects !";
                // Petit délai pour ralentir les attaques par force brute
                sleep(1);
            }
        } catch(PDOException $e) {
            $error = "Une erreur est survenue : " . $e->getMessage();
        }
    }
}

// Affichage des erreurs (à placer dans votre HTML)
if (isset($error)) {
    echo '<div class="error">' . htmlspecialchars($error) . '</div>';
}

include('connexionouinscription.php');
