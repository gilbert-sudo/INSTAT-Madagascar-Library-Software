<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="Books">
  <meta name="author" content="Shivangi Gupta">
  <title> Online Bookstore</title>
  <!-- Bootstrap -->
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <link href="css/my.css" rel="stylesheet">

  <style>
    @media only screen and (width: 768px) {
      body {
        margin-top: 150px;
      }
    }

    @media only screen and (max-width: 760px) {
      #books .row {
        margin-top: 10px;
      }
    }

    .tag {
      display: inline;
      float: left;
      padding: 2px 5px;
      width: auto;
      background: #F5A623;
      color: #fff;
      height: 23px;
    }

    .tag-side {
      display: inline;
      float: left;
    }

    #books {
      border: 1px solid #DEEAEE;
      margin-bottom: 20px;
      padding-top: 30px;
      padding-bottom: 20px;
      background: #fff;
      margin-left: 10%;
      margin-right: 10%;
    }

    #description {
      border: 1px solid #DEEAEE;
      margin-bottom: 20px;
      padding: 20px 50px;
      background: #fff;
      margin-left: 10%;
      margin-right: 10%;
    }

    #description hr {
      margin: auto;
    }

    #service {
      background: #fff;
      padding: 20px 10px;
      width: 112%;
      margin-left: -6%;
      margin-right: -6%;
    }

    .glyphicon {
      color: #D67B22;
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
        <form role="search" action="Result.php" method="post">
          <input type="text" name="keyword" class="form-control" placeholder="Rechercher un livre, un auteur ou une catégorie" style="width:80%;margin:20px 10% 20px 10%;">
        </form>
      </div>
    </div>
  </div>


  <?php
  include "dbconnect.php";
  $PID = $_GET['ID'];
  if (isset($_GET['error'])) {
    echo "<div class='alert alert-danger' role='alert'>
    <strong>Erreur!</strong> Vous devez être connecté pour télécharger un livre.
  </div>";
  $error = $_GET['error'];
  } else {
    $error = "";
  }
  if (isset($_GET['success']) && $_GET['success'] == 1) {  
    echo "<div class='alert alert-success' role='alert'>";
    echo "<strong>Succès!</strong> Le livre a été ajouté parmi vos favoris.";
    echo "</div>";
  } 
  if (isset($_GET['success']) && $_GET['success'] == 2) {  
    echo "<div class='alert alert-success' role='alert'>";
    echo "<strong>Succès!</strong> Le livre a bien été télécharger.";
    echo "</div>";
  } 
  $sql = "SELECT * FROM favori WHERE Product = '$PID'";
  $isFavori = $db->prepare($sql);
  $isFavori->execute();
  $isFavori = $isFavori->fetch();
 
  $result = $db->prepare("SELECT * FROM products WHERE PID = '$PID'");
  $result->execute();
  $numRows = 0;
  while ($row = $result->fetch(SQLITE3_ASSOC)) {
    ++$numRows;
  }
  if ($numRows == 1) {
    $result->execute();
    $row = $result->fetch();
    if (isset($row)) {
      $path = "img/books/" . $row['img'];
      $target = "cart.php?ID=" . $PID . "&";
      $date = date_parse($row["publishAt"]);
      $day_date = $date['day'];
      $month_date = $date['month'];
      $year_date = $date['year'];
      $size = $row["Author"];
      $size = octetIntoMo($size);
      echo '
      <div class="container-fluid" id="books" style="margin-top:20px;">
    <div class="row">
      <div class="col-sm-10 col-md-5">
                          <div class="tag">#' . $row["Author"] . '</div>
                              <div class="tag-side"><img src="img/orange-flag.png">
                          </div>
                         <img class="center-block img-responsive" src="' . $path . '"  style="padding:20px; height:450px">
      </div>
      <div class="col-sm-10 col-md-6 col-md-offset-1">
        <h2> ' . $row["Title"] . '</h2>
                                <span style="color:#00B9F5;">
                                 #' . $row["Author"] . '&nbsp &nbsp 
                                </span>
        <hr>            
                                <span style="font-weight:bold;"> Langue : ' . $row["Language"] . ' </span> ';


      $pdf = $row['pdf'];
      $file_exists = file_exists("books/$pdf");
      if ($file_exists == true && $error != 1) { ?>
        <br><br><br>
        <a onclick="NewTab();" id="buyLink" href="read.php?name=<?= $row['pdf'] ?>" target="__BLANK" class="btn btn-lg btn-danger" style="min-width: 100px; padding:15px;color:white;text-decoration:none;">
          Lire<br>
        </a>
        <?php if(!$isFavori){?>
        <a id="buyLink" href="add-to-favorite.php?ID=<?= $PID ?>&quantity=1" class="btn btn-lg btn-danger" style="min-width: 100px; padding:15px;color:white;text-decoration:none;">
          Ajouter aux favoris<br>
        </a>
        <?php } else { ?>
          <a href="cart.php" class="btn btn-lg btn-success" style="min-width: 100px; padding:15px;color:white;text-decoration:none;">
            Parmi vos favoris  ❤ <br>
          </a>
        <?php } ?>

        </div>
        </div>
        </div>

      <?php  } else { ?>
        <br><br><br>
        <a id="downloadLink" href="#" class="btn btn-lg btn-danger" style="padding:15px;color:white;text-decoration:none;" disabled>
          Télécharger (<?= number_format($size, 2, '.', ''); ?>Mo)<br>
        </a>

        </div>
        </div>
        </div>

      <?php }


      ?>

      <div class="container-fluid" id="description">
        <div class="row">
          <h2> Déscription </h2>
          <p> <?= $row['Description'] ?> </p>
          <div class="container">
            <table>
              <tbody>

                <tr>
                  <td><strong> Titre </strong></td>
                  <td>:</td>
                  <td> &nbsp;&nbsp;<?= $row["Title"] ?></td>
                </tr>
                <tr>
                  <td><strong>Taille</strong> </td>
                  <td>:</td>
                  <td>&nbsp;&nbsp;<?= number_format($size, 2, '.', ''); ?>Mo</td>
                </tr>
                <tr>
                  <td><strong>Langue</strong> </td>
                  <td>:</td>
                  <td>&nbsp;&nbsp;<?= $row["Language"] ?></td>
                </tr>
                <tr>
                  <td><strong>Pages</strong> </td>
                  <td>:</td>
                  <td>&nbsp;&nbsp; <?= $row["page"] ?></td>
                </tr>
                <tr>
                  <td><strong> Publié le</strong> </td>
                  <td>:</td>
                  <td> &nbsp;&nbsp;<?= $day_date . '/' . $month_date . '/' . $year_date ?> </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
  <?php
    }
  }
  echo '</div>';
  ?>







  <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
  <script src="js/jquery.min.js"></script>
  <!-- get js functions-->
  <script>
    var download = "downloading.php?pdf=<?= $row['pdf'] ?>&id=<?= $PID ?>";
  </script>
  <script src="js/check_connection.js"></script>
  <!-- Include all compiled plugins (below), or include individual files as needed -->
  <script src="js/bootstrap.min.js"></script>
  <!-- get js functions-->
  <script src="js/functions.js"></script>
  <!-- get js functions-->
  <script src="js/update.js"></script>
  <!-- download the PDF file-->

</body>

</html>