<?php
session_start();
$PARAM_hote='localhost';
$PARAM_utilisateur='root';
$PARAM_mot_passe='';
$PARAM_nom_bd='Licencié';
$options = [PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8', PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION];
$connexion = new PDO('mysql:host='.$PARAM_hote.';dbname='.$PARAM_nom_bd, $PARAM_utilisateur, $PARAM_mot_passe, $options);

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  try {
      // Insertion dans la table existante
      $stmt = $connexion->prepare("INSERT INTO `lignes-frais` 
                                  (`adresse-mail`, `date`, `motif`, `trajet`, `km`, `cout-peage`, `cout-hebergement`, `km-valldé`, `pesge-valldé`, `repas-valldé`, `hebergement-valldé`) 
                                  VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
      
      for ($i = 0; $i < count($_POST['date']); $i++) {
          $stmt->execute([
              htmlspecialchars($_POST['adresse'][$i]),  // adresse-mail
              $_POST['date'][$i],                      // date
              htmlspecialchars($_POST['motif'][$i]),    // motif
              htmlspecialchars($_POST['trajet'][$i]),   // trajet
              $_POST['kms'][$i],                       // km
              $_POST['peages'][$i],                    // cout-peage
              $_POST['hebergement'][$i],               // cout-hebergement
              $_POST['kms'][$i],                       // km-valldé
              $_POST['peages'][$i],                    // pesge-valldé
              $_POST['repas'][$i],                     // repas-valldé
              $_POST['hebergement'][$i]                // hebergement-valldé
          ]);
          
          // Ici vous pourriez insérer dans une autre table les champs supplémentaires
          // lorsque vous aurez adapté votre structure de base de données
          /*
          $stmt_supp = $connexion->prepare("INSERT INTO autres_infos 
                                          (total, remis_le, signature_tresorier, numero_recu, certifie, commentaires) 
                                          VALUES (?, ?, ?, ?, ?, ?)");
          $stmt_supp->execute([
              $_POST['total'][$i],
              $_POST['remis_le'][$i],
              htmlspecialchars($_POST['signature_tresorier'][$i]),
              $_POST['numero_recu'][$i],
              htmlspecialchars($_POST['certifie'][$i]),
              htmlspecialchars($_POST['commentaires'][$i])
          ]);
          */
      }
      
  } catch (PDOException $e) {
      die("Erreur lors de l'insertion : " . $e->getMessage());
  }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">     
<link rel="stylesheet" type="text/css" href="Version2-fredi-bordereau.css">
<link href="css/bootstrap.min.css" rel="stylesheet">
<title>Bordereau de Note de Frais</title>
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
                <li><a href="planning.php">PRATIQUER </a></li>
                <li><a href="#">PLANNING</a></li>
                <li><a href="version2-fredi-bordereau.php">BORDEREAU</a></li>
                <li><a href="connexionouinscription.php">MON ESPACE </a></li>
                <li><a href="A propos.html">A PROPOS DE NOUS </a></li>
                </ul>
            </div>

            
    </div>
    
    <form action="" method="post">
        <div class="header">
            <p class="changeColor">Je soussigné(e): <input type="text" name="nom[]" placeholder="Votre nom ici"> 
            Demeurant: <input type="text" name="adresse[]" placeholder="Votre adresse ici"></p>
            <p>Certifie renoncer au remboursement des frais ci-dessous et les laisser à l'association en tant que don.</p>
            <input type="text" name="certifie[]" placeholder="Exemple :Salle d'Armes de Villers lès Nancy, 1 rue Rodin - 54600 Villers lès Nancy">
        </div>
        
        <h4>Frais de déplacement (Tarif kilométrique appliqué pour le remboursement: 0,28 €)</h4>
        <table>
            <tr>
                <th>Date</th>
                <th>Motif</th>
                <th>Trajet</th>
                <th>Kms parcourus</th>
                <th>Péages</th>
                <th>Repas</th>
                <th>Hébergement</th>
                <th>Commentaires</th>
                <th>Total</th>
            </tr>
            <tr>
                <td><input type="date" name="date[]" required></td>
                <td><input type="text" name="motif[]" required></td>
                <td><input type="text" name="trajet[]" required></td>
                <td><input type="number" name="kms[]" min="0" required></td>
                <td><input type="number" name="peages[]" min="0" oninput="calculateTotal(this)" required></td>
                <td><input type="number" name="repas[]" min="0" oninput="calculateTotal(this)" required></td>
                <td><input type="number" name="hebergement[]" min="0" oninput="calculateTotal(this)" required></td>
                <td><input type="text" name="commentaires[]"></td>
                <td><input type="text" name="total[]" readonly></td>
            </tr>
        </table>
        
        <div class="additional">
            <p>Montant total des frais de déplacement: <span id="totalDons">0.00 €</span></p>
            <p>Je suis le représentant légal des adhérents suivants:</p>
            <input type="text" name="representant_legal[]" placeholder="Romain Becker, licence n° 170540010309">
        </div>
        
        <div class="footer">
            <p>Partie réservée à l'association</p>
            <p>N° d'ordre du Reçu: <input type="text" name="numero_recu[]"></p>
            <p>Remis le: <input type="date" name="remis_le[]"></p>
            <p>Signature du Trésorier: <input type="text" name="signature_tresorier[]"></p>
        </div>
        
        <button type="submit">Soumettre</button>
        <button type="button" onclick="window.location.href='generer_recu.php'">Générer et télécharger le reçu</button>
    </form>
    </div>

    <script>
    function calculateTotal(element) {
        const row = element.parentNode.parentNode;
        const inputs = row.querySelectorAll('input[type="number"]');
        let sum = 0;
        inputs.forEach(input => {
            const value = parseFloat(input.value);
            if (!isNaN(value)) {
                sum += value;
            }
        });
        const totalCell = row.querySelector('input[name="total[]"]');
        totalCell.value = sum.toFixed(2) + ' €';
        updateGrandTotal();
    }

    function updateGrandTotal() {
        const totalCells = document.querySelectorAll('input[name="total[]"]');
        let grandTotal = 0;
        totalCells.forEach(cell => {
            const rowTotal = parseFloat(cell.value.replace(' €', ''));
            if (!isNaN(rowTotal)) grandTotal += rowTotal;
        });
        document.getElementById('totalDons').textContent = grandTotal.toFixed(2) + ' €';
    }

    document.addEventListener('DOMContentLoaded', () => {
        const inputElements = document.querySelectorAll('input[type="number"]');
        inputElements.forEach(input => {
            input.addEventListener('input', function() {
                calculateTotal(this);
            });
        });
    });
    </script>
</body>
</html>