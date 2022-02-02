<?php
session_start();
include "dbconnect.php";
$db = getPdo();
$result = $db->prepare("SELECT * FROM products");
$result->execute();
$i = 0;
$products = array();
while ($row = $result->fetch()) {
  $products[$i] = $row;
  $i++;
}
$category = array_column($products, 'Category');
$category = array_unique($category);
if (isset($_GET['updates'])) {
  $updates = $_GET['updates'];
}else {
  $updates = 0;
}
?>


<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="Books">
  <meta name="author" content="Shivangi Gupta">
  <title>Online Bookstore</title>
  <!-- Bootstrap -->
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <link href="css/my.css" rel="stylesheet">
  <link rel="stylesheet" href="css/sweetalert.min.css">
  <link href="https://fonts.googleapis.com/css?family=Raleway:400,300,600,800,900" rel="stylesheet" type="text/css">

  <style>
    .modal-header {
      background: #2f4a5d;
      border: 0.1px solid #8CA0AD;
      color: #fff;
      font-weight: 800;
    }

    .modal-body {
      font-weight: 800;
    }

    .modal-body ul {
      list-style: none;
    }

    .modal .btn {
      background: #5F6C75;
      color: #fff;
    }

    .modal a {
      color: #D67B22;
    }

    .modal-backdrop {
      position: inherit !important;
    }

    #login_button,
    #register_button {
      background: none;
      color: #ffffff !important;
    }

    #query_button {
      position: fixed;
      right: 0px;
      bottom: 0px;
      padding: 10px 40px;
      margin-right: 10px;
      background-color: #2f4a5d;
      color: #fff;
      border-color: #ffffff;
      border-radius: 2px;
    }

    @media(max-width:767px) {
      #query_button {
        padding: 5px 20px;
      }
    }
  </style>
</head>

<body>
  <nav class="navbar navbar-default navbar-fixed-top navbar-inverse">
    <div class="container-fluid">
      <!-- Brand and toggle get grouped for better mobile display -->
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="#" style="padding: 1px;"><img class="img-responsive" alt="Brand" src="img/logo.jpg" style="width: 147px;margin: 0px;"></a>
      </div>

      <!-- Collect the nav links, forms, and other content for toggling -->
      <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        <ul class="nav navbar-nav navbar-right">
          <li><a href="index.php" class="btn btn-lg">🔘 Accueil</a></li>
          <li><a href="cart.php" class="btn btn-lg">❤ Mes favoris</a></li>
        </ul>
      </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
  </nav>
  <div id="top">
    <div id="searchbox" class="container-fluid" style="width:112%;margin-left:-6%;margin-right:-6%;">
      <div>
        <form role="search" method="POST" action="Result.php">
          <input type="text" class="form-control" name="keyword" style="width:80%;margin:20px 10% 20px 10%;" placeholder="Rechercher un livre, un auteur ou une catégorie">
        </form>
      </div>
    </div>

    <div class="container-fluid" id="header">
      <div class="row">
        <div class="col-md-3 col-lg-3" id="category">
          <div style="background:#5F6C75;color:#fff;font-weight:800;border:none;padding:15px;"> Tous les catégories </div>
          <div class="list-group">
            <?php foreach ($category as $type) : ?>
              <a href="Product.php?value=<?= $type ?>" class="list-group-item list-group-item-action"><?= $type ?></a>
            <?php endforeach; ?>
            <a href="Product.php?value=tous les livres" class="list-group-item list-group-item-action">Voir tous</a>
          </div>
        </div>
        <div class="col-md-6 col-lg-6">
          <div id="myCarousel" class="carousel slide carousel-fade" data-ride="carousel">
            <!-- Indicators -->
            <ol class="carousel-indicators">
              <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
              <li data-target="#myCarousel" data-slide-to="1"></li>
              <li data-target="#myCarousel" data-slide-to="2"></li>
              <li data-target="#myCarousel" data-slide-to="3"></li>
              <li data-target="#myCarousel" data-slide-to="4"></li>
              <li data-target="#myCarousel" data-slide-to="5"></li>
            </ol>

            <!-- Wrapper for slides -->
            <div class="carousel-inner" role="listbox">
              <div class="item active">
                <img class="img-responsive" src="img/carousel/1.jpg">
              </div>

              <div class="item">
                <img class="img-responsive " src="img/carousel/2.jpg">
              </div>

              <div class="item">
                <img class="img-responsive" src="img/carousel/3.jpg">
              </div>

              <div class="item">
                <img class="img-responsive" src="img/carousel/4.jpg">
              </div>

              <div class="item">
                <img class="img-responsive" src="img/carousel/5.jpg">
              </div>

              <div class="item">
                <img class="img-responsive" src="img/carousel/6.jpg">
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-3 col-lg-3" id="offer">
          <a href="Product.php?value=Regional%20Books"> <img class="img-responsive center-block" src="img/offers/1.png"></a>
          <a href="Product.php?value=Health%20and%20Cooking"> <img class="img-responsive center-block" src="img/offers/2.png"></a>
          <a href="Product.php?value=Academic%20and%20Professional"> <img class="img-responsive center-block" src="img/offers/3.png"></a>
        </div>
      </div>
    </div>
  </div>

  <div class="container-fluid text-center" id="new">
    <div class="row">
      <!-- one new book -->
      <?php foreach ($products as $new) : ?>
        <?php if ($new['new'] == 1) : ?>
          <div class="col-sm-6 col-md-3 col-lg-3">

            <a href="description.php?ID=<?= $new['PID'] ?>">
              <div class="book-block">
                <div class="tag">Top</div>
                <div class="tag-side"><img src="img/tag.png"></div>
                <div class="img" style="min-height:380px;">
                  <img class="book block-center img-responsive" src="img/books/<?= $new['img'] ?>">
                </div>
                <div class="title" style="overflow: hidden; min-height:60px; margin-top:5px;">
                  <?= strtoupper($new['Title']) ?>
                </div>
              </div>
            </a>
          </div>
        <?php endif; ?>
      <?php endforeach; ?>
      <!-- end one book -->

    </div>
  </div>



  <footer style="margin-left:-6%;margin-right:-6%;">
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-1 col-md-1 col-lg-1">
        </div>
        <div class="col-sm-7 col-md-5 col-lg-5">
          <div class="row text-center">
            <h2>Entrons en contact !</h2>
            <hr class="primary">
            <p>Encore confus? Appelez-nous ou envoyez-nous un e-mail et nous vous répondrons dans les plus brefs délais !</p>
          </div>
          <div class="row">
            <div class="col-md-6 text-center">
              <span class="glyphicon glyphicon-earphone"></span>
              <p>0345511234</p>
            </div>
            <div class="col-md-6 text-center">
              <span class="glyphicon glyphicon-envelope"></span>
              <p>Instat@gmail.com</p>
            </div>
          </div>
        </div>
        <div class="hidden-sm-down col-md-2 col-lg-2">
        </div>
        <div class="col-sm-4 col-md-3 col-lg-3 text-center">
          <h2 style="color:#ffffff;">Suivez-nous sur</h2>
          <div>
            <a href="https://twitter.com/strandbookstore">
              <img title="Twitter" alt="Twitter" src="img/social/twitter.png" width="35" height="35" />
            </a>
            <a href="https://www.linkedin.com/company/strand-book-store">
              <img title="LinkedIn" alt="LinkedIn" src="img/social/linkedin.png" width="35" height="35" />
            </a>
            <a href="https://www.facebook.com/strandbookstore/">
              <img title="Facebook" alt="Facebook" src="img/social/facebook.png" width="35" height="35" />
            </a>
            <a href="https://plus.google.com/111917722383378485041">
              <img title="google+" alt="google+" src="img/social/google.jpg" width="35" height="35" />
            </a>
            <a href="https://www.pinterest.com/strandbookstore/">
              <img title="Pinterest" alt="Pinterest" src="img/social/pinterest.jpg" width="35" height="35" />
            </a>
          </div>
        </div>
      </div>
    </div>
  </footer>

  <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
  <script src="js/jquery.min.js"></script>

  <!-- Include all compiled plugins (below), or include individual files as needed -->
  <script src="js/bootstrap.min.js"></script>
  
  <!-- pop up -->
  <script src="js/functions.js"></script>
  <script src="js/sweetalert.min.js"></script>
  <script src="js/update.js"></script>

  <?php
  if ($updates == 1) {
    echo '<script>
    swal("Félicitation! votre bibliothèque est à jour", {
      icon: "success",
    });
    </script>';
  }
  ?>

  <!-- get js functions-->
  <!-- get js functions-->
</body>

</html>