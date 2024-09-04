<?php
include "conn.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $pass = $_POST['pass'];

    // Validate input data
    if (empty($name) || empty($email) || empty($pass)) {
        echo "All fields are required.";
        exit();
    }

    // Sanitize inputs to prevent SQL injection
    $name = mysqli_real_escape_string($conn, $name);
    $email = mysqli_real_escape_string($conn, $email);
    $pass = mysqli_real_escape_string($conn, $pass);

    // Create SQL query
    $sql = "INSERT INTO `clients` (`name`, `email`, `pass`) VALUES ('$name', '$email', '$pass')";

    // Execute SQL query
    if (mysqli_query($conn, $sql))
     {
        echo "Inserted successfully.";

        //displaying id
        $client_id = mysqli_insert_id($conn);
        echo"<br>";
        echo(" This is your ID,you can login using this unique ID: " . $client_id);
    } 
    else
     {
        echo "Error: " . mysqli_error($conn);
    }


    // Close the connection
    mysqli_close($conn);
}
?>