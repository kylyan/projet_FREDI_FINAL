<?php
session_start();
$PARAM_hote='localhost';
$PARAM_utilisateur='root';
$PARAM_mot_passe='';
$PARAM_nom_bd='Licencié';
$options = [PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8', PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION];
$connexion = new PDO('mysql:host='.$PARAM_hote.';dbname='.$PARAM_nom_bd, $PARAM_utilisateur, $PARAM_mot_passe, $options);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        // Récupération des données du formulaire
        $nom = htmlspecialchars($_POST['nom'][0]);
        $adresse = htmlspecialchars($_POST['adresse'][0]);
        $total = htmlspecialchars($_POST['total'][0]);
        $remis_le = htmlspecialchars($_POST['remis_le'][0]);
        $signature_tresorier = htmlspecialchars($_POST['signature_tresorier'][0]);
        $numero_recu = htmlspecialchars($_POST['numero_recu'][0]);
        $certifie = htmlspecialchars($_POST['certifie'][0]);
        $representant_legal = htmlspecialchars($_POST['representant_legal'][0]);
        
        // Génération du reçu
        header('Content-Type: text/html; charset=utf-8');
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Reçu de remboursement</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        .recu { border: 1px solid #000; padding: 20px; max-width: 800px; margin: 0 auto; }
        .header { text-align: center; margin-bottom: 20px; }
        .title { font-size: 24px; font-weight: bold; }
        .numero { text-align: right; margin-bottom: 20px; }
        .info { margin-bottom: 15px; }
        .signature { margin-top: 50px; text-align: right; }
        .montant { font-weight: bold; font-size: 18px; }
        table { width: 100%; border-collapse: collapse; margin: 20px 0; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
    </style>
</head>
<body>
    <div class="recu">
        <div class="header">
            <div class="title">REÇU DE REMBOURSEMENT</div>
            <div>Association FREDI</div>
            <div><?php echo $certifie; ?></div>
        </div>
        
        <div class="numero">
            N°: <?php echo $numero_recu; ?>
        </div>
        
        <div class="info">
            <p>Je soussigné(e), <?php echo $signature_tresorier; ?>, trésorier de l'association FREDI,</p>
            <p>certifie avoir remboursé la somme de <span class="montant"><?php echo $total; ?></span> à :</p>
        </div>
        
        <div class="info" style="margin-left: 30px;">
            <p>Nom: <?php echo $nom; ?></p>
            <p>Adresse: <?php echo $adresse; ?></p>
        </div>
        
        <h4>Détail des frais remboursés</h4>
        <table>
            <tr>
                <th>Date</th>
                <th>Motif</th>
                <th>Trajet</th>
                <th>Kms parcourus</th>
                <th>Péages</th>
                <th>Repas</th>
                <th>Hébergement</th>
                <th>Total</th>
            </tr>
            <?php
            // Affichage des lignes de frais
            for ($i = 0; $i < count($_POST['date']); $i++) {
                echo '<tr>';
                echo '<td>'.htmlspecialchars($_POST['date'][$i]).'</td>';
                echo '<td>'.htmlspecialchars($_POST['motif'][$i]).'</td>';
                echo '<td>'.htmlspecialchars($_POST['trajet'][$i]).'</td>';
                echo '<td>'.htmlspecialchars($_POST['kms'][$i]).' km</td>';
                echo '<td>'.htmlspecialchars($_POST['peages'][$i]).' €</td>';
                echo '<td>'.htmlspecialchars($_POST['repas'][$i]).' €</td>';
                echo '<td>'.htmlspecialchars($_POST['hebergement'][$i]).' €</td>';
                echo '<td>'.htmlspecialchars($_POST['total'][$i]).'</td>';
                echo '</tr>';
            }
            ?>
        </table>
        
        <div class="info">
            <p>Représentant légal des adhérents suivants: <?php echo $representant_legal; ?></p>
            <p>Date du remboursement: <?php echo $remis_le; ?></p>
        </div>
        
        <div class="info">
            <p>Fait à <?php echo explode(',', $certifie)[0]; ?>, le <?php echo date('d/m/Y'); ?></p>
        </div>
        
        <div class="signature">
            <p>Signature du trésorier</p>
            <p>_________________________</p>
            <p><?php echo $signature_tresorier; ?></p>
        </div>
    </div>
    
    <div style="text-align: center; margin-top: 20px;">
        <button onclick="window.print()">Imprimer le reçu</button>
        <button onclick="window.location.href='version2-fredi-bordereau.php'">Retour au bordereau</button>
    </div>
</body>
</html>
<?php
    } catch (PDOException $e) {
        die("Erreur lors de la génération du reçu : " . $e->getMessage());
    }
} else {
    // Si la page est accédée directement sans données POST
    echo "<p>Cette page doit être accédée via le formulaire de bordereau.</p>";
    echo "<p><a href='version2-fredi-bordereau.php'>Retour au formulaire</a></p>";
}
?>