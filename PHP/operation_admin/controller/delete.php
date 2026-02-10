<?php
@include('../../../server/Connection.php');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $problemID = $_POST['ProblemID'];

    // Prepare and bind
    $stmt = $conn->prepare("DELETE FROM operational_table WHERE ProblemID = ?");
    $stmt->bind_param("i", $problemID);

    // Execute the statement
    if ($stmt->execute() === TRUE) {
        echo "Record deleted successfully";
    } else {
        echo "Error deleting record: " . $conn->error;
    }

    $stmt->close();
    $conn->close();

    // Redirect back to the main page after deletion
    header("Location: ../operational_table.php");
    exit();
}
?>