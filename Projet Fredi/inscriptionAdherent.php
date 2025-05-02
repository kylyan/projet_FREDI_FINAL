<?php
?>
<!DOCTYPE html>
<html lang="en">
<head>
    
    <link rel="stylesheet" href="inscription.css">
    <title>Inscription</title>
</head>
<body>
    <div class="main">
        <div class="navbar">
            <div class="icon">
                <div class="logo">FREDI</div>
            </div>

            <div class="menu">
                <ul>
                <li><a href="acceuil.php">ACCUEIL</a></li>
                <li><a href="actualité.html">ACTUALITÉ</a></li>
                <li><a href="#">COMITÉ ET LES LIGUES</a></li>
                <li><a href="planning.php">PRATIQUER </a></li>
                <li><a href="#">PLANNING</a></li>
                <li><a href="version2-fredi-bordereau.php">BORDEREAU</a></li>
                <li><a href="connexionouinscription.php">MON ESPACE </a></li>
                <li><a href="A propos.html">A PROPOS DE NOUS </a></li>
                </ul>
            </div>


        
        </div>
        <div class="container">
            <div class="content">
                <form method="post" action="inscription.php" >
                    <h2>Inscription</h2>
                    <div class="content">
                        <div class="input-box">
                            <label for="name">Nom</label>
                            <input type="text" placeholder="Entrer votre nom" name="nom" required>
                        </div>
                        <div class="input-box">
                            <label for="name">Prenom</label>
                            <input type="text" placeholder="Entrer votre Prenom" name="prenom" required>
                        </div>
                        <div class="input-box">
                            <label for="name">Pseudo</label>
                            <input type="text" placeholder="Entrer votre pseudo" name="pseudo" required>
                        </div>
                        <div class="input-box">
                            <label for="name">Email</label>
                            <input type="email" placeholder="Entrer votre email" name="email" required>
                        </div>
                        <div class="input-box">
                            <label for="name">Téléphone</label>
                            <input type="text" placeholder="Entrer votre Numéro" name="phoneNumber" required>
                        </div>
                        <div class="input-box">
                            <label for="name">Mot de passe</label>
                            <input type="password" placeholder="Entrer mot de passe" name="mdp" required
                            pattern="^(?=.*[A-Z])(?=.*[0-9])(?=.*[&@#!]).{6,10}$"
                            title="Le mot de passe doit contenir entre 6 et 10 caractères, avec au moins une majuscule, un chiffre et un caractère spécial (&, @, #,!,.,/)">
                        </div>
                        <div class="input-box">
                            <label for="name">Confirmer le mot de passe</label>
                            <input type="password" placeholder="Confirmer le mot de passe" name="mdp2" required
                            pattern="^(?=.*[A-Z])(?=.*[0-9])(?=.*[&@#!]).{6,10}$"
                            title="Le mot de passe doit contenir entre 6 et 10 caractères, avec au moins une majuscule, un chiffre et un caractère spécial (&, @, #,!,.,/)">
                        <div class="input-box">
                            <label for="dtnaissance">Date de naissance*</label>
                            <input type="date" name="dtnaissance" id="dtnaissance" placeholder="jj/mm/aaaa" required>
                        </div>
                        <div class="input-box">
                            <label for="name">Adresse</label>
                            <input type="text" placeholder="Adresse" name="adresse" required>
                        </div>
                        <div class="input-box">
                            <label for="name">ville</label>
                            <input type="text" placeholder="Entrer la ville" name="ville" required>
                        </div>
                        <div class="input-box">
                            <label for="name">Code Postal</label>
                            <input type="number" placeholder="Entrer Numéro" name="codepostal" required>
                        </div>
                        <div class="input-box">
                            <label for="name">N° de licence</label>
                            <input type="number" placeholder="Enter N° de licence" name="numero_licence" required>
                        </div>
                        <div class="input-box">
                            <label for="name">Ligue</label>
                            <input type="text" placeholder="Enter le nom de ligue auquel vous appartenez" name="ligue" required>
                        </div>
                    </form> 
                        <!-- Section Genre -->
                        <div class="form-group">
                            <label>Genre :</label>
                            <select name="genre" class="form-control" required>
                            <option value="">-- Sélectionnez --</option>
                            <option value="Homme">Homme</option>
                            <option value="Femme">Femme</option>
                            </select>
                        </div>
                    </div>
                    <div class="alert">
                        <p><a href="#">Conditions</a>, <a href="#">Politique de Confidentialité</a>, <a href="#">Politique de Cookies</a>, 
                            régissent vos données avec clarté et sécurité.</p>
                    </div>
                    <div class="button-container">
                        <button type="submit">S'inscrire</button>
                    </div>
                </form>
            </div>
            
        </div>
    </div>
</body>
</html>