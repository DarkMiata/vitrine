<html>
  <head>
    <meta charset="utf-8">
    <?php
    require_once ("/config/config.php");
    require_once (PATH_INC . "include.php");
    require_once (PATH_ERR . "messageErreur.php");
    ?>

    <style></style>

  </head>

  <body>
  <?php
    $article = DB_get_ArticleById(4);

    var_dump($article);
  ?>
  </body>

</html>

