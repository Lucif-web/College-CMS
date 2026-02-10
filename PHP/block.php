<?php
@include('../server/Connection.php');

// Initialize block statuses
$blockStatuses = [
    'A' => 'green',
    'B' => 'green',
    'C' => 'green',
    'London-Block' => 'green',
    'Stamford-Block' => 'green'
];

$blockIcons = [
    'A' => ['success' => 'opacity-0', 'danger' => 'opacity-0'],
    'B' => ['success' => 'opacity-0', 'danger' => 'opacity-0'],
    'C' => ['success' => 'opacity-0', 'danger' => 'opacity-0'],
    'London-Block' => ['success' => 'opacity-0', 'danger' => 'opacity-0'],
    'Stamford-Block' => ['success' => 'opacity-0', 'danger' => 'opacity-0']
];

// Query to get the status of issues for each block
$sql = "SELECT Block, Status FROM operational_table WHERE Status IN ('pending', 'doing') GROUP BY Block";
$result = $conn->query($sql);

if ($result) {
    while ($row = $result->fetch_assoc()) {
        $block = $row['Block'];
        $status = $row['Status'];

        // Update block status and icons based on the issue status
        if ($status === 'pending' || $status === 'doing') {
            $blockStatuses[$block] = 'red';
            $blockIcons[$block]['success'] = 'opacity-0';
            $blockIcons[$block]['danger'] = 'opacity-1';
        } else {
            $blockIcons[$block]['success'] = 'opacity-1';
            $blockIcons[$block]['danger'] = 'opacity-0';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="icon" href="../Image/ismt logo.jpg" type="image/x-icon">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Block</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        .bg-header {
            background: linear-gradient(#413692, #3962AE);
        }

        .bg-header img {
            width: 100px;
        }

        .blocks-section .block-wrapper {
            width: 300px;
            height: 250px;
            border-radius: 30px;
        }

        .color-changing-green-div {
            background-color: green !important;
            border-radius: 30px 30px 0 0 !important;
        }

        .color-changing-red-div {
            background-color: red !important;
            border-radius: 30px 30px 0 0 !important;
        }

        .white-div {
            border-radius: 0 0 30px 30px !important;
        }

        .bottom-end-20 {
            bottom: 20px;
            right: 20px;
        }

        .block-wrapper .alignment-code {
            width: 130px;
            height: 130px;
        }

        @media only screen and (max-width: 600px) {
            .blocks-section .block-wrapper {
                width: 225px;
                height: 175px;
            }

            .text-wrapper strong {
                font-size: 1.45rem !important;
            }

            .block-wrapper .alignment-code {
                width: 90px;
                height: 90px;
            }
        }

        @media only screen and (max-width: 500px) {
            .blocks-section .block-wrapper {
                width: 200px;
                height: 175px;
            }

            .text-wrapper strong {
                font-size: 1.45rem !important;
            }

            .block-wrapper .alignment-code {
                width: 90px;
                height: 90px;
            }
        }

        .opacity-0 {
            opacity: 0;
        }

        .opacity-1 {
            opacity: 1;
        }
    </style>
</head>
<body>
    <div class="whole-bg-container">
        <section class="header">
            <div class="bg-header py-3 d-flex justify-content-center">
                <img src="../Image/ismt-sunderland-white.png" alt="">
            </div>
        </section>
        <section class="blocks-section my-4">
            <div class="container">
                <div class="row g-4 justify-content-center">
                    <?php
                    // Array of blocks with their display names
                    $blocks = [
                        'A' => 'A block',
                        'B' => 'B block',
                        'C' => 'C block',
                        'London-Block' => 'London block',
                        'Stamford-Block' => 'Stamford block'
                    ];

                    // Generate block cards dynamically
                    foreach ($blocks as $blockKey => $blockName) {
                        // Initialize variables for initial and remaining text
                        $initial = '';
                        $remaining = '';

                        if ($blockKey === 'London-Block') {
                            $initial = 'London';
                            $remaining = 'block';
                            $url = "table-" . strtolower(str_replace(' ', '-', $blockName)) . ".php?block=" . urlencode($blockKey);
                        } elseif ($blockKey === 'Stamford-Block') {
                            $initial = 'Stamford';
                            $remaining = 'block';
                            $url = "table-" . strtolower(str_replace(' ', '-', $blockName)) . ".php?block=" . urlencode($blockKey);
                        } else {
                            // Split the block name into initial letter and the rest
                            $blockParts = explode(' ', $blockName, 2);
                            $initial = strtoupper(substr($blockParts[0], 0, 1));
                            $remaining = isset($blockParts[1]) ? $blockParts[1] : '';
                            $url = "table-block-" . strtolower($blockKey) . ".php?block=" . urlencode($blockKey);
                        }

                        $colorClass = $blockStatuses[$blockKey] === 'red' ? 'color-changing-red-div' : 'color-changing-green-div';
                        $successIconClass = $blockIcons[$blockKey]['success'];
                        $dangerIconClass = $blockIcons[$blockKey]['danger'];
                    ?>
                        <div class="col-lg-4 col-md-6 col-sm-6 col-6 d-flex justify-content-center">
                            <a href="<?php echo $url; ?>">
                                <div class="block-wrapper shadow position-relative">
                                    <div class="position-absolute d-flex align-items-center justify-content-center w-100" style="height: 100%;">
                                        <div class="alignment-code rounded-circle z-2 bg-white shadow d-flex align-items-center justify-content-center">
                                            <div class="text-wrapper text-center">
                                                <strong class="text-uppercase fs-4 text-black"><?php echo $initial; ?></strong>
                                                <div class="text-uppercase text-black"><?php echo $remaining; ?></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="<?php echo $colorClass; ?> h-50"></div>
                                    <div class="white-div h-50 position-relative">
                                        <i class="bi bi-check-lg text-success position-absolute bottom-end-20 fs-3 <?php echo $successIconClass; ?>"></i>
                                        <i class="bi bi-exclamation-circle text-danger position-absolute bottom-end-20 fs-3 <?php echo $dangerIconClass; ?>"></i>
                                    </div>
                                </div>
                            </a>
                        </div>
                    <?php
                    }
                    ?>
                </div>
            </div>
        </section>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
