<?php
require_once ("/config/config.php");
//require_once (PATH_INC. 'include.php');
//require_once (PATH_DB.  'data_base.php');

// ========================================

// réception des infos dans _POST présentes ? 
if (!isset($_POST['password']) and ! isset($_POST['email'])) {

  header('Location: inscription.php?mes=ErrPost');
  exit;
}

$password   = $_POST['password'];
$email      = $_POST['email']; 

// Email existant ?
$reqSql = DB_Id_Email($email);

if ($reqSql != false) {
  header('Location: inscription.php?mes=EmailExist');
  exit;
}

try {
  $reqSql = DB_New_User($email, $password);
}
catch (Exception $err) {
  echo "Erreur: ", $err->getMessage(), "<br>";
  exit;
}
  
debug ("requete écrite DB: ".var_dump($reqSql)."<br>");

  header('Location: inscription.php?mes=InscOk');
  exit;