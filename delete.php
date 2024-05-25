<!-- Github.com/IAmBaghas -->

<?php
$Kd_dokter = $_GET['Kd_dokter'];
$Kd_pasien = $_GET['Kd_pasien'];

$conn = new mysqli('localhost', 'root', '', 'dokter');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "DELETE FROM tb_pasien WHERE Kd_pasien = '$Kd_pasien'";
$sql1 = "DELETE FROM tb_dokter WHERE Kd_dokter = '$Kd_dokter'";

if ($conn->query($sql) === TRUE) {
    header("Location: admin.php"); 
} else {
    echo "Error deleting record: " . $conn->error;
}

if ($conn->query($sql1) === TRUE) {
    header("Location: admin.php"); 
} else {
    echo "Error deleting record: " . $conn->error;
}

$conn->close();
?>
