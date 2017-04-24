<?php

require_once 'config/config.php';

// ========================================
/**
 * DB_CAT
 *  id
 *  name
 *  url
 *  countArticles

  DB_ART
 *  id
 *  name
 *  url
 *  description
 *  ref
 *  refsite
 *  marque
 *  prix
 *  categorie_id
 *  tailles_id
 *  images_id
 *  stocks_id
 */
// ========================================

function DB_get_catIdByName($name) {

  $bdd = DB_connexion();

  $reqSql = $bdd->query(
          " SELECT id"
          . " FROM " . DB_CAT
          . " WHERE name='$name';"
      )->fetch();

  return $reqSql;
}
// ------------------------
function DB_hydr_categorie($name, $url, $cntArt) {

  $bdd = DB_connexion();

  $reqSqlTxt = " INSERT INTO " . DB_CAT
      . " (name, url, countArticles)"
      . " VALUES ('$name', '$url', '$cntArt');"
  ;

  $reqSql = $bdd->query($reqSqlTxt);

  if ($reqSql == FALSE) {
    echo("erreur DB_hydr_categorie<br>");
    echo("requete: " . $reqSqlTxt);
    $result = FALSE;
  }
  else {
    $result = TRUE;
  }

  return $result;
}
// ------------------------
function DB_hydr_article($name, $url, $description
, $ref, $refsite, $marque, $prix, $cat_id, $cat_name) {

  $bdd = DB_connexion();

  $description = addslashes($description);

  $reqSqlTxt = " INSERT INTO " . DB_ART
      . " (name, url, description, ref, "
      . "refsite, marque, prix, categorie_id, cat_name)"
      . " VALUES ("
      . "'$name', '$url', '$description', '$ref'"
      . ", '$refsite', '$marque', '$prix', '$cat_id', '$cat_name'"
      . ");";

  $reqSql = $bdd->query($reqSqlTxt);

  if ($reqSql == FALSE) {
    echo("erreur DB_hydr_article<br>");
    echo("requete: " . $reqSqlTxt);
    return FALSE;
  }
  else {
    return TRUE;
  }
}
// ------------------------
function DB_get_catById($id) {

  $bdd = DB_connexion();

  $reqSqlTxt = "SELECT *"
      . " FROM " . DB_CAT
      . " WHERE id='$id';";

  $reqSql = $bdd->query($reqSqlTxt)->fetchall();

  if ($reqSql == FALSE) {
    echo("erreur DB_get_catById<br>");
    echo("requete: " . $reqSqlTxt);
    return FALSE;
  }
  else {
    return $reqSql;
  }
}
// ------------------------
function DB_is_articleByUrl($url) {

  $bdd = DB_connexion();

  $reqSqlTxt = "SELECT 1"
      . " FROM " . DB_ART
      . " WHERE url='$url';";

  $reqSql = $bdd->query($reqSqlTxt)->fetch();

  var_dump($reqSql);

  if ($reqSql == FALSE) {
    return FALSE;
  }
  else {
    return TRUE;
  }
}
// ------------------------
function DB_up_scanById($id, $scan) {

  $bdd = DB_connexion();

  $reqSqlTxt =
      "UPDATE " . DB_CAT
      . " SET scan='$scan'"
      . " WHERE id='$id';"
  ;

  $reqSql = $bdd->query($reqSqlTxt);
}
// ------------------------
function DB_get_ArticleByRef($ref) {
  $bdd = DB_connexion();

  $reqSqlTxt = "SELECT *"
      . " FROM " . DB_ARTICLE
      . " WHERE ref='$ref';";

  $reqSql = $bdd->query($reqSqlTxt)->fetch();

  return $reqSql;

}
// ------------------------
function DB_scrap_getRefAll($count, $page) {
  $bdd = DB_connexion();

  $offset = ($page-1)*$count;

  $reqSql = $bdd->query(
          " SELECT ref"
          . " FROM " . DB_ARTICLE
          . " ORDER BY ref"
          . " LIMIT $count OFFSET $offset"
          . ";"
      )->fetchall();

  return $reqSql;
}

function DB_scrap_getAllByRef($ref) {
  $bdd = DB_connexion();

  $reqSql = $bdd->query(
          " SELECT *"
          . " FROM " . DB_ARTICLE
          . " WHERE ref='$ref';"
      )->fetch();

  return $reqSql;
}
// ========================================

function bloc_produit_scrap($ref) {

  $reqSqlTab = DB_get_ArticleByRef($ref);

  $nom      = $reqSqlTab['name'];
  //$img      = $reqSqlTab['img_fichier'];
  $img      = ""; // valeur temporaire !!!!!!!!!
  $marque   = $reqSqlTab['marque'];
  $prix     = $reqSqlTab['prix'];

  //var_dump($ref, $nom, $img, $marque);

  ?>
    <div class="col-md-3 col-sm-6 block-prod">
        <span class="thumbnail">
          <img src="<?php echo(PATH_IMG . $img); ?>" alt="...">
          <hr class="line">
          <p class="price center"><?php view_prix($prix); ?></p>
          <h5 class="center">
            <?php
              echo ($marque . " - ");
              echo ($nom);
            ?>
          </h5>
          <p> <?php // texte   ?> </p>
        </span>
      </div>
  <?php

  }
// ------------------------
function view_tab_scrapProds($refTab) {

  ?><div class="row"><?php

  foreach ($refTab as $value) {
    $ref = $value['ref'];

    bloc_produit_scrap($ref);

  }

  ?></div><?php

}