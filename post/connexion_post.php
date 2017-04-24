<?php

require ('/inc/include.php');

$login    = $_POST["login"];
$mdp      = $_POST["password"];

echo "login: ".$login."<br>";
echo "mdp: ".$mdp."<br>";

echo "serveur: ".DB_NAME."<br>";

$bdd_co = 
	'mysql:host='	.DB_URL
	.';dbname=' 	.DB_NAME
	.';charset=utf8';

var_dump($bdd_co);

$bdd = new PDO($bdd_co, DB_LOGIN, DB_PWD);

var_dump($bdd);

/*$sql = $bdd->query(
    " SELECT login, password"
  . " FROM utilisateur"
  . " WHERE login='".$login."';"
  )->fetch();
*/
$sql = $bdd->query(
    " SELECT login, password"
  . " FROM utilisateur"
  . " WHERE login='$login';"
  )->fetch();

var_dump($sql);
?>

