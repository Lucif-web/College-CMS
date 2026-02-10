<?php
session_start();
@include('../../../server/Connection.php');
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require __DIR__ . '/../../../vendor/autoload.php';

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
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['ProblemID'])) {
    $problemID = intval($_POST['ProblemID']); // Ensure you are fetching the ProblemID correctly

    // Fetch the record based on ProblemID to get the assets and receiver email
    $stmt = $conn->prepare("SELECT Assets, Sender_email FROM operational_table WHERE ProblemID = ?");
    $stmt->bind_param("i", $problemID);
    $stmt->execute();
    $stmt->bind_result($assets, $receiverEmail);
    $stmt->fetch();
    $stmt->close();

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
        $mail->Subject = $assets . ' request solved';
        $mail->Body    = 'Thanks for contacting us. The issue which you requested has been solved.';

        $mail->send();

        // Update the status in the database
        $sql = "UPDATE operational_table SET Status='Completed' WHERE ProblemID=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $problemID);
        $stmt->execute();
        $stmt->close();

        $_SESSION['message'] = "Email sent and status updated successfully.";

    } catch (Exception $e) {
        $_SESSION['message'] = "Failed to send email. Error: {$mail->ErrorInfo}";
    }

    $conn->close();

    // Redirect to the main page or any other page
    header("Location: ../operational_table.php");
    exit();
}
?>
