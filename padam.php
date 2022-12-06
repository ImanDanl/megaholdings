<?php
if (isset($_GET["id"] ) ) {
    $id = $_GET["id"];
    
    $servername = "localhost" ;
    $username = "root" ;
    $password = "";
    $database = "datapekerja" ;

    // Create connection 
    $connection = new mysqli($servername, $username, $password, $database);

    $sql = "DELETE FROM info_pekerja WHERE id=$id";
    $connection->query($sql);
    
}

header("location:/megaholdings/index.php");
exit;
?>