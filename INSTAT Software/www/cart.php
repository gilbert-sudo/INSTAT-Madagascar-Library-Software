<?php
include "dbconnect.php";

if (isset($_GET['place'])) {
    $query = "DELETE FROM favori";
    $result = $db->prepare($query);
    $result->execute();
?>
    <script type="text/javascript">
        alert("Votre liste a bien été réalisé avec succée!");
    </script>
<?php
}
if (isset($_GET['remove'])) {
    $product = $_GET['remove'];
    $query = "DELETE FROM favori where Product='$product'";
    $result = $db->prepare($query);
    $result->execute();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Cart">
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
    <link rel="icon" href="/favicon.ico" type="image/x-icon">
    <meta name="author" content="Shivangi Gupta">
    <title>order</title>
    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/my.css" rel="stylesheet">
    <style>
        #cart {
            margin-top: 30px;
            margin-bottom: 30px;
        }

        .panel {
            border: 1px solid #2f4a5d;
            padding-left: 0px;
            padding-right: 0px;
        }

        .panel-heading {
            background: #2f4a5d !important;
            color: white !important;
        }

        @media only screen and (width: 767px) {
            body {
                margin-top: 150px;
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
                <a class="navbar-brand" href="index.php" style="padding: 1px;"><img class="img-responsive" alt="Brand" src="img/logo.jpg" style="width: 147px;margin: 0px;"></a>
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


        <?php

        echo '<div class="container-fluid" id="cart">
      <div class="row">
          <div class="col-xs-12 text-center" id="heading">
                 <h2 style="color:#2f4a5d;text-transform:uppercase;">  VOS FAVORIS </h2>
           </div>
        </div>';
        if (isset($_GET['ID'])) {
            $product = $_GET['ID'];
            $quantity = 1;
            $query = "SELECT * from favori where Product='$product'";
            $result = $db->prepare($query);
            $result->execute();
            $row = $result->fetchAll();
            $numRows = count(array_column($row, 'Product'));
            if ($numRows == 0) {
                $query = "INSERT INTO favori (id, Product, Quantity) VALUES (Null, :product, :quantity)";
                $result = $db->prepare($query);
                $result->bindValue(':product', $product);
                $result->bindValue(':quantity', $quantity);
                $result->execute();
            }
        }
        $query = "SELECT * FROM favori INNER JOIN products ON favori.Product=products.PID";
        $result = $db->prepare($query);
        $result->execute();

        $result = $result->fetchAll();
        $numRows = count(array_column($result, 'PID'));

        if ($numRows > 0) {
            $i = 1;
            $j = 0;

            foreach ($result as $row) {
                $path = "img/books/" . $row['img'];
                if ($i % 2 == 1)  $offset = 1;
                if ($i % 2 == 0)  $offset = 2;
                if ($j % 2 == 0)
        ?>
                <div class="row">

                    <div class="panel col-xs-12 col-sm-4 col-sm-offset-<?= $offset ?> col-md-4 col-md-offset-' . $offset . ' col-lg-4 col-lg-offset-' . $offset . ' text-center" style="color:#2f4a5d;font-weight:800;">
                        <div class="panel-heading">#<?= $i ?>
                        </div>
                        <div class="panel-body">
                            <a id="buyLink" href="read.php?name=<?= $row['pdf'] ?>" target="__BLANK">
                                <img class="image-responsive block-center" src="<?= $path ?>" style="height :250px;"> <br>
                            </a>
                            <?= $row['Title'] ?> <br>
                            Auteur : <?= $row['Category'] ?> <br>
                            <a href="cart.php?remove=<?= $row['PID'] ?>" class="btn btn-sm btn-danger" onclick="return window.confirm('Êtes-vous vraiment éffacer ce livre de votre favori?');">
                                Enlever
                            </a>
                        </div>
                    </div>
                <?php
                if ($j % 2 == 1)
                    echo '</div>';
                $i++;
                $j++;
            }
                ?>
                <br> <br>
                <div class="row">
                    <div class="col-xs-8 col-xs-offset-2  col-sm-4 col-sm-offset-2 col-md-4 col-md-offset-3 col-lg-4 col-lg-offset-3">
                        <a href="index.php" class="btn btn-lg" style="background:#2f4a5d;color:white;font-weight:800;">Chercher des livres</a>
                    </div>
                    <div class="col-xs-6 col-xs-offset-3 col-sm-4 col-sm-offset-2 col-md-4 col-md-offset-1 col-lg-4 ">
                        <a href="cart.php?place=true" class="btn btn-lg btn-danger" onclick="return window.confirm('Êtes-vous vraiment sûre de tous éffacer?');">Tous vider 🗑</a>
                    </div>
                </div>
            <?php
        } else { ?>
                <div class="row">
                    <div class="col-xs-9 col-xs-offset-3 col-sm-2 col-sm-offset-5 col-md-2 col-md-offset-5">
                        <a href="index.php" class="btn btn-lg" style="background:#2f4a5d;color:white;font-weight:800;">Chercher des livres</a>
                    </div>
                </div>'
            <?php } ?> 

                </div>
                <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
                <script src="js/jquery.min.js"></script>
                <!-- Include all compiled plugins (below), or include individual files as needed -->
                <script src="js/bootstrap.min.js"></script>
                <!-- get js functions-->
                <script src="js/functions.js"></script>
                <!-- get js functions-->
                <script src="js/update.js"></script>
</body>
<html>