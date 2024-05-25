<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "dokter";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT tb_dokter.Kd_dokter, Nama_dokter, Kd_spesialis, hari, Jam_mulai, Jam_selesai 
        FROM tb_jaga 
        INNER JOIN tb_dokter ON tb_jaga.Kd_dokter = tb_dokter.Kd_dokter 
        ORDER BY tb_dokter.Kd_dokter, hari";
$result = $conn->query($sql);

$schedule = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $schedule[$row['Kd_dokter']]['Nama_dokter'] = $row['Nama_dokter'];
        $schedule[$row['Kd_dokter']]['Kd_spesialis'] = $row['Kd_spesialis'];
        $schedule[$row['Kd_dokter']]['schedules'][] = [
            'hari' => $row['hari'],
            'Jam_mulai' => $row['Jam_mulai'],
            'Jam_selesai' => $row['Jam_selesai']
        ];
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>RSUD Ciawi - Jadwal Dokter</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 0px;
            margin: 0px;
        }
        table, th, td {
            border: 1px solid black;
            border-collapse: collapse;
        }
        p {
            padding-left: 5px;
            padding-right: 5px;
        }
        .navbar {
            height: 40px;
            padding: 10px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: slategray;
        }
        .navbar div {
            display: flex;
            align-items: center;
        }
        .navbar div form {
            margin-left: 10px;
        }
        a {
            text-decoration: none;
            color: black;
            padding-top: 6px;
        }
        a:hover {
            color: white;
        }
        .drlist {
            padding: 10px;
        }
    </style>
</head>
<body>
    <nav>
        <div class="navbar">
            <div>
                <span style='font-weight: bold; font-size: 24px; padding-right: 10px;'>RSUD Ciawi</span>
                <div class="navlist">
                    <a href="index.php">Menu</a> |
                    <a href="dokter.php">Dokter</a> |
                    <a href="admin.php">Admin</a>
                </div>
            </div>
        </div>
    </nav>

    <div class="drlist">
        <h2>Jadwal Dokter</h2>
        <?php
        if (!empty($schedule)) {
            echo "<table style='width: 100%'>";
            echo "<tr>";
            echo "<th>Kode Dokter</th>";
            echo "<th>Nama Dokter</th>";
            echo "<th>Spesialisasi</th>";
            echo "<th>Hari</th>";
            echo "<th>Jam Masuk</th>";
            echo "<th>Jam Selesai</th>";
            echo "</tr>";

            foreach ($schedule as $kd_dokter => $data) {
                $rowCount = count($data['schedules']);
                echo "<tr>";
                echo "<td rowspan='$rowCount' style='text-align: center;'>{$kd_dokter}</td>";
                echo "<td rowspan='$rowCount'>{$data['Nama_dokter']}</td>";
                echo "<td rowspan='$rowCount' style='text-align: center;'>{$data['Kd_spesialis']}</td>";

                $first = true;
                foreach ($data['schedules'] as $sched) {
                    if (!$first) echo "<tr>";
                    echo "<td style='text-align: center;'>{$sched['hari']}</td>";
                    echo "<td style='text-align: center;'>{$sched['Jam_mulai']}</td>";
                    echo "<td style='text-align: center;'>{$sched['Jam_selesai']}</td>";
                    echo "</tr>";
                    $first = false;
                }
            }

            echo "</table>";
        } else {
            echo "No doctors found.";
        }
        $conn->close();
        ?>
    </div>
</body>
</html>
