<?php
/**
 * blz
 *    nom
 *    marque
 *    prix
 *    img_fichier
 *    img_url
 *    ref
 *    type
 *
 * blz_photos
 *    ref
 *    type
 *    url
 *
 * blz_stock
 *    ref
 *    stock
 *    taille
 */


require_once (PATH_INC . 'include.php');

// ========================================
/*
  DB_connexion()
  DB_PasswordFromLogin()
  DB_Login()
  DB_Password()
  DB_NewUser()
 */

// ========================================

function DB_connexion() {
  $bdd_co =
        'mysql:host='   . DB_URL
      . ';dbname='      . DB_NAME
      . ';charset=utf8';

  $bdd = new PDO($bdd_co, DB_LOGIN, DB_PWD);

  return $bdd;
}
// ========================================

function DB_Password_Login($login) {
  $bdd = DB_connexion();

  $reqSql = $bdd->query(
          " SELECT password"
          . " FROM utilisateur"
          . " WHERE login='$login';"
      )->fetch();

  return $reqSql;
}
// ========================================

function DB_Password_Email($email) {
  $bdd = DB_connexion();

  $reqSql = $bdd->query(
          " SELECT password"
          . " FROM utilisateur"
          . " WHERE email='$email';"
      )->fetch();

  return $reqSql;
}
// ========================================

function DB_Id_Login($login) {
  $bdd = DB_connexion();

  $reqSql = $bdd->query(
          " SELECT id"
          . " FROM utilisateur"
          . " WHERE login='$login';"
      )->fetch();

  return $reqSql;
}
// ========================================

function DB_Id_Email($email) {
  $bdd = DB_connexion();

  $reqSql = $bdd->query(
          " SELECT id"
          . " FROM utilisateur"
          . " WHERE email='$email';"
      )->fetch();

  return $reqSql;
}
// ========================================

function DB_New_User($email, $password) {
  $bdd = DB_connexion();

  $reqSql = $bdd->query(
          " INSERT INTO utilisateur"
          . " (email, password)"
          . " VALUES ('$email', '$password');"
      )->fetch();

  return $reqSql;
}
// ========================================

function DB_add_produit($nom, $prix, $description, $ref, $stock, $cat) {

  $bdd = DB_connexion();

  $reqSql = $bdd->query(
    " INSERT INTO produit"
    . " (nom, prix, description, ref, stock, cat)"
    . " VALUES ('$nom', '$prix', '$description'"
    . ", '$ref', '$stock', '$cat');"
    )->fetch();

  return $reqSql;
}
// ========================================

function DB_Get_produit_From_nom($nom) {
  $bdd = DB_connexion();

  $reqSql = $bdd->query(
    " SELECT id, nom, prix, description, ref, stock, cat"
    . " FROM produit"
    . " WHERE nom='$nom';"
    )->fetch();

  return $reqSql;
}
// ========================================

function DB_Get_produit_From_id($id) {
  $bdd = DB_connexion();

  $reqSql = $bdd->query(
    " SELECT id, nom, prix, description, ref, stock, cat"
    . " FROM produit"
    . " WHERE id='$id';"
    )->fetch();

  return $reqSql;
}
// ========================================

function DB_Get_produit_all() {
  $bdd = DB_connexion();

  $reqSql = $bdd->query(
    " SELECT id, nom, prix, description, ref, stock, cat"
    . " FROM produit"
    . " LIMIT 0,5;"
    )->fetchAll();

  return $reqSql;
}
// ========================================

// ================================

/** 29831
 * UPDATE nom_table_cible
SET colonne = valeur [, colonne2 = valeur2 ...]
[WHERE condition]
 */
// ================================

// fonction qui va préremplir le type d'article en fonction des mots clés
// trouvé dans le nom. exemple:polo col V => type: polo

function DB_BLZ_generateType () {
  debug("génération des types");

  $reqSqlTab = DB_BLZ_getNomRefAll();

  foreach ($reqSqlTab as $value) {
    $nom = $value['nom'];
    $ref = $value['ref'];

    debug("nom: ".$nom);

    if (preg_match("/pull/i", $nom)) {
      debug("type pull");
      DB_BLZ_setTypeByRef($ref, "pull");
    }

    if (preg_match("/chemise/i", $nom)) {
      debug("type chemise");
      DB_BLZ_setTypeByRef($ref, "chem");
    }

    if (preg_match("/polo/i", $nom)) {
      debug("type polo");
      DB_BLZ_setTypeByRef($ref, "polo");
    }

    if (preg_match("/pantalon/i", $nom)) {
      debug("type pantalon");
      DB_BLZ_setTypeByRef($ref, "pant");
    }

    if (preg_match("/tshirt/i", $nom)
            or preg_match("/tee-shirt/i", $nom)
            or preg_match("/t-shirt/i", $nom)) {
      debug("type tshirt");
      DB_BLZ_setTypeByRef($ref, "tshirt");
    }

    if (preg_match("/sweat/i", $nom)) {
      debug("type sweat");
      DB_BLZ_setTypeByRef($ref, "sweat");
    }

    if (preg_match("/jogg/i", $nom)) {
      debug("type jogging");
      DB_BLZ_setTypeByRef($ref, "jogg");
    }

    if (preg_match("/gilet/i", $nom)) {
      debug("type gilet");
      DB_BLZ_setTypeByRef($ref, "gilet");
    }

    if (preg_match("/blouson/i", $nom)) {
      debug("type blouson");
      DB_BLZ_setTypeByRef($ref, "blous");
    }

    if (preg_match("/veste/i", $nom)) {
      debug("type veste");
      DB_BLZ_setTypeByRef($ref, "veste");
    }

    if (preg_match("/jean/i", $nom)
            or preg_match("/jeans/i", $nom)) {
      debug("type jeans");
      DB_BLZ_setTypeByRef($ref, "jeans");
    }

    if (preg_match("/casquette/i", $nom)) {
      debug("type casquette");
      DB_BLZ_setTypeByRef($ref, "casqu");
    }

    if (preg_match("/chaussure/i", $nom)) {
      debug("type chaussure");
      DB_BLZ_setTypeByRef($ref, "chaus");
    }
  }
}
/** if (preg_match("/php/i", "PHP est le meilleur langage de script du web."))
 *
 */

