<!-- Insert New Gene in the DB -->
<?php
$servername="localhost";
$username="root";
$password="usbw";
$database="bioserver_db";

$connection= new mysqli(  $servername ,$username, $password,  $database );

$gname="";
$fseq="";


$errorMessage="";
$successMessage="";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $gname=$_POST["gname"];
    $fseq=$_POST["fseq"];
 

    do {
        
        if (empty($gname) || empty( $fseq) ) {
            $errorMessage = "All fields are required";
            break;
        }

        // Add new Client to the database
        $sql = "INSERT INTO gene(GName, FastaSeq)".
               "VALUES ('$gname' , '$fseq' )";

        $result = $connection->query($sql);

        if (!$result) {
            $errorMessage = "Invalid Query: ".$connection->error;
            break;
        }

        $gname="";
        $fseq="";

        $successMessage = "Client added correctly";

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

    <title>Document</title>
</head>
<body>



<div class="container m-5">
    <h2>New Gene</h2>
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
    <!-- Form -->
    <form method="POST">
        <div class="row mb-3">
            <label class="col-sm-3 col-form-label">Gene Name</label>
          <div class="row mb-6">
             <input type="text" class="form-control" name="gname" value="<?php echo $gname; ?>">
           </div>
        </div>

        <div class="row mb-3">
            <label class="col-sm-3 col-form-label">Fasta Sequence</label>
          <div class="row mb-6">
             <input type="text" class="form-control" name="fseq" value="<?php echo $fseq; ?>">
           </div>
        </div>
         <!-- Succesful -->
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
                <button type="submit"  class="btn btn-primary"> Insert </button>
            </div>

            <div class="col-sm-3 d-grid">
                <a  class="btn btn-outline-primary" href="/project/php/table.php" role="button" > Cancel </a>
            </div>
        </div>

    </form>

</div>
</body>
</html>