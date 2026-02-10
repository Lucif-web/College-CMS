<?php
session_start();
@include('../../server/Connection.php');
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require __DIR__ . '/../../vendor/autoload.php';

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Ensure user is logged in and email session variable is set
if (!isset($_SESSION['user_email'])) {
    die("User not logged in.");
}

$senderEmail = $_SESSION['user_email']; // The sender's email from the session

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['action']) && $_POST['action'] === 'on_process') {
    $problemID = intval($_GET['ProblemID']); // Ensure you are fetching the ProblemID correctly
    $receiverEmail = $_POST['sender_email'];
    $issue = $_POST['issue'];

    // Create PHPMailer instance
    $mail = new PHPMailer(true);

    try {
        //Server settings
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'gtopg05@gmail.com'; // Replace with your email
        $mail->Password = 'wglhzmuatjsljywd'; // Replace with your email password or application-specific password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        //Recipients
        $mail->setFrom($senderEmail, 'Operational Department'); // Sender's email and name
        $mail->addAddress($receiverEmail); // Recipient's email

        // Content
        $mail->isHTML(true);
        $mail->Subject = 'On Process';
        $mail->Body    = $issue;

        $mail->send();

        // Update the status in the database
        $sql = "UPDATE operational_table SET Status='On Process' WHERE ProblemID=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $problemID);
        $stmt->execute();
        $stmt->close();

        $_SESSION['message'] = "Email sent successfully.";

    } catch (Exception $e) {
        $_SESSION['message'] = "Failed to send email. Error: {$mail->ErrorInfo}";
    }

    $conn->close();

    // Redirect to the main page or any other page
    header("Location: ./operational_table.php");
    exit();
}

// Fetch the record based on ProblemID
$problemID = isset($_GET['ProblemID']) ? intval($_GET['ProblemID']) : 0;
if ($problemID > 0) {
    $stmt = $conn->prepare("SELECT Sender_email FROM operational_table WHERE ProblemID = ?");
    if ($stmt === false) {
        die("Error preparing statement: " . $conn->error);
    }
    $stmt->bind_param("i", $problemID);
    $stmt->execute();
    $stmt->bind_result($senderEmail);
    $stmt->fetch();
    $stmt->close();
} else {
    echo "Invalid ProblemID.";
    exit();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="login icon" href="../Image/ismt logo.jpg" type="logo">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Description Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    <style>
        body {
            font-family: "Poppins", sans-serif;
        }
        form {
            box-shadow: 2px 2px 15px rgb(167, 167, 167);
        }
    </style>
</head>

<body>
    <div style="background: linear-gradient(to right,#3962AE, #413692 );">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="heading p-3">
                        <h1 class="text-uppercase text-center text-white mb-0" style="letter-spacing: 5px;">Admin Description</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="description">
        <div class="container">
            <div class="row justify-content-center mt-5">
                <div class="col-lg-6 py-3">
                    <form action="" method="POST" class="p-5 rounded-2">
                        <div class="row">
                            <div class="col-lg-12 d-flex justify-content-center gap-2 mb-3">
                                <input readonly type="text" name="sender_email" class="w-75 form-control border-1 bg-light py-3 opacity-75 text-dark" value="<?php echo htmlspecialchars($senderEmail); ?>">
                            </div>
                        </div>
                        <textarea name="issue" id="issue" placeholder="Message wordlimit (500)"
                            class="w-100 form-control shadow-none border-1 bg-light py-3 text-dark" style="height: 300px; resize: none;" maxlength="500"></textarea>
                        <div class="submission d-flex justify-content-between pt-5 px-5 ">
                            <button type="submit" name="action" value="on_process" class="btn btn-warning px-5 rounded-1">On Process</button>
                            <a href="delete.php?ProblemID=<?php echo $problemID; ?>"><button type="button" class="btn btn-success px-5 rounded-1 text-white">Done</button></a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
