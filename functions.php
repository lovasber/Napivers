<?php

function uj_vers_feltolt($conn,$szerzo,$cim,$vers_torzs){    
    $stmt = $conn->prepare("INSERT INTO vers (id, szerzo, cim, torzs) VALUES (NULL, ?, ?, ?)");
    $stmt->bind_param("sss",$szerzo,$cim,$vers_torzs);
    $stmt->execute();    
}

function get_osszes_vers_db($conn){
    $sql = "SELECT COUNT(id) as 'versDb' FROM vers";
    $result = $conn->query($sql);
    $db = 0;
    while($row = $result->fetch_assoc()) {            
        $db = $row["versDb"];
    }
    return $db;
}

function get_random_vers_id($conn){
    return random_int(1,get_osszes_vers_db($conn));
}

function get_random_vers($conn){
    $sql = "SELECT * FROM vers
    ORDER BY RAND()
    LIMIT 1";
    $result = $conn->query($sql);
    if (!$result) {  
        trigger_error('Invalid query: ' . $conn->error);       
    } else {
        echo "<br>";
        $tab = "&#9;";
        while($row = $result->fetch_assoc()) {
            echo "<div class ='versbody'>";
                echo "<div class='d-flex justify-content-center' id='vers_header'>".$row["szerzo"]. $tab ."-". $tab."".$row["cim"]."</div><br><br>";
                echo "<div class='d-flex justify-content-center' id='vers'>".nl2br($row["torzs"])."</div>";
            echo "</div>";
            echo "<br><br>";
        }
    }
}

function get_osszes_vers($conn){
    $sql = "SELECT * FROM vers";
    $result = $conn->query($sql);
    if (!$result) {  
        trigger_error('Invalid query: ' . $conn->error);       
    } else {
        echo "<br>";
        while($row = $result->fetch_assoc()) {
            echo $row["szerzo"]." - ".$row["cim"]."<br>";
            echo nl2br($row["torzs"]);
            echo "<br><br>";
        }
    }
}

function uj_napi_vers_frissit($conn){    
    $stmt = $conn->prepare("INSERT INTO aktualis_napi_vers (id,datum,versid)
    VALUES (Null,CURDATE(), 
     (SELECT id
     FROM vers
     ORDER BY RAND()
     LIMIT 1
     )       
    )");
    $stmt->execute();    
}

function get_osszes_vers_as_legordulo($conn){
    $sql = "SELECT * FROM vers ORDER BY szerzo, cim";
    $result = $conn->query($sql);
    if (!$result) {  
        trigger_error('Invalid query: ' . $conn->error);       
    } else {
        while($row = $result->fetch_assoc()) {
            echo "<option>".$row["szerzo"]." - ".$row["cim"]."</option>";
        }
    }
   
}

function get_napi_vers($conn){
    $sql = 
    "SELECT *
    FROM vers
    WHERE vers.id = 
    (
        SELECT versid
        FROM aktualis_napi_vers
        ORDER BY id DESC
        LIMIT 1
    )";
    
    $tab = "&#9;";
    $result = $conn->query($sql);
    if (!$result) {  
        trigger_error('Invalid query: ' . $conn->error);  
       
    } else {
        echo "<br>";
        while($row = $result->fetch_assoc()) {
            echo "<div class ='versbody'>";
                echo "<div class='d-flex justify-content-center' id='vers_header'>".$row["szerzo"]. $tab ."-". $tab."".$row["cim"]."</div><br><br>";
                echo "<div class='d-flex justify-content-center' id='vers'>".nl2br($row["torzs"])."</div>";
            echo "</div>";
            echo "<br><br>";
        }
    }
}

function is_mar_letezo_vers($conn,$input_szerzo,$input_cim){
    $mar_letezo_vers = false;
    $mar_letezo_szerzo = false;
    $mar_letezo_szerzo_sql = "SELECT szerzo FROM vers";
    $mar_letezo_szerzo_result = $conn->query($mar_letezo_szerzo_sql);
    if (!$mar_letezo_szerzo_result) {  
        trigger_error('Invalid query: ' . $conn->error);       
    } else {
        while($row = $mar_letezo_szerzo_result->fetch_assoc()) {
            if($row["szerzo"] == $input_szerzo){
                $mar_letezo_szerzo = true;
            }
        }
        if($mar_letezo_szerzo){
            echo 'ilyen szerzo mar van!<br>';
        }
    }

    $mar_letezo_cim = false;
    $mar_letezo_cim_stmt = $conn->prepare("SELECT cim FROM vers WHERE szerzo = ?");
    $mar_letezo_cim_stmt->bind_param("s",$input_szerzo);
    $mar_letezo_cim_stmt->execute();   
    $mar_letezo_cim_stmt->bind_result($oszlop1);

    while($row = $mar_letezo_cim_stmt->fetch()) {
        if($oszlop1 == $input_cim){
            $mar_letezo_cim = true;
        }
    }
    if($mar_letezo_szerzo){
        echo 'ilyen verscím mar van!<br>';
    }
    if($mar_letezo_szerzo && $mar_letezo_cim){
        $mar_letezo_vers = true;
    }

    return $mar_letezo_vers;
}

function get_napi_vers_tomb($conn){
    $tomb['szerzo'] = "";
    $tomb['cim'] = "";
    $tomb['torzs'] = "";

    $sql = "SELECT *
    FROM vers
    WHERE vers.id = 
    (
        SELECT versid
        FROM aktualis_napi_vers
        ORDER BY id DESC
        LIMIT 1
    )";
    $result = $conn->query($sql);
    if (!$result) {  
        trigger_error('Invalid query: ' . $conn->error);       
    } else {
        
        while($row = $result->fetch_assoc()) {
            $tomb['szerzo'] = $row['szerzo'];
            $tomb['cim'] = $row['cim'];
            $tomb['torzs'] = $row['torzs'];
        }
        
    }
    return $tomb;
}

function get_admin_view($conn){
    $sql = "SELECT * FROM ideiglenes_vers";
    $result = $conn->query($sql);
    if (!$result) {  
        trigger_error('Invalid query: ' . $conn->error);       
    } else {
        
        $index = 1;
        while($row = $result->fetch_assoc()) {
            echo "<div class='adminvers' >";
                $vers = "<textarea>".$row["torzs"]." </textarea>";
                echo "$index. <input type='text' value='".$row["szerzo"]."'> <input type='text' value='".$row["cim"]."'>";
                echo $vers;
                $id = $row['id'];
                echo "<button class='' onclick='feltolt($id)'>Feltölt</button>";
                echo "<br>";
            echo "</div>";
            $index++;
        }
        
    }

}

function ideiglenes_vers_veglegesit($conn){
    //TODO
}

function ideiglenes_vers_torol($conn){
    //TODO
}

?>