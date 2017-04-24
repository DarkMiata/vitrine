<?php

function msgErreur() {

  if (isset($_GET['mes']) == false) { return; }

  $msgErr = $_GET['mes'];

  //echo "Erreur: ".$msgErr;
  switch ($msgErr) {
    case false:
      break;

    case 'MDPErr':
      echo "Mot de passe incorrect";
      break;

    case 'logErr':
      echo "Login non existant";
      break;
    
    case 'EmailErr':
      echo "Email non existant";
      break;

    case 'EmailExist':
      echo "Email déjà existant";
      break;

    case 'logExist':
      echo "Login déjà existant";
      break;

    case 'InscOk':
      echo "Inscription réussie";
      break;

    case 'ErrPost':
      echo "Erreur de réception des _POST";
      break;

    default:
      echo "Message d'erreur inconnu";
      break;
  }
}
