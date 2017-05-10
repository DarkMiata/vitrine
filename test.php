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
    $refTab = DB_BLZ_getRefAll(16, 0);
    
    view_tabBlzProd($refTab);
    
    ?>  
   
  </body>
 </html>
 
