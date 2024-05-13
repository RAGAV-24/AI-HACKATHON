<?php
// Database configuration
$servername = "localhost"; // Change this to your database server
$username = "root"; // Change this to your database username
$password = ""; // Change this to your database password
$database = "ai hack"; // Change this to your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Insert user information into the database
    $sql = "INSERT INTO users (name, email, password) VALUES ('$name', '$email', '$password')";
    
    if ($conn->query($sql) === TRUE) {
        // Send email to the user
        $to = $email;
        $subject = 'Registration Successful';
        $message = 'Dear ' . $name . ',<br><br>Your registration was successful. Thank you for signing up!<br><br>Best regards,<br>Your Website Team';
        $headers = "From: your@example.com\r\n";
        $headers .= "Reply-To: your@example.com\r\n";
        $headers .= "Content-type: text/html\r\n";

        // Send the email
        mail($to, $subject, $message, $headers);

        // Redirect the user to a thank you page
        header('Location: thank_you_page.html');
        exit;
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Close connection
$conn->close();
?>
