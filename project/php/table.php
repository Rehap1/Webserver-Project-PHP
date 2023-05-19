<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
     <!-- CSS -->
     <link rel="stylesheet" href="../css/style2.css" />
    <title>Genome</title>
</head>
<body class="m-4 tableBody1">
     <!-- Nav-Bar -->
     <nav class="navbar navbar-dark  navbar-expand-lg">
            <div class="container-fluid">
                <a class="navbar-brand ms-2" href="#">
                    <i class="fa-solid fa-dna "></i>
                    <h3 >BioSeq</h3>
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse justify-content-end" id="navbar-list-6">
                    <ul class="navbar-nav justify-content-evenly">
                        <li class="nav-item active">
                            <a class="nav-link" href="/project/php/home.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link"
                                href="../php/usersTable.php">FastaSeq</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link"
                                href="../php/table.php">Genome</a>
                        </li>
                     
                    </ul>
                </div>
            </div>
        </nav>
    <h1 class="text-white font-weight-bold">List of Genes</h1>
    <a class="btn btn-primary btn-lg" href="../php/create.php" role="button">New Gene</a>
    <br>
    <!-- TABLE -->
    <table class="table bg-white mt-2 rounded">
        <thead>
            <tr>
                <th>ID</th>
                <th>Gene Name</th>
                <th>Fasta Sequence</th>
                <th>Action</th>
            </tr>
        </thead>

        <tbody>
            <?php

            $servername="localhost";
            $username="root";
            $password="usbw";
            $database="bioserver_db";

            $connection= new mysqli(  $servername ,$username, $password,  $database );

            if ($connection->connect_error){
                die("Connection failed:". $connection->connect_error );
            }

            $sql = "SELECT * FROM gene";
            $result = $connection->query($sql);

            if (!$result){
                die("Invalid Query: " . $connection->error);
            }
            // read data of each row
            while ($row = $result->fetch_assoc()) {
                echo"<tr>
                <td>$row[GID]</td>
                <td>$row[GName]</td>
                <td>$row[FastaSeq]</td>
                <td>
                    <a class='btn btn-primary btn-sm m-2 py-2 px-3 rounded' href='../php/edit.php?GID=$row[GID]'>Update</a>
                    <a class='btn btn-danger btn-sm m-2 py-2 px-3 rounded' href='../php/delete.php?GID=$row[GID]'>Delete</a>
                </td>
              </tr>";
            }
           
            ?>
        </tbody>
    </table>
</body>
</html>