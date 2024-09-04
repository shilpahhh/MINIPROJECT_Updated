<?php
include "conn.php";
// Assuming you have a connection to the database
if ($_SERVER['REQUEST_METHOD'] == 'POST')
 {
    $name = $_POST['name'];
    $client_id = $_POST['client_id'];

    if ($client_id == 'clients') 
    {
        // Query the clients table
        $query = "SELECT * FROM clients 
        WHERE  client_id = '$client_id'";
    }
     else
     {
        // if no details found
       echo"<br>";
       echo"OOOPS !! No details found.";
    }
}
    $result = mysqli_query($conn, $query);
    

    if (mysqli_num_rows($result) == 1) 
    {
        // Login successful
        // Set session and redirect to the appropriate dashboard
        $_SESSION['name'] = $name;
        $_SESSION['client_id'] = $client_id;
        $_SESSION['email'] = $email;
        $_SESSION['pass'] = $pass;


        if ($client_id == 'clients') 
        {
            header("Location:insert.php");
        } 
        else
         {
            echo"not found";
        }
    }
     else 
     {
        // Login failed
        echo "Check your UNIQUE ID is correct.";
    
}
?>