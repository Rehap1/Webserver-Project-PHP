<!-- Update a gene in DB -->
<?php
$servername="localhost";
$username="root";
$password="usbw";
$database="bioserver_db";

$connection= new mysqli($servername, $username, $password,  $database);

$id="";
$gname="";
$fseq="";

$errorMessage="";
$successMessage="";

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    // GET METHOD:show the data of the client
    if(!isset($_GET["GID"])){
        header("location: /project/php/table.php");
        exit;
    }
    $id=$_GET["GID"];


    
    // read the row of the selected data from the database
    $sql="SELECT * FROM gene WHERE GID=$id";
    $result = $connection->query($sql);
    $row=$result->fetch_assoc();

    if (!$row) {
        header("location: /project/php/table.php");
        exit;
    }

    $gname=$row["GName"];
    $fseq=$row["FastaSeq"];
  

}else{
    // POST method: update the data of the client
    $id=$_POST["id"];
    $gname=$_POST["gname"];
    $fseq=$_POST["fseq"];


    do {
        if (empty($gname) || empty( $fseq) ) {
            $errorMessage = "All fields are required";
            break;
        }

        $sql = "UPDATE gene SET GName='$gname' , FastaSeq='$fseq' WHERE GID = '$id' ";
               

        $result = $connection->query($sql);

        if(!$result){
            $errorMessage = "Invalid query: ".$connection->error;
            break;
        }

        $successMessage="Client updated Correctly";
        header("location: /project/php/table.php");
        exit;

    } while (false);

}

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
  
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>

    <title>Update</title>
</head>
<body>



<div class="container m-5">
    <h2>Update Gene</h2>
    <!-- Handle Error -->
    <?php
    if (!empty($errorMessage)) {
       echo"
       <div class='alert alert-warning alert-dismissible fade show' role='alert'>
            <strong>$errorMessage</strong>
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='close'></button>
        </div>
       ";
    }
    ?>

    <form method="POST">
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        <div class="row mb-3">
            <label class="col-sm-3 col-form-label">First Name</label>
          <div class="row mb-6">
             <input type="text" class="form-control" name="gname" value="<?php echo $gname; ?>">
           </div>
        </div>

        <div class="row mb-3">
            <label class="col-sm-3 col-form-label">Last Name</label>
          <div class="row mb-6">
             <input type="text" class="form-control" name="fseq" value="<?php echo $fseq; ?>">
           </div>
        </div>
        <!-- Successful -->
        <?php
             if (!empty($successMessage)) {
              echo"
                <div class='alert alert-warning alert-dismissible fade show' role='alert'>
                  <strong>$successMessage</strong>
                 <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='close'></button>
                </div>
             ";
             }
    ?>

        <div class="row mb-3">
            <div class="offset-sm-3 col-sm-3 d-grid">
                <button type="submit"  class="btn btn-primary"> Update </button>
            </div>

            <div class="col-sm-3 d-grid">
                <a  class="btn btn-outline-primary" href="/project/php/table.php" role="button" > Cancel </a>
            </div>

        </div>

    </form>

</div>
</body>
</html>