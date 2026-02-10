<?php
session_start();
@include('../../server/Connection.php');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    // Prepare the SQL statement
    $stmt = $conn->prepare("SELECT password FROM operational_admin WHERE email = ?");
    if ($stmt === false) {
        die("Error preparing statement: " . $conn->error);
    }
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->bind_result($db_password);
    $stmt->fetch();
    $stmt->close();

    // Verify password (plain text comparison)
    if ($db_password && $password === $db_password) {
        $_SESSION['user_email'] = $email;
        header("Location: operational_table.php");
        exit;
    } else {
        $_SESSION['message'] = "Incorrect username or password. Please try again.";
    }

    $conn->close();
    header("Location: " . $_SERVER['PHP_SELF']);
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="login icon" href="../Image/ismt logo.jpg" type="logo">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LOGIN PAGE</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: "Poppins", sans-serif;
        }

        @media(max-width:540px) {
            .ismt {
                width: 100% !important;
            }
        }

        @media (min-width: 541px) and (max-width: 821px) {
            .ismt {
                width: 80% !important;
            }
        }
    </style>
</head>

<body style="overflow: hidden;">
    <div style="background: linear-gradient(to bottom,#3962AE, #413692 );">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-12 col-md-12 d-flex align-items-center justify-content-center w-100" style="height: 100vh; width: 100vh;">
                    <div class="ismt rounded-5 top-0" style="width: 50%;box-shadow: 5px 1px 20px #0e0079;">
                        <div class="logo rounded-top-5 d-flex justify-content-center p-5" style="background-color: #413692b2;">
                            <div style="width: 12rem;height: 12rem;" class="overflow-hidden rounded-circle">
                                <img src="../../Image/ismt logo.jpg" alt="" class="p-4 bg-white shadow" style="width: 12rem;height: 12rem;">
                            </div>
                        </div>
                        <div class="form bg-white px-5 py-5 rounded-bottom-5">
                            <h2 class="text-center text-uppercase mb-0">Operational Admin Login</h2>
                            <?php
                            if (isset($_SESSION['message'])) {
                                echo '<div class="alert alert-info text-center">' . $_SESSION['message'] . '</div>';
                                unset($_SESSION['message']);
                            }
                            ?>
                            <form method="POST" action="">
                                <div class="py-5 d-flex flex-column gap-4">
                                    <div class="user d-flex gap-2 align-items-center border-1 border-black border px-3 rounded-1">
                                        <i class="bi bi-person icon-color fs-3"></i>
                                        <input type="text" name="email" class="form-control border-0 input-bg shadow-none rounded-0 py-3" placeholder="Enter email" required>
                                    </div>
                                    <div class="user d-flex gap-2 align-items-center border-1 border-black border px-3 rounded-1">
                                        <i class="bi bi-lock fs-3"></i>
                                        <input type="password" name="password" id="password" class="form-control border-0 input-bg shadow-none rounded-0 py-3" placeholder="Password" required>
                                        <i class="bi bi-eye-slash fs-2" id="eyeicon"></i>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-center">
                                    <button type="submit" class="btn bg-danger rounded-0 text-white px-5 py-2 text-uppercase fs-4 shadow-sm rounded-2">Login</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
        <script>
            let eyeicon = document.getElementById("eyeicon");
            let password = document.getElementById("password");

            eyeicon.onclick = function() {
                if (password.type == "password") {
                    password.type = "text";
                    eyeicon.className = "bi bi-eye fs-2";
                } else {
                    password.type = "password";
                    eyeicon.className = "bi bi-eye-slash fs-2";
                }
            }
        </script>
</body>

</html>
