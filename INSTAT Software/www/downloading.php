<?php
ini_set('max_execution_time', 3600);
if (isset($_GET['id']) && isset($_GET['pdf'])) {
    $pdf = $_GET['pdf'];
    $id = $_GET['id'];
}
?>
<!doctype html>
<html>

<head>
    <meta charset='utf-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <title>Snippet - BBBootstrap</title>
    <link href='css/bootstrap.min.css' rel='stylesheet'>
    <link href='' rel='stylesheet'>
    <script type='text/javascript' src='js/jquery.min.js'></script>
    <style>
        html,
        body {
            width: 100%;
            height: 100%
        }

        body {
            background: #0d161f
        }

        #circle {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 150px;
            height: 150px
        }

        .loader {
            width: calc(100% - 0px);
            height: calc(100% - 0px);
            border: 8px solid #162534;
            border-top: 8px solid #09f;
            border-radius: 50%;
            animation: rotate 5s linear infinite
        }

        @keyframes rotate {
            100% {
                transform: rotate(360deg)
            }
        }
    </style>
</head>

<body oncontextmenu='return false' class='snippet-body'>
    <div class="text-white">
    </div>
    <div id="circle">
        <h2 style="color: white;margin-left: -33%;margin-top: -50%; position: absolute;width: max-content;">Téléchargement ...</h2>
        <div class="loader">
            <div class="loader">
                <div class="loader">
                    <div class="loader"> </div>
                </div>
            </div>
        </div>
        <h3 style="color: white;margin-left: -33%;margin-top: 20%; position: absolute;width: max-content;">Progréssion : <error id="error"><countdown id="count">0</countdown>%...</error></h3>
    </div>
    <script>
        var timeleft = 100;
        var time = 0;
        var downloadTimer = setInterval(function() {
            var number = Math.floor(Math.random() * 10);
            if (timeleft <= 0) {
                clearInterval(downloadTimer);
            }
            if (time > 100) {
                document.getElementById("count").innerHTML = "100";
            } else {
                document.getElementById("count").innerHTML = time;
            }
            time = 110 - timeleft;
            timeleft -= number;
        }, 3000);
    </script>
    <script type='text/javascript' src='js/bootstrap.bundle.min.js'></script>
    <!-- download the PDF file-->
    <script>
        var id = <?= $id ?>;
        var downloadUrl = 'download.php?name=<?= $pdf ?>&id=<?= $id ?>';

async function getCofirmNet() {
    return (await fetch("check_internet.php")).json();
}

setInterval(async () => {
    let response = [];
    try {
        response = await getCofirmNet();
    } catch (e) {
        response = "failed";
    }
    if (response == "failed") {
        console.log("Error!");
        document.getElementById("error").innerHTML = "Error!...";
        window.location.href = "description.php?error=1&ID=" + id;
    } 
       
}, 1000);
    </script>
    <script type='text/javascript' src='js/download.js'></script>

</body>

</html>