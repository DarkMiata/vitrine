<?php

/**
 * @author Samuel Vermeulen <samvermeulen@gmail.com>
 * @version
 * @date 
 */

// ================================
/**
 * fonction 
 * 
 * @param type $color
 * @return string
 */
function colorConsole($color) {
  switch ($color) {
    case 'red':
      return "red";
      break;

    case 'green':
      return "green";
      break;

    case 'blue':
      return "blue";
      break;

    default:
      return "black";
      break;
  }
}

// ================================
/**
 * fonction qui affiche un texte dans la console
 * 
 * @param type $text    texte à afficher
 * @param type $color   couleur choisi
 */
function echoConsole($text, $color = "black") {

  echo("<script>console.log('%c$text','"
  . "color:"
  . colorConsole($color)
  . ";"
  . "');</script>"
  );
}


/**
 * Envoi d'un texte dans la console si DEBUG_ON est true
 * 
 * @param type $text    texte à envoyer
 * @param type $color   couleur choisi, type string
 */
function debug($text, $color = "black") {
  if (DEBUG_ON) {
    echoConsole($text, $color);
  }
}

// ================================
/**
 * require un fichier et envoi un message (ou non) dans la console informant
 * du succès ou non du fichier trouvé. Le message est envoyé ou non à la
 * console en fonction de la constante DEBUG_ON
 * 
 * @param type $file
 */
function require_debug($file) {
  if (file_exists($file)) {

    require_once($file);
    if (DEBUG_ON == true) {

      echoConsole("Chargement du require: $file Ok", "green");
    }
  }
  else {
    echoConsole("require: le fichier $file est introuvable", "red");
  }
}

// ================================

function css_debug($cssFile) {
  if (file_exists($cssFile)) {
    $cssLink =
      '<link rel="stylesheet" href="'
      .$cssFile
      .'" type="text/css">';
    
    echo($cssLink);

    debug("Chargement du CSS: $cssFile", "green");
    }
  else {
    debug("Erreur de chargement CSS: $cssFile", "red");
  }
}
