<?php
require_once '/inc/debug.php';

// ========================================
?>
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<?php
// ========================================
// ========================================
// Configuration de la connexion à la base de données

define("DB_NAME", "vitrine");
define("DB_URL",  "localhost");

// !!! à redéfinir en version final !!
define("DB_LOGIN", "root");
define("DB_PWD", "");

define("DB_ARTICLE", "scrap_articles");

$sqlConnexionState = FALSE;

// ========================================
// Routage des includes

define("PATH_MENU"    , "");
define("PATH_INC"     , "inc/");
define("PATH_ERR"     , "");
define("PATH_DB"      , "models/");
define("PATH_CONTROL" , "");
define("PATH_CSS"     , "css/");
define("PATH_MODELS"  , "models/");
define("PATH_VIEW"    , "view/");
define("PATH_IMG"     , "img/");
define("PATH_CLASS"   , "class/");

// ========================================
// header - menu - footer

define("FILE_HEADER",     "");
define("FILE_MENU",       "menu2.php");
define("FILE_FOOTER",     "");
define("FILE_PAGEPROD",   "page.php");

define("FILE_CSS",    "style.css");
define("PROD_CSS",    "produit.css");

// ========================================
// activation/désactivation des messages de debug

define("DEBUG_ON",      true);
define("DEBUG_CONSOLE", true);

// ========================================

require_debug (PATH_INC     . "include.php");
require_debug (PATH_ERR     . "messageErreur.php");
require_debug (PATH_MODELS  . "data_base.php");
require_debug (PATH_MODELS  . "DB_scrap.php");
require_debug (PATH_MODELS  . "DB_blz.php");
require_debug (PATH_VIEW    . "produit.php");

require_debug (PATH_CLASS  . "Article.php");

debug("config.php chargé", "green");
