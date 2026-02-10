<?php
@include('../server/Connection.php');

function getAssetStatus($conn, $block, $room, $assets) {
    $sql = "SELECT Status FROM operational_table WHERE Block=? AND Room=? AND Assets=?";
    $stmt = $conn->prepare($sql);
    if ($stmt === false) {
        die("Error preparing statement: " . $conn->error);
    }
    $stmt->bind_param("sss", $block, $room, $assets);
    $stmt->execute();
    $stmt->bind_result($db_status);
    $stmt->fetch();
    $stmt->close();
    return $db_status;
}

$block = 'London-Block';
$room = '101';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blocks and Room Number</title>
    <link rel="login icon" href="../Image/ismt logo.jpg" type="logo">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <div style="background: linear-gradient(to right,#3962AE, #413692 );">
        <div class="container">
            <div class="row">
                <div class="col-lg-1">
                    <a href="./dashboard.php"><img src="../Image/ismt-sunderland-whitea.png" alt="..." class="img-fluid"></a>
                </div>
                <div class="col-lg-11">
                    <h1 class="text-uppercase text-center p-4 text-white" style="letter-spacing: 5px;">London Block /<span>101</span></h1>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row mt-5">
            <?php
            $assets = [
                "Chair-assets" => "fa-solid fa-chair",
                "Projector-assets" => "bi bi-projector",
                "White-board-assets" => "bi bi-fullscreen",
                "Internet" => "fa-solid fa-wifi",
                "Projector-screen" => "bi bi-border-all",
                "Lights" => "fa-regular fa-lightbulb",
                "Connection-points" => "fa-solid fa-plug",
                "Carpet" => "fa-solid fa-rug",
                "Air-conditioner" => "fa-solid fa-temperature-low",
                "Fans" => "fa-solid fa-fan",
                "Miscellaneous" => "fa-solid fa-circle-info"
            ];

            foreach ($assets as $asset => $iconClass) {
                $status = getAssetStatus($conn, $block, $room, $asset);
                // Debugging line to output asset and status
                echo "<!-- Asset: {$asset}, Status: {$status} -->"; 
                
                // Change the status class based on the status value
                $statusClass = ($status == 'pending' || $status == 'On Process') ? 'text-bg-danger' : 'text-bg-success';
                
                ?>
                <div class="col-lg-3">
                    <a href="description.php?block=<?php echo $block; ?>&room=<?php echo $room; ?>&assets=<?php echo urlencode($asset); ?>" class="text-decoration-none">
                        <div class="card <?php echo $statusClass; ?> mb-3">
                            <div class="card-header">
                                <h5><?php echo htmlspecialchars($asset); ?></h5>
                            </div>
                            <div class="card-body" style="height: 100px;">
                                <p class="card-text"><i class="<?php echo $iconClass; ?> fs-1"></i></p>
                            </div>
                        </div>
                    </a>
                </div>
                <?php
            }
            ?>
        </div>
    </div>
</body>
</html>
