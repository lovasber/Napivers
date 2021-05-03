<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <script src="jquery-3.6.0.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    
    <link rel="stylesheet" href="style.css">  

    <!-- ikon 
    <link rel="apple-touch-icon" sizes="180x180" href="favicon_io/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="favicon_io/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="favicon_io/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">
-->
    <link rel="icon" type="image/png" href="ikon/Logo.png"/>
    <meta name="theme-color" content="#ffffff">


    <!-- Shareing meta -->
    <meta property="og:url"                 content="http://lovas.it/napivers/index.php" />
    <meta property="og:type"               content="poem" />
    <meta property="og:title"              content="Napi vers" />
    <meta property="og:description"        
    content="<?php 

    include "functions.php";
    include "connection.php";

    //szerző - cím
    echo get_napi_vers_tomb($conn)['szerzo']. " - "  .get_napi_vers_tomb($conn)['cim'];

    ?>" />
    <meta property="og:image" content="ikon/Logo.png" />
    <title>Napi vers</title>
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
                <li class="nav-item">
                    <a class="nav-item nav-link active"  href="#">Admin</a>
                </li>
            </ul>
        </div>
    </nav>
</header>

    <div class="admin" >
        <div class="">
            <?php 
                get_admin_view($conn);
            ?>
        </div>
    </div>
  

<script src="darkmode.js"></script>   
<script src="admin.js"></script>

</body>
</html>