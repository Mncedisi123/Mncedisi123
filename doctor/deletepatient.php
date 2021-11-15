<?php
include_once '../assets/conn/dbconnect.php';
// Get the variables.
$patientId = $_POST['ic'];
// echo $appid;

$delete = mysqli_query($con,"DELETE FROM patient WHERE patientId=$patientId");
// if(isset($delete)) {
//    echo "YES";
// } else {
//    echo "NO";
// }



?>

