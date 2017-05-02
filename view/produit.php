<?php

require_once ("/config/config.php");

// ========================================
// ========================================

function bloc_boutonPanier($produit) {

  $stock  = $produit['stock'];
  $id     = $produit['id'];

  if (intval($stock) > 0) {
    ?>
    <p class="stock_enStock">En stock (reste $stock)</p>
    <a href="commande_post.php?add&id=
      <?php echo $id; ?>
       " class="btn btn-xs btn-success">
      <span class="glyphicon glyphicon-shopping-cart"> </span>
      ajouter au panier
    </a>
    <?php
  }
}
// ========================================

function bloc_produit($produit) {

  ?>
  <div class="produit col-xs-6 col-sm-4 col-md-3">
    <div class="prixProd">
      <?php echo $produit['prix']; ?>€</div>

    <div class="nomProd">
      <?php echo $produit['nom']; ?></div>

    <div class="descriptProd">
      <?php echo $produit['description']; ?></div>

    <div class="imgProd">
      <?php /* image */ ?></div>

    <div class="stockProd">
      <?php echo $produit['stock']; ?></div>

    <?php bloc_boutonPanier($produit); ?>

  </div>
  <?php
}
// ========================================
// Affichage du prix avec Decimales de plus petites tailles

function view_prix($prix) {

  $floorPrice = floor($prix);

  $decimPrice = $prix-$floorPrice;

  if ($decimPrice == 0) { $decimPrice ="00"; }
  else { $decimPrice = explode(".", $decimPrice)[1]; }

  ?><div class="center"><span class="price price-height"><?php
  echo $floorPrice."€";
  ?></span><span class="price price-decimal-height"><?php
  echo $decimPrice;
  ?></span></div><?php
}
// ========================================

function bloc_produit_blz($ref) {

  $reqSqlTab = DB_BLZ_getAllByRef($ref);

  $ref      = $reqSqlTab['ref'];
  $nom      = $reqSqlTab['nom'];
  $img      = $reqSqlTab['img_fichier'];
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

// ========================================



function view_tabProduits() {

  $reqSql = DB_Get_produit_all();

  ?><div class="row"><?php

  foreach ($reqSql as $value) {
    bloc_produit($value);
  }

  ?></div><?php
}
// ========================================

function view_tabBlzProd($refTab) {

  ?><div class="row"><?php

  foreach ($refTab as $value) {
    $ref = $value['ref'];

    bloc_produit_blz($ref);

  }

  ?></div><?php

}
// ========================================

function GET_nbrPageArticles () {

  // !! à filter par la suite
  if (isset($_GET['p'])) {
    $pageArticle = $_GET['p'];
  }
  else { $pageArticle = 1; }

  if (isset($_GET['nbr'])) {
    $nbrArticle = $_GET['nbr'];
  }
  else { $nbrArticle = 16; }

  $pageArticle_tab['page']  = $pageArticle;
  $pageArticle_tab['nbr']   = $nbrArticle;

  debug("page: $pageArticle - "
      . "nbrArticle: $nbrArticle", "blue");

  return $pageArticle_tab;
}
// ========================================

function GET_refArticle() {
  if (isset($_GET['article'])) {
    $refArticle = $_GET['article'];


  }
}

// ========================================

function view_pagesButtonSelector($pageArticle, $nbrArticle) {

  debug("boutons selection pages articles", "black");

  $nbrArticlesTot = DB_BLZ_count()[0];

  debug("view_pagebutton page: ".$pageArticle);
  debug("nbr elements blz: ".$nbrArticlesTot);

  if ($pageArticle > 1) {
    $urlPrev = FILE_PAGEPROD
        ."?p="      .($pageArticle-1)
        ."&nbr="   .$nbrArticle
        ;
  }
  else {
    $urlPrev = FILE_PAGEPROD
        ."?p=1"
        ."&nbr="   .$nbrArticle
        ;
  }

  $urlNext = FILE_PAGEPROD
     ."?p="      .($pageArticle+1)
     ."&nbr="   .$nbrArticle
     ;

  ?>
  <a class="pagination_prev" href="
     <?php echo($urlPrev); ?>">(PREV) </a>

  <a class="pagination_next" href="
    <?php echo($urlNext); ?>"> (NEXT)</a>
  <?php
}

/**
<a class="pagination_next" href="/new-products.php?n=30&amp;p=4&amp;from=top" style="text-shadow: rgba(0, 0, 0, 0.00784314) 0px 0px 1px;">&nbsp;»</a>
// ========================================

  		<div class="col-md-3 col-sm-6">
    		<span class="thumbnail">
      			<img src="https://s12.postimg.org/41uq0fc4d/item_2_180x200.png" alt="...">
      			<h4>Product Tittle</h4>
      			<div class="ratings">
                    <span class="glyphicon glyphicon-star"></span>
                    <span class="glyphicon glyphicon-star"></span>
                    <span class="glyphicon glyphicon-star"></span>
                    <span class="glyphicon glyphicon-star"></span>
                    <span class="glyphicon glyphicon-star-empty"></span>
                </div>
      			<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. </p>
      			<hr class="line">
      			<div class="row">
      				<div class="col-md-6 col-sm-6">
      					<p class="price">$29,90</p>
      				</div>
      				<div class="col-md-6 col-sm-6">
      					<button class="btn btn-info right" > BUY ITEM</button>
      				</div>

      			</div>
    		</span>
  		</div>

 */

function bloc_produit_scrap($ref) {

  $reqSqlTab = DB_get_ArticleByRef($ref);

  $nom      = $reqSqlTab['name'];
  //$img      = $reqSqlTab['img_fichier'];
  $marque   = $reqSqlTab['marque'];
  $prix     = $reqSqlTab['prix'];
  $imgs     = DB_BLZ_listOfImages($ref);

  //var_dump($imgs);

  if ($imgs == null) { $imgs[0][0] = ""; }

  ?>
    <div class="col-md-3 col-sm-6 block-prod">
        <span class="thumbnail">
          <img src="<?php echo(PATH_IMG . $imgs[0][0]); ?>" alt="...">
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
// ------------------------