<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion - Créer un compte</title>
    <link rel="stylesheet" href="style2.css">
</head>
<body>
    <div class="container">
        <div class="login">
        <h1>Connexion</h1>
        <p>Connectez-vous avec les identifiants de votre compte FEDI.</p>
        <form method="POST" action="connexionAdherent.php">
            <h2>Connexion</h2>
        
            <?php if (isset($error)): ?>
                <div class="error"><?= htmlspecialchars($error) ?></div>
            <?php endif; ?>

            <label for="pseudo">Pseudo :</label>
            <input type="text" name="pseudo" required>

            <label for="mdp">Mot de passe :</label>
            <input type="password" name="mdp" required>

            <input type="submit" name="connexion" value="Se connecter">
        </form>
        </div>
        <div class="signup">
            <h1>Créer un compte FREDI</h1>
            <p>Vous n'avez pas de compte FREDI? Créez-vous un compte FREDI dès maintenant pour pouvoir profiter de Mon Espace !</p>
            <button><a href="inscriptionAdherent.php">S'INSCRIRE</button>
        </div>
    </div>
</body>
</html>
