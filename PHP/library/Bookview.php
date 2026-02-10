<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="login icon" href="../Image/ismt logo.jpg" type="logo">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Description Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body>
    <div style="background: linear-gradient(to right,#3962AE, #413692 );">
        <div class="container">
            <div class="row">
                <div class="col-lg-1">
                    <a href="../dashboard.php"><img src="../../Image/ismt-sunderland-whitea.png" alt="..." class="img-fluid"></a>
                </div>
                <div class="col-lg-11">
                    <div class="heading p-3">
                        <h1 class="text-uppercase text-center text-white mb-0" style="letter-spacing: 5px;">Book Details
                        </h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row mt-5">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">Book_ID</th>
                        <th scope="col">Book Name</th>
                        <th scope="col">Availability</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Database connection
                    @include('../../server/Connection.php');

                    // Check connection
                    if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                    }

                    // SQL query to fetch data
                    $sql = "SELECT Book_ID, Book_Name, Availability FROM library_table";
                    $result = $conn->query($sql);

                    // Check if there are results
                    if ($result->num_rows > 0) {
                        // Output data of each row
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $row["Book_ID"] . "</td>";
                            echo "<td>" . $row["Book_Name"] . "</td>";
                            echo "<td>" . $row["Availability"] . "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='3'>No data found</td></tr>";
                    }

                    // Close connection
                    $conn->close();
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>