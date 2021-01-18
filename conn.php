<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "search_pagination";

    $conn = mysqli_connect($servername, $username, $password, $dbname);

    if(!$conn)
    {
        die("Connection failed: " .$conn->connect_error);
    }
?>