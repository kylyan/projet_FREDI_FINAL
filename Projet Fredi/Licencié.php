<?php
	$IPserveur="localhost";
	$nomBase="licencié";
	$nomUtil="root";
	$mdpUtil="";
	
	try
		{
			//	connexion au serveur de données et à la base
				$bdd = new PDO("mysql:host=$IPserveur;dbname=$nomBase;charset=utf8", $nomUtil,$mdpUtil,array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
		}

	catch (Exception $e)
		{
			die('Erreur : ' . $e->getMessage());
		}
?>
