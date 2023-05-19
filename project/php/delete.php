<!-- Delete a gene from DB -->
<?php

if (isset($_GET["GID"])) {
    $id = $_GET['GID'];

    
    $servername="localhost";
    $username="root";
    $password="usbw";
    $database="bioserver_db";

    // Create Connection
    $connection= new mysqli(  $servername ,$username, $password,  $database );

    $sql = "DELETE FROM Gene WHERE GID='$id' ";
    $connection->query($sql);

}

header("location:/project/php/table.php");
exit;

?>