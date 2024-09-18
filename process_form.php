<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $subject = $_POST["subject"];
    $message = $_POST["message"];

    // Database connection parameters
    $host = "localhost"; // Remove the port number if you are using the default port (usually 3306)
    $dbUsername = "root"; // Replace with your MySQL username
    $dbPassword = "";     // Replace with your MySQL password
    $dbName = "portfolio"; // Replace with your database name

    // Create a database connection
    $conn = new mysqli($host, $dbUsername, $dbPassword, $dbName);

    // Check if the connection was successful
    if ($conn->connect_error) {
        die('Could not connect to the database: ' . $conn->connect_error);
    } else {
        // SQL query to insert data into the existing table
        $sql = "INSERT INTO `contact_messages` (`name`, `email`, `subject`, `message`) VALUES ('$name','$email', '$subject','$message')";

        // Prepare the SQL statement
        $stmt = $conn->prepare($sql);

        // Bind the parameters to the prepared statement
        $stmt->bind_param('ssss', $name, $email, $subject, $message);

        // Execute the prepared statement
        if ($stmt->execute()) {
            echo "Data saved successfully!";
        } else {
            echo "Error: " . $stmt->error;
        }

        // Close the prepared statement and the database connection
        $stmt->close();
        $conn->close();
    }
}
?>
