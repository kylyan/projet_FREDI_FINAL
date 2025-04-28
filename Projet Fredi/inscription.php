
    <?php
	include('inscriptionAdherent.html');
    include('licencié.php');
        $pseudo = $_POST['pseudo'];
        $email = $_POST['email'];
        $mdp = $_POST['mdp'];
        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
        $dtnaissance = $_POST['dtnaissance'];
        $genre = $_POST['genre'];
        $ligue = $_POST['ligue'];
        $club = $_POST['club'];
        $licence = $_POST['licence'];
        $requette = "INSERT INTO membre(pseudo, email, mdp, nom, prenom, dtnaissance, genre, ligue, club, licence) VALUES('$pseudo', '$email', '$mdp', '$nom', '$prenom', '$dtnaissance', '$genre', '$ligue', '$club', '$licence')";
        $a = $bdd->query($requette);

    	/*try
		{
			//	connexion au serveur de données et à la base
				$bdd = new PDO("mysql:host=$IPserveur;dbname=$nomBase;charset=utf8", $nomUtil,$mdpUtil,array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
		}

	catch (Exception $e)
		{
			die('Erreur : ' . $e->getMessage());
        }

       
           

            $req = $bdd->prepare('INSERT INTO licencié(pseudo, email, mdp, nom, prenom, dtnaissance, genre, ligue, club, licence) VALUES(:pseudo, :email, :mdp, :nom, :prenom, :dtnaissance, :genre, :ligue, :club, :licence)');
            $req->execute(array(
                'pseudo' => $pseudo,
                'email' => $email,
                'mdp' => $mdp,
                'nom' => $nom,
                'prenom' => $prenom,
                'dtnaissance' => $dtnaissance,
                'genre' => $genre,
                'ligue' => $ligue,
                'club' => $club,
                'licence' => $licence
            ));*/
        
    ?>
