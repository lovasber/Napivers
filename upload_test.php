<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<form action="" method="post">
<label for="">szezo</label>
<input type="text" name="szerzo" id="szerzo">
<br>
<label for="cim">cim</label>
<input type="text" name="cim" id="cim">
<input type="submit" value="OK">
    </form>

    <?php 
    include "connection.php";
    include "functions.php";

    if(!empty($_POST["szerzo"]) && !empty($_POST["cim"])){

        $input_szerzo = $_POST["szerzo"];
        $input_cim = $_POST["cim"];
        echo is_mar_letezo_vers($conn,$input_szerzo,$input_cim)?"Már létezik a vers":"Még nincs ilyen az adatbázisban";    

    }

?>
</body>
</html>