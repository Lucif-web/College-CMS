<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="icon" href="../Image/ismt logo.jpg" type="logo">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Description Page</title>
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
                <div class="col-lg-12">
                    <div class="heading p-3">
                        <h1 class="text-uppercase text-center text-white mb-0" style="letter-spacing: 5px;">Operational Admin panel</h1>
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
                        <th scope="col">Problem ID</th>
                        <th scope="col">Block</th>
                        <th scope="col">Room</th>
                        <th scope="col">Assets</th>
                        <th scope="col">Issue</th>
                        <th scope="col">Sender_email</th>
                        <th scope="col">Status</th>
                        <th scope="col">Register date</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    @include('../../server/Connection.php');

                    // Check connection
                    if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                    }

                    // Fetch data from database
                    $sql = "SELECT ProblemID, Block, Room, Assets, Issue, Sender_email, Status, Date FROM operational_table";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        // Output data of each row
                        while($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<th scope='row'>" . $row["ProblemID"] . "</th>";
                            echo "<td>" . $row["Block"] . "</td>";
                            echo "<td>" . $row["Room"] . "</td>";
                            echo "<td>" . $row["Assets"] . "</td>";
                            echo "<td>" . $row["Issue"] . "</td>";
                            echo "<td>" . $row["Sender_email"] . "</td>";
                            echo "<td>" . $row["Status"] . "</td>";
                            echo "<td>" . $row["Date"] . "</td>";
                            echo "<td>
                                    <div class='d-flex gap-4'>
                                        <a href='operational_detailinfo.php?ProblemID=" . $row["ProblemID"] . "' class='border-0 bg-transparent px-0'><i class='fa-solid fa-eye text-info'></i></a>
<form method='POST' action='./controller/update_status.php' style='display:inline-block;'>
    <input type='hidden' name='ProblemID' value='" . $row["ProblemID"] . "'>
    <button type='submit' class='border-0 bg-transparent px-0'><i class='fa-solid fa-thumbs-up text-success'></i></button>
</form>

                                        <form method='POST' action='./controller/delete.php' style='display:inline-block;'>
                                            <input type='hidden' name='ProblemID' value='" . $row["ProblemID"] . "'>
                                            <button type='submit' class='border-0 bg-transparent px-0'><i class='fa-solid fa-trash text-danger'></i></button>
                                        </form>
                                    </div>
                                  </td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='9'>No data found</td></tr>";
                    }

                    $conn->close();
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>
