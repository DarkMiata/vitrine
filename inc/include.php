<?php require_once "/config/config.php"; ?>

<meta charset="UTF-8">
<!--    <link href="css\style.css" rel="stylesheet" type="text/css"/>-->
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
      rel="stylesheet" 
      integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u"
      crossorigin="anonymous">

<!-- Website Font style -->
<link rel="stylesheet" 
      href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css">

<!-- Google Fonts -->
<link href='https://fonts.googleapis.com/css?family=Passion+One' 
      rel='stylesheet' type='text/css'>
<link href='https://fonts.googleapis.com/css?family=Oxygen' 
      rel='stylesheet' type='text/css'>

<link rel="stylesheet" href="<?php echo PATH_CSS; ?>menu.css" type="text/css">

<!-- CSS personnel -->
<link rel="stylesheet" href="<?php echo PATH_CSS . FILE_CSS; ?>" type="text/css">
<link rel="stylesheet" href="css/style.css" type="text/css">

<!-- CSS Produits -->
<link rel="stylesheet" href="<?php echo PATH_CSS . PROD_CSS; ?>" type="text/css">
<link rel="stylesheet" href="<?php echo PATH_CSS . "product.css"; ?>" type="text/css">

<!-- CSS écran inscription/connexion -->
<link rel="stylesheet" href="<?php echo PATH_CSS; ?>style_register.css" type="text/css">

<?php
include (PATH_MENU . FILE_MENU);

debug("include.php chargé");
