<?php
include "conn.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $cname = $_POST['cname'];
    $cemail = $_POST['cemail'];
    $cont = $_POST['ccont'];
    $cedu = $_POST['cedu'];
    $certificate=$_POST['certificate'];

    // Validate input data
    if (empty($cname) || empty($cemail) || empty($ccont) || empty($cedu) || empty($certificate))
     {
        echo "All fields are required.";
        exit();
    }

    // Sanitize inputs to prevent SQL injection
    $cname = mysqli_real_escape_string($conn, $cname);
    $cemail = mysqli_real_escape_string($conn, $cemail);
    $ccont = mysqli_real_escape_string($conn, $ccont);
    $cedu = mysqli_real_escape_string($conn, $cedu);
    $certificate = mysqli_real_escape_string($conn, $certificate);
    
    // File upload handling
    if (isset($_FILES['file']) && $_FILES['file']['error'] == 0) {
        $upload_dir = 'uploads/';
        $file_name = basename($_FILES['certificate']['name']);
        $target_file = $upload_dir . $file_name;
        $file_type = pathinfo($target_file, PATHINFO_EXTENSION);

        // Upload the file
        if (move_uploaded_file($_FILES['file']['tmp_name'], $target_file)) 
        {
            // Prepare SQL query with file path
            $sql = "INSERT INTO `coach` (`cname`, `cemail`, `ccont`, `cedu`, `certificate`) 
                    VALUES ('$cname', '$cemail', '$ccont', '$cedu', '$certificate')";
        } else 
        {
            echo "Sorry, there was an error uploading your file.";
            exit();
        }
    } else
     {
        echo "No file was uploaded or there was an error.";
        exit();
    }

    // Create SQL query
    $sql="INSERT INTO `coach`(`cname`, `cemail`, `ccont`, `cedu`,'certificate') 
    VALUES ('$cname','$cemail','$ccont','$cedu','$certificate')";

    // Execute SQL query
    if (mysqli_query($conn, $sql)) {
        echo "Inserted successfully.";
    } else {
        echo "Error: " . mysqli_error($conn);
    }

    // Close the connection
    mysqli_close($conn);
}
?>