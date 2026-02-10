<?php
session_start();
include('../server/Connection.php');
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require __DIR__ . '/../vendor/autoload.php';

$block = $_GET['block'] ?? '';
$room = $_GET['room'] ?? '';
$assets = $_GET['assets'] ?? '';
$sender_email = $_SESSION['email'] ?? '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $block = $_POST['block'];
    $room = $_POST['room'];
    $assets = $_POST['assets'];
    $issue = $_POST['issue'];
    $status = 'pending';

    $sql = "INSERT INTO operational_table (Block, Room, Assets, Issue, Sender_email, Status) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    if ($stmt) {
        $stmt->bind_param("ssssss", $block, $room, $assets, $issue, $sender_email, $status);
        if ($stmt->execute()) {
            $mail = new PHPMailer(true);
            try {
                $mail->SMTPDebug = 0;
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';
                $mail->SMTPAuth = true;
                $mail->Username = 'prasutamu94@gmail.com';
                $mail->Password = 'wrcdyfflilllghnw';
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                $mail->Port = 587;

                //Recipients
                $mail->setFrom($sender_email, 'Student');
                $mail->addAddress('gtopg05@gmail.com');
                $mail->addAddress('kit23i.scn@ismt.edu.np');

                //Content
                $mail->isHTML(true);
                $mail->Subject = $assets;
                $mail->Body    = "Issue reported in Block: $block, Room: $room.<br>Issue Details:<br>$issue";

                $mail->send();
                header("Location: dashboard.php");
                exit;
                echo "<script>alert('Form submitted successfully and email sent!');</script>";
            } catch (Exception $e) {
                echo "<script>alert('Form submitted but email could not be sent. Error: {$mail->ErrorInfo}');</script>";
            }
        } else {
            echo "<script>alert('Error: " . $stmt->error . "');</script>";
        }
        $stmt->close();
    } else {
        echo "<script>alert('Error: " . $conn->error . "');</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Description</title>
    <link rel="login icon" href="../Image/ismt logo.jpg" type="logo">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <div style="background: linear-gradient(to right,#3962AE, #413692 );">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="text-uppercase text-center p-4 text-white" style="letter-spacing: 5px;">Issue Reporting</h1>
                </div>
            </div>
        </div>
    </div>
    <div class="container mt-5">
        <form method="post" action="">
            <div class="mb-3">
                <label for="block" class="form-label">Block</label>
                <input type="text" class="form-control" id="block" name="block" value="<?php echo htmlspecialchars($block); ?>" readonly>
            </div>
            <div class="mb-3">
                <label for="room" class="form-label">Room</label>
                <input type="text" class="form-control" id="room" name="room" value="<?php echo htmlspecialchars($room); ?>" readonly>
            </div>
            <div class="mb-3">
                <label for="assets" class="form-label">Assets</label>
                <input type="text" class="form-control" id="assets" name="assets" value="<?php echo htmlspecialchars($assets); ?>" readonly>
            </div>
            <div class="mb-3">
                <label for="issue" class="form-label">Issue</label>
                <textarea class="form-control" id="issue" name="issue" rows="3" required></textarea>
            </div>
            <input type="hidden" name="sender_email" value="<?php echo htmlspecialchars($sender_email); ?>">
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</body>
</html>
