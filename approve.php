<?php
session_start();
if(!$_SESSION['auth']){
    header ("location:/admin/login.php");
}
$serverName = "localhost";
$user= 'root';
$db = 'ussdsecontrial';
$pass= "";
$conn = new mysqli($serverName,$user,$pass,$db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_GET["location"])){
    $location = $_GET["location"];

    $sql = "SELECT location FROM afterapproval WHERE location = '$location'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $check = "SELECT * FROM approved WHERE location='$location'";
        $exe = $conn->query($check);
        $num_rows = $exe->num_rows;

        if($num_rows > 0){
            header ("location: /admin/index.php");
        } else {
            $sql = "INSERT INTO approved (location, registered) VALUES ('$location', (SELECT COUNT(*) FROM afterapproval WHERE location = '$location'))";
            $conn->query($sql);
            header ("location: /admin/index.php");
        }
        $sql = "DELETE FROM afterapproval WHERE location='$location'";
        $conn ->query($sql);


    } else {
        echo "No results found.";
        header ("location: /admin/index.php");
    }
}

$conn->close();
header ("location: /admin/index.php");
?>
