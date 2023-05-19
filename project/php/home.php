<?php 
$servername="localhost";
$username="root";
$password="usbw";
$database="bioserver_db";
$conn = mysqli_connect($servername ,$username, $password,  $database );

if(!$conn)
{
	die(mysqli_error());
}
$errorMessage="";
$successMsg="";

if(isset($_POST['submit']))
{

	$textareaValue = trim($_POST['sequence']);
    if (!empty($textareaValue)) {

        $sql = "insert into  usersseq (Seq) values ('".$textareaValue."')";
        $rs = mysqli_query($conn, $sql);
        $affectedRows = mysqli_affected_rows($conn);
        
    }
	
	if($affectedRows > 0)
	{
		$successMsg = "Record has been saved successfully";
	}
    else if($affectedRows = 0){
        $errorMessage = "Input required";
    }
}
?> 
<!-- The Biological Functions in PHP -->

<?php

function check($str){
    $str=strtoupper($str);
    $arr=str_split($str);
    foreach ($arr as $char) {
        if($char !="A" and $char!="C" and $char!="G" and $char!="T"){
            return false;
        }
    }
    return true;
}

function Complement($dna){
    $dna=strtoupper($dna);
    $conversion = ["A" => "T", "T" => "A", "G" => "C", "C" => "G"];
    $dna = str_split($dna);
    $res = "";
    foreach ($dna as $el) {
        $res .= $conversion[$el];
    }
    return $res;
}

function GC($dna){
    $dna=strtoupper($dna);
    $counter = 0;
    $counter2=0;
    $counter +=substr_count($dna,"C");
    $counter2 += substr_count($dna,"G");
    $counter2+=$counter;
    $dnalen=strlen($dna);
    return ($counter2/$dnalen)*100; 
}

function transcription ($dna){
    $dna=strtoupper($dna);
    $conversion = ["A" => "U", "T" => "A", "G" => "C", "C" => "G"];
    $dna = str_split($dna);
    $res = "";
    foreach ($dna as $el) {
        $res .= $conversion[$el];
    }
    return $res;
}

function translation($seq){
    $seq=strtoupper($seq);
    $genetic_code = [
        "TTC" => "F",
        "TTA" => "L",
        "TTG" => "L",
        "CTT" => "L",
        "CTC" => "L",
        "CTA" => "L",
        "CTG" => "L",
        "ATT" => "I",
        "ATC" => "I",
        "ATA" => "I",
        "ATG" => "M",
        "GTT" => "V",
        "GTC" => "V",
        "GTA" => "V",
        "GTG" => "V",
        "TCT" => "S",
        "TCC" => "S",
        "TCA" => "S",
        "TCG" => "S",
        "CCT" => "P",
        "CCC" => "P",
        "CCA" => "P",
        "CCG" => "P",
        "ACT" => "T",
        "ACC" => "T",
        "ACA" => "T",
        "ACG" => "T",
        "GCT" => "A",
        "GCC" => "A",
        "GCA" => "A",
        "GCG" => "A",
        "TAT" => "Y",
        "TAC" => "Y",
        "TAA" => "Stop",
        "TAG" => "Stop",
        "CAT" => "H",
        "CAC" => "H",
        "CAA" => "Q",
        "CAG" => "Q",
        "AAT" => "N",
        "AAC" => "N",
        "AAA" => "K",
        "AAG" => "K",
        "GAT" => "D",
        "GAC" => "D",
        "GAA" => "E",
        "GAG" => "E",
        "TGT" => "C",
        "TGC" => "C",
        "TGA" => "Stop",
        "TGG" => "W",
        "CGT" => "R",
        "CGC" => "R",
        "CGA" => "R",
        "CGG" => "R",
        "AGT" => "S",
        "AGC" => "S",
        "AGA" => "R",
        "AGG" => "R",
        "GGT" => "G",
        "GGC" => "G",
        "GGA" => "G",
        "GGG" => "G"
    ];
    $translated_seq = "";
    $codons = str_split($seq, 3);

    echo nl2br("\nThe DNA coding sequence is:\n$seq\n");
    echo nl2br("\nThe translation of the individual codons is:\n");
    foreach ($codons as $codon) {
        $translated_codon = $genetic_code[$codon];
        echo nl2br("$codon translates to $translated_codon\n");
        if ($translated_codon == "Stop") {
            break;
        }
        $translated_seq = $translated_seq . $translated_codon;
    }

    echo nl2br("\nThe protein sequence is: $translated_seq");
}

function getMostFreqKmer($seq,$k){
    $seq=strtoupper($seq);
    $arr=array();
    for($i=0;$i<(strlen($seq)-$k+1);$i++){
            array_push($arr,substr($seq,$i,$k));
    }
    $countsOfElem=array_count_values($arr);
    arsort($countsOfElem);
    echo ("The most frequent $k-mer is ".array_keys($countsOfElem)[0]);
}
function cpgRatio($seq){
    $seq=strtoupper($seq);
    $counter = 0;
    $counter2=0;
    $counter +=substr_count($seq,"C");
    $counter2 += substr_count($seq,"G");
    $cpg=($counter*$counter2)/strlen($seq);
    echo ("The cpg ratio of sequence is ".$cpg);
}

?>

<!-- HTML PART OF HOME PAGE -->
<html>

<head>
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous" />
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- CSS -->
    <link rel="stylesheet" href="../css/style.css" />

    <title>Home page</title>
</head>


<body id="homeBody">
    <section id="home">
        <!-- Nav-Bar -->
        <nav class="navbar navbar-dark  navbar-expand-lg">
            <div class="container-fluid">
                <a class="navbar-brand ms-2" href="#">
                    <i class="fa-solid fa-dna "></i>
                    BioSeq
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse justify-content-end" id="navbar-list-6">
                    <ul class="navbar-nav justify-content-evenly">
                        <li class="nav-item active">
                            <a class="nav-link" href="#">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link"
                                href="../php/usersTable.php">FastaSeq</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link"
                                href="../php/table.php">Genome</a>
                        </li>
                        <li class="nav-item">

                            <button id="logOutBtn" class="btn-log py-2 me-4"> <i
                                    class="fa-solid fa-user me-1"></i>Logout</button>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- Head -->
        <div class="content-header d-sm-flex align-items-center">
            <h1 class="align-self-center mr-auto text-white mt-5 ms-3">Biological Functions</h1>
        </div>

        <!-- Biological Functions Section -->
        <section id="BioFunc-content">
            <div class="content-container ">
                <div class=" w-100 my-5 p-5 boxShadow">
                    <div class="header pb-1">
                        <p>Enter one or more DNA/amino acid sequences in FASTA Format </p>
                    </div>
                    <div class="content">
                    <!-- To handle Error -->
                    <?php
                     if (!empty($errorMessage)) 
                       {
                         echo"
                             <div class='alert alert-warning alert-dismissible fade show' role='alert'>
                             <strong>$errorMessage</strong>
                             <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='close'></button>
                            </div>
                            ";
                        }
                    ?> 

                        <form  method="POST">
                            <div class="form-group">
                                <label for="sequence"></label>
                                <textarea class="form-control" id="sequence" name="sequence" rows="6"></textarea>
                                <!-- Successfully Added -->
                                 <?php
                                if (!empty($successMsg)) 
                                {
                                    echo"
                                    <div class='alert alert-warning alert-dismissible fade show' role='alert'>
                                    <strong>$successMsg</strong>
                                    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='close'></button>
                                    </div>
                                    ";
                                }
                                ?> 
                            </div>

                            <div class="submit-btn mt-5 ">
                                <p class="sntence">You can choose one of the following functions to perform:</p>
                                <input class="inputFun mb-2" type="submit" value="GC Content" name="GC">
                                <input class="inputFun mb-2" type="submit" value="Complement" name="complement">
                                <input class="inputFun mb-2" type="submit" value="Translation" name="translation">
                                <input class="inputFun mb-2" type="submit" value="Transcription" name="transcription">
                                <input class="inputFun mb-5" type="submit" value="CPG Ratio" name="cpg_ratio">
                                 <!--Button that shows input field to input the k value and it is hidden--> 
                                <input class="inputFun mb-2" type="button" value="Frequent k-mer" name="get_k_value" onclick="show_elem()" id="kval">
                                <!--Input field to enter the k value-->
                                <input type="number" hidden id="k_value" value="k_value" name="k_value" >
                                <!--Submit field to take sequence and k value to be passed to php-->
                                <input class="inputFun " type="submit" hidden name="most_freq_kmer" id="most_freq_kmer" value= "Enter k value" >
                            </div>
                        
                    <section class="func-result">
                          
                        <?php

                            if(array_key_exists('GC', $_POST)) {
                                $input=$_POST["sequence"];
                                if(!check($input)){
                                    echo "please enter a valid dna sequence";
                                    return;
                                }
                                echo "GC content in sequence is: ";
                                echo GC($input);
                                echo" %";
                            }
                            else if(array_key_exists('complement', $_POST)) {
                                $input=$_POST["sequence"];
                                if(!check($input)){
                                    echo "please enter a valid dna sequence";
                                    return;
                                }
                                echo nl2br("Dna sequence complement is: \n");
                                echo Complement($input);
                            }
                            else if(array_key_exists('translation', $_POST)) {
                                $input=$_POST["sequence"];
                                if(!check($input)){
                                    echo "please enter a valid dna sequence";
                                    return;
                                }
                                echo translation($input);
                            }
                            else if(array_key_exists('transcription', $_POST)) {
                                $input=$_POST["sequence"];
                                if(!check($input)){
                                    echo "please enter a valid dna sequence";
                                    return;
                                }
                                echo nl2br("Dna sequence transcription is: \n");
                                echo transcription($input);
                            }
                            else if(array_key_exists('most_freq_kmer', $_POST)) {
                                $input=$_POST["sequence"];
                                $kvalue=$_POST["k_value"];
                                if(!check($input)){
                                    echo "please enter a valid dna sequence";
                                    return;
                                }
                                getMostFreqKmer($input,$kvalue);
                            }
                            else if(array_key_exists('cpg_ratio', $_POST)) {
                                $input=$_POST["sequence"];
                                if(!check($input)){
                                    echo "please enter a valid dna sequence";
                                    return;
                                }
                                cpgRatio($input);
                            }
                            ?>
                    </section>
                            <button class="button-34 mt-5" role="button" type="submit" name="submit"
                                value="Submit">Save</button>
                        </form>
                        
                    </div>
                </div>
        </section>
    </section>
    <!-- JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
        crossorigin="anonymous"></script>
    <script src="../js/main.js"></script>
    <script>
            function show_elem(){
                document.getElementById('k_value').hidden = false
                document.getElementById('most_freq_kmer').hidden = false
                document.getElementById('kval').hidden = true
            }

        </script>
</body>

</html>

