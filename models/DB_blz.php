<?php

require_once 'config/config.php';

// ========================================

function DB_ref_exit($ref) {
  $bdd = DB_connexion();

  $reqSql = $bdd->query(
          " SELECT ref"
          . " FROM blz"
          . " WHERE ref='$ref';"
      )->fetch();

  return $reqSql;
}
// ------------------------
function DB_get_BlzAll($ref) {
  $bdd = DB_connexion();

  $reqSql = $bdd->query(
          " SELECT nom, marque, ref, prix, img_fichier, img_url"
          . " FROM blz"
          . " WHERE ref='$ref';"
      )->fetch();

  return $reqSql;
}
// ------------------------
function DB_add_article($nom, $marque, $ref, $prix, $img_fichier, $img_url) {

  $bdd = DB_connexion();

  if (DB_ref_exit($ref) === FALSE) {

    $reqSql = $bdd->query(
            " INSERT INTO blz"
            . " (nom, marque, ref, prix, img_fichier, img_url)"
            . " VALUES ('$nom', '$marque', '$ref', '$prix', '$img_fichier', '$img_url');"
        )->fetch();
  }
  else {
    //echo "la ref $ref existe déjà dans la DB<br>";
    $reqSql = FALSE;
  }

  return $reqSql;
}
// ------------------------
function DB_getBlzLinkUrl($ref) {
  $bdd = DB_connexion();

  $reqSql = $bdd->query(
          "SELECT url_page_article"
          . " FROM blz"
          . " WHERE ref='$ref';"
      )->fetch();

  var_dump($reqSql);

  return $reqSql;
}
// ------------------------
function DB_setBlzHrefByRef($ref, $href) {
  $bdd = DB_connexion();

  echo ("setblzhrefburef: ref:" . $ref . " - href:" . $href . "<br>");

  $reqSql = $bdd->query(
          "UPDATE blz"
          . " SET url_page_article='$href'"
          . " WHERE ref='$ref'"
      )->fetch();
}
// ------------------------
function DB_BLZ_add_photo($id, $ref_article, $file_name) {
  global $bdd;
  $bdd = DB_connexion();

  //var_dump($bdd);

  $reqSql = $bdd->query(
      "INSERT INTO blz_photos"
      . " (id, ref_article, file_name)"
      . " VALUES ('$id', '$ref_article', '$file_name');");
}
// ------------------------
function DB_BLZ_listOfImages($ref_article) {
  global $bdd;
  $bdd = DB_connexion();

  $reqSql = $bdd->query(
      "SELECT file_name"
      . " FROM blz_photos"
      . " WHERE ref_article='$ref_article'"
      . " ORDER BY id ASC;")->fetchAll();

  return $reqSql;
}
// ------------------------
function DB_BLZ_setCatArticleByRef($ref, $catNumber) {
  global $bdd;

  $bdd = DB_connexion();

  $reqSql = $bdd->query(
          "UPDATE blz"
          . " SET cat_id='$catNumber'"
          . " WHERE ref='$ref'");
}
// ------------------------
// Converti le type d'article de type text de BLZ en un type ID de la table blz_cat
function DB_BLZ_convertTypeToCatid() {
  global $bdd;
  $bdd = DB_connexion();

  $listOfNull = $bdd->query(
          "SELECT ref, type"
          . " FROM blz"
          . " WHERE cat_id IS NULL;"
          )->fetchAll();

  $listOfCat = $bdd->query(
          "SELECT id, cat_name"
          . " FROM blz_cat;"
          )->fetchAll();

  //var_dump($listOfCat);

  //var_dump($listOfNull);

  foreach ($listOfNull as $article) {

    foreach ($listOfCat as $cat) {
      $findCat = FALSE;
      if ($cat['cat_name'] == $article['type']) {
        //echo($article['ref'] . " -> " . $cat['cat_name'] . "  ");
        DB_BLZ_setCatArticleByRef($article['ref'], $cat['id']);
        $findCat = TRUE;
      }
    }

    if (($findCat == FALSE) && ($article['type'] != NULL)) {
      echo (" !! cat non trouvé: "
              . $article['ref'] . "-" . $article['type']);
    }
  }
}
// ------------------------
function DB_BLZ_getAllByRef($ref) {
  $bdd = DB_connexion();

  $reqSql = $bdd->query(
          " SELECT nom, marque, ref, prix, img_fichier, img_url, type, cat_id"
          . " FROM blz"
          . " WHERE ref='$ref';"
      )->fetch();

  //var_dump($reqSql);

  return $reqSql;
}
// ------------------------
function DB_BLZ_getRefAll($count, $page) {
  $bdd = DB_connexion();

  $offset = ($page-1)*$count;

  $reqSql = $bdd->query(
          " SELECT ref"
          . " FROM blz"
          . " ORDER BY ref"
          . " LIMIT $count OFFSET $offset"
          . ";"
      )->fetchall();

  return $reqSql;
}
// ------------------------
function DB_BLZ_count() {
  $bdd = DB_connexion();

  $reqSql = $bdd->query(
          " SELECT COUNT(*)"
          . "FROM blz"
          . ";"
      )->fetch();

  return $reqSql;
}
// ------------------------
function DB_BLZ_getNomRefAll() {
  $bdd = DB_connexion();

  $reqSql = $bdd->query(
          " SELECT nom, ref"
          . " FROM blz"
          . ";"
      )->fetchall();

  return $reqSql;
}
// ------------------------
function DB_BLZ_setTypeByRef($ref, $type) {
  $bdd = DB_connexion();

  $reqsql = $bdd->query(
          " UPDATE blz"
          . " SET type  = '$type'"
          . " WHERE ref = $ref"
          );
}
// ------------------------
function DB_BLZ_refCount($ref) {
  $bdd= DB_connexion();

  $reqSql = $bdd->query(
          " SELECT COUNT(*)"
          . " FROM blz"
          . " WHERE ref=$ref"
          )->fetch()[0];

  debug("reqsql count ref: ".var_dump($reqSql));
}
// ------------------------
function DB_BLZ_description_scrapToBLZ() {
  global $bdd;

  $bdd = DB_connexion();

  $refsArray = $bdd->query(
      "SELECT ref"
      . " FROM blz"
      . " WHERE description=''"
      . ";"
      )->fetchAll();



  foreach ($refsArray as $article) {
    $ref = $article['ref'];

    $description = $bdd->query(
      "SELECT description"
      . " FROM scrap_articles"
      . " WHERE ref='$ref';"
      );

  var_dump($ref);
  var_dump($description);

//    $reqSql = $bdd->query(
//        "UPDATE blz"
//        . " SET description='$'"
//        . ";"
//        );
  }

//  $reqSql = $bdd->query(
//      "UPDATE blz"
//      . " SET description='$'"
//      );

}
