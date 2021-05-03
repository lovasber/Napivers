<!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feltöltés</title>
    <script src="jquery-3.6.0.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
        
    <script src="validate.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <link rel="stylesheet" href="style.css">
</head>
<body>

<header>
    <nav id="fejlec" class="navbar navbar-expand-lg navbar-light bg-light lightmode" >
        <a class="navbar-brand active" href="index.php">Főoldal</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#hamburger" aria-controls="hamburger" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="hamburger">            
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-item nav-link active"  href="upload.php">Feltöltés</a>
                </li>
<!--
                <li class="nav-item">
                    <a class="nav-item nav-link active"  href="bongeszes.php">Böngészés</a>
                </li>
                <li class="nav-item">
                    <a class="nav-item nav-link active"  href="oldalrol.php">Az oldalról</a>
                </li>
-->
            </ul>
        </div>
    </nav>
</header>
<div id="main" class="feltoltmain">
<br>
    <div class="container">
        <form id="myFrom" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        
            <div class="form-group">
                <label for="szerzo">Szerző</label><br>
                <input onkeyup="validateMain()" type="text" name="szerzo" id="szerzo">
            </div>
            <br>
            <div class="from-group">
                <label for="cim">Cím</label><br>
                <input onkeyup="validateMain()" type="text" name="cim" id="cim">
            </div>
        

            <br>
            <div class="from-group">
                <label for="vers_torzs">Vers</label><br>
                <textarea onkeyup="validateMain()" name="vers_torzs" id="vers_torzs" cols="90" rows="20"></textarea>
            </div>
            <button class="btn btn-primary mb-2" type="submit" disabled id="subButton">Elküld</button>
        </form>
    

    <h4>Eddigi versek: </h4>
        <select name="" id="">
            <?php 
            include "functions.php";
            include "connection.php";
                get_osszes_vers_as_legordulo($conn);
            ?>
        </select>

    </div>


    <?php 

        if(!empty($_POST["szerzo"]) && !empty($_POST["cim"])){

            $input_szerzo = $_POST["szerzo"];
            $input_cim = $_POST["cim"];
            echo is_mar_letezo_vers($conn,$input_szerzo,$input_cim)?"Már létezik a vers":"Még nincs ilyen az adatbázisban"; 
            
            if(!is_mar_letezo_vers($conn,$input_szerzo,$input_cim)){
                $cim = $_POST["cim"];
                $szerzo = $_POST["szerzo"];
                $torzs = $_POST["vers_torzs"];
                uj_vers_feltolt($conn,$szerzo, $cim, $torzs);
                echo 'sikeres feltöltés';
                echo "<meta http-equiv='refresh' content='0'>";
            }

        }

        unset($_POST["cim"]);
        unset($_POST["szerzo"]);
        unset($_POST["vers_torzs"]);
    ?>
</div>


<script src="darkmode.js"></script>

</body>
</html>