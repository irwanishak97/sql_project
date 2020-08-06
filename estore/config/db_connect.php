<?php 

    //connect to db
    $conn = mysqli_connect('sql205.epizy.com', 'epiz_26408869', 'izfhHQWv4bWg', 'epiz_26408869_estore');

    //check connection
    if(!$conn) {
        echo 'Connection error: '.mysqli_connect_error();
    }

?>