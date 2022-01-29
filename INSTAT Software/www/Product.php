<?php
include "dbconnect.php";
$db = getPdo();
if (isset($_GET['value'])) {
    $_SESSION['category'] = $_GET['value'];
    $category = $_GET['value'];
    if ($_GET['value'] == "tous les livres") {
        $result = $db->prepare("SELECT * FROM products");
    } else {
        $query = "SELECT * FROM products WHERE Category like '%{$category}%'";
        $result = $db->prepare($query);
    }
    $result->execute();
    $results = $result->fetchAll();
}
$i = 0;
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
                <a class="navbar-brand" href="index.php"><img alt="Brand" src="img/logo.jpg" style="width: 118px;margin-top: -7px;margin-left: -10px;"></a>
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
    </div>

    <div class="container-fluid" id="books">
        <div class="row">
            <div class="col-xs-12 text-center" id="heading">
                <h2 style="color:rgb(228, 55, 25);text-transform:uppercase;margin-bottom:0px;"> <?= $category ?></h2>
            </div>
        </div>

    </div>
    <div class="container-fluid text-center" id="new">
        <div class="row">
            <!-- one new book -->
            <?php foreach ($results as $new) : ?>
                <div class="col-sm-6 col-md-3 col-lg-3">

                    <a href="description.php?ID=<?= $new['PID'] ?>">
                        <div class="book-block">
                            <div class="img" style="min-height:380px;">
                                <img class="book block-center img-responsive" src="img/books/<?= $new['img'] ?>">
                            </div>
                            <div class="title" style="overflow: hidden; min-height:60px; margin-top:5px;">
                                <?= strtoupper($new['Title']) ?>
                            </div>
                        </div>
                    </a>
                </div>
            <?php endforeach; ?>
            <!-- end one book -->

        </div>
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

</html>
<!--	
<script>
$('#my_select').change(function() {   
   // assign the value to a variable, so you can test to see if it is working
    var selectVal = $('#my_select :selected').val();
    alert(selectVal);
});
</script>

-->