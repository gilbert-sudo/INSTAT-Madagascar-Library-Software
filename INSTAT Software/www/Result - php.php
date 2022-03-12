<?php
session_start();
$keyword = $_GET['keyword'];
?>


<!DOCTYPE html>
<html>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="css/w3.css">
<link rel="stylesheet" href="css/font-awesome.min.css">
<link rel="stylesheet" href="css/bootstrap.min.css" type="text/css">
<link rel="stylesheet" href="css/my.css" type="text/css">

<body>
    <style>
        #books .row {
            margin-top: 30px;
            font-weight: 800;
        }

        @media only screen and (max-width: 760px) {
            #books .row {
                margin-top: 10px;
            }
        }

        .book-block {
            margin-top: 20px;
            margin-bottom: 10px;
            padding: 10px 10px 10px 10px;
            border: 1px solid #DEEAEE;
            border-radius: 10px;
            height: 100%;
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
                    <form role="search" method="GET" action="Result.php">
                        <input type="text" id="searchInput" class="form-control" name="keyword" style="width:80%;margin:20px 10% 20px 10%;" placeholder="Rechercher un livre, un auteur ou une catégorie">
                    </form>
                </div>
                <div id="matchList"></div>
            </div>
            <?php
            include "dbconnect.php";
            

            $query = "SELECT * FROM products  where PID like '%{$keyword}%' OR Title like '%{$keyword}%' OR Author like '%{$keyword}%' OR Category like '%{$keyword}%'";
            $result = $db->prepare($query);
            $result->execute();
            $result = $result->fetchAll();
            $i = 0;
            echo '<div class="container-fluid" id="books">
                <div class="row">
                  <div class="col-xs-12 text-center" id="heading">
                         <h4 style="color:#00B9F5;text-transform:uppercase;"> ' . 1 . ' livres corréspondent </h4>
                   </div>
                </div>';

            foreach ($result as $row) {
                $path = "img/books/".$row['img'];
                $description = "description.php?ID=" . $row["PID"];
                if ($i % 3 == 0)  $offset = 0;
                else  $offset = 1;
                if ($i % 3 == 0)
                    echo '<div class="row">';
                echo '
                       <a href="' . $description . '">
                        <div class="col-sm-5 col-sm-offset-1 col-md-3 col-md-offset-' . $offset . ' col-lg-3 text-center w3-card-8 w3-dark-grey">
                            <div class="book-block">
                                <img class="book block-center img-responsive" src="' . $path . '">
                                <hr>
                                 ' . $row["Title"] . '<br>
                            </div>
                        </div>
                        
                       </a> ';
                $i++;
                if ($i % 3 == 0)
                    echo '</div>';
            }

            ?>

            <!-- get js functions-->
            <script src="js/functions.js"></script>
            <script>
                _id("searchInput").focus();
            </script>
            <!-- get js functions-->
            <script src="js/update.js"></script>
            <script src="js/search-app.js"></script>
    </body>

</html>