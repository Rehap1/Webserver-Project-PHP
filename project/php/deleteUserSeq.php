<!-- Delete user Sequence from DB -->
<?php
if (isset($_GET["id"])) {
    $id = $_GET['id'];

    $servername="localhost";
    $username="root";
    $password="usbw";
    $database="bioserver_db";

    // Create Connection
    $connection= new mysqli( $servername ,$username, $password,  $database );

    $sql = "DELETE FROM usersseq WHERE id='$id' ";
    $connection->query($sql);

}

header("location:/project/php/usersTable.php");
exit;

?>