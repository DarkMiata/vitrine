<?php



?>

<html>
  <head>

    <?php
      require_once ("/config/config.php");
    ?>

    <title>La Boutik - connexion au compte</title>
  <!--</head>-->
  <body>

  <?php
    //view_tabProduits();

    //DB_BLZ_generateType();

    $pageArticle_tab = GET_nbrPageArticles();

    $pageArticle  = $pageArticle_tab['page'];
    $nbrArticle   = $pageArticle_tab['nbr'];

    $refTab = DB_scrap_getRefAll($nbrArticle, $pageArticle);
    view_tab_scrapProds($refTab);

    view_pagesButtonSelector($pageArticle, $nbrArticle);


    ?>

  </body>
 </html>

