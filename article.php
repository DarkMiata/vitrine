<?php
/**
 * @author Samuel Vermeulen  <samvermeulen@gmail.com>
 * @version 0.1 - 22/3/2017
 */
?>

<html>
  <head>

    <?php
      require_once ("/config/config.php");

      if (isset($_GET["ref"])) {
        $ref = $_GET["ref"];
      }
      else {
        $ref = "";
        // message d'erreur à définir si la ref n'est pas défini
      }

//      $article = DB_get_ArticleByRef($ref);
//
//      $nom      = $article['name'];
//      $marque   = $article['marque'];
//      $ref      = $article['ref'];
//      $descrip  = $article['description'];
//      $prix     = $article['prix'];

      $article  = DB_BLZ_getAllByRef($ref);
      $nom      = $article['nom'];
      $marque   = $article['marque'];
      $ref      = $article['ref'];
      $descrip  = $article['description'];
      $prix     = $article['prix'];
      $type     = $article['type'];

      $imgs     = DB_BLZ_listOfImages($ref);

      if ($article == false) {
        ?>
        <br>
        <h1>Article inexistant</h1>
        <?php
        exit();
      }

      $imgMain  = $imgs[0][0];
    ?>

    <!-- CSS page_article - perso -->
    <link rel="stylesheet" type="text/css" href="css/page_article.css">

    <title>La Boutik - page article</title>
  </head>

  <body>
    <?php
    //$GLOBALS["hierarchieArray"] = ["test1", "test2", "test3"];

    $GLOBALS['hierarchieArray'] = [$type, $nom];
    include("barre_hierarchie.php");
    ?>
    <table>

      <tr>
        <td><img id="img_product" class="cadre" src="<?php echo(PATH_IMG . $imgMain); ?>"></td>
        <td id="product_block_infos">
          <div id="product_logo_marque" class="cadre">
            logo
          </div>
          <div id="product_block">
            <!-- Infos produit -->
            <div id="product_block_description" class="cadre">
              <h1><?php echo($nom); ?></h1>
              <p id="product_ref">Réf: <?php echo($ref); ?></p>
              <p id="product_description"><?php echo($descrip); ?></p>
            </div>
            <!-- Prix -->
            <div id="product_block_price" class="cadre">
              <div id="product_block_price_empty"></div>
              <div id="product_price"><?php view_prix($prix); ?></div>
            </div>
          </div>
          <form id="buy_block" class="cadre" action="/ajout_panier.php" method="post">
            <label>Choississez votre Taille :</label>
            <select name="taille" id="taille">
              <option value="S">S</option>
              <option value="M">M</option>
              <option value="L">L</option>
            </select>
            <p>Couleur :</p>
            <a href="">Guide des tailles<br></a>
            <label>Quantité:</label>
            <select name="quantite" id="quantite">
              <option value=1>1</option>
              <option value-2>2</option>
            </select>
            <p class="cadre">
              <input id="product_submit_button" type="image" src="img/product_panier.png" name="submit" value="Ajouter au panier">
            </p>
          </form>
        </td>
      </tr>
      <tr>
        <td>
          <?php
            foreach ($imgs as $key => $img) {
              if ($key != 0) {
                ?><img class="product_thumbail" class="cadre" src="
                <?php
                  echo(PATH_IMG . $img['file_name']);
                ?>" >
                <?php
              }
            }
          ?>
        </td>
        <td>
          infos
        </td>
      </tr>

    </table>

    </div>
  </body>
</html>
