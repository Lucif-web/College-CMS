<?php
@include('../server/Connection.php');

// Initialize status variables
$statuses = [
    '101' => 'success', // Default to success
    '201' => 'success',
    '301' => 'success',
    '401' => 'success'
];

// Query to get the status of issues for each room
$sql = "SELECT Room, Status FROM operational_table WHERE Block = 'London-Block' AND Room IN ('101', '201', '301', '401') AND Status IN ('pending', 'doing')";
$result = $conn->query($sql);

if ($result) {
    while ($row = $result->fetch_assoc()) {
        $room = $row['Room'];
        $status = $row['Status'];

        // Change button class based on status
        if ($status === 'pending' || $status === 'doing') {
            $statuses[$room] = 'danger';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>London Block Rooms</title>
    <link rel="login icon" href="../Image/ismt logo.jpg" type="logo">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    <style>
        table, th, td {
            border: 2px solid #413692;
        }
    </style>
</head>

<body>
    <div style="background: linear-gradient(to right,#3962AE, #413692 );">
        <div class="container">
            <div class="row">
            <div class="col-lg-1">
                    <a href="./dashboard.php"><img src="../Image/ismt-sunderland-whitea.png" alt="..." class="img-fluid"></a>
                </div>
                <div class="col-lg-11">
                    <h1 class="text-uppercase text-center p-4 text-white" style="letter-spacing: 5px;">London Block</h1>
                </div>
            </div>
        </div>
    </div>
    <div class="container mt-3">
        <div class="row">
            <div class="col-lg-12 col-12">
                <table class="w-100">
                    <thead>
                        <tr class="text-uppercase text-center">
                            <th class="p-2">First Floor</th>
                            <th class="p-2">Second Floor</th>
                            <th class="p-2">Third Floor</th>
                            <th class="p-2">Fourth Floor</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="p-2"><a href="assets-london-block-101.php?block=London-Block&room=101"><button class="btn btn-<?php echo $statuses['101']; ?> rounded-0 w-100 p-3">101</button></a></td>
                            <td class="p-2"><a href="assets-london-block-201.php?block=London-Block&room=201"><button class="btn btn-<?php echo $statuses['201']; ?> rounded-0 w-100 p-3">201</button></a></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>

</html>
