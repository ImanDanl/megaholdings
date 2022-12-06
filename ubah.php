<?php
$servername = "localhost" ;
$username = "root" ;
$password = "";
$database = "datapekerja" ;

// Create connection
$connection = new mysqli($servername, $username, $password, $database);


$id = "";
$nama_pekerja =  "";
$no_kp = "";
$jantina = "";
$no_hp = "";

$errorMessage = "";
$successMessage = "";

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    // GET method: Show the data of the pekerja

    if (!isset($_GET["id"] ) ) {
        header("location:/megaholdings/index.php");
        exit;
    }

    $id = $_GET["id"]; 

    // read the row of the selected pekerja from database table
    $sql = "SELECT * FROM info_pekerja WHERE id=$id";
    $result = $connection->query($sql);
    $row = $result->fetch_assoc();

    if (!$row) {
        header("location:/megaholdings/index.php");
        exit;
    }

    $nama_pekerja = $row["nama_pekerja"];
    $no_kp = $row["no_kp"];
    $jantina = $row["jantina"];
    $no_hp = $row["no_hp"];

}
else {
    // POST method: Update the data of the pekerja

    $id = $_POST["id"];
    $nama_pekerja = $_POST["nama_pekerja"];
    $no_kp = $_POST["no_kp"];
    $jantina = $_POST["jantina"];
    $no_hp = $_POST["no_hp"];

    do {
        if (empty($id) || empty($nama_pekerja) || empty($no_kp) || empty($jantina) || empty($no_hp) ) {
            $errorMessage = "All the fields are required";
            break;
        }

        $sql = "UPDATE info_pekerja " . 
               "SET nama_pekerja = '$nama_pekerja', no_kp = '$no_kp', jantina = '$jantina', no_hp = '$no_hp' " . 
               "WHERE id = $id";

               $result = $connection->query($sql);

               if (!$result) {
                $errorMessage = "Invalid query: ". $connection->error;
                break;

                $successMessage = "Pekerja telah berjaya di ubah";

                header("location:/megaholdings/index.php");
                exit;
            }

    }while(false);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mega Holdings</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container my-5">
        <h2>Ubah Pekerja</h2>

        <?php
        if (!empty($errorMessage) ) {
            echo "
            <div class='alert alert-warning alert-dismissible fade show' role='alert'>  
                 <strong>$errorMessage</strong>
                 <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>
            ";
        }
        ?>
        <form method="post">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Nama</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="nama_pelajar" value="<?php echo $nama_pekerja; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-3">No KP</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="no_kp" value="<?php echo $no_kp; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-3">Jantina</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="jantina" value="<?php echo $jantina; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-3">No HP</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="no_hp" value="<?php echo $no_hp; ?>">
                </div>
            </div>

            <?php
            if (!empty($successMessage) ) {
                echo "
                <div class='row mb-3'>
                    <div class='offset-sm-3 col-sm-6>
                        <div class='alert alert-success alert-dismissible fade show' role='alert'>
                            <strong>$successMessage</strong>
                            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label> 
                        </div>
                    </div>
                </div>
                ";
            }
            ?>

            <div class="row mb-3">                
                <div class="col-sm-3 d-grid">
                    <a class="btn btn-outline-primary" href="/megaholdings/index.php" role="buton">Cancel</a>
                </div>
                <div class="col-sm-3 d-grid">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>

            </div>
        </form>

    </div>