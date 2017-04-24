<?php

require_once ("/config/config.php");

//require_once (PATH_INC . 'include.php');
//require_once (PATH_DB . 'data_base.php');
// ========================================
function br() {
  echo "<br>";
}

// ======================================== 
// Controle de la présence des _POSTs
if (!isset($_POST['password']) and !isset($_POST['email'])) {

  header('Location: connexion.php?mes=ErrPost');
  exit;
}

$email  = $_POST['email'];
$mdp    = $_POST['password'];

// email existant dans la DB ?
$reqSql = DB_Id_Email($email);

if ($reqSql == false) {
  header('Location: connexion.php?mes=EmailErr');
  exit;
}

// MDP ok ?
$reqSql = DB_Password_Email($email);

if ($reqSql['password'] != $mdp) {
  header('Location: connexion.php?mes=MDPErr');
  exit;
}

// login ok, mdp ok
echo "Login et mdp ok";
br();

