<?php
require_once '/inc/debug.php';

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
