<?php
    include('config/db_connect.php');

    $user_id = $first_name = $last_name = $address = $age = $worker_id = $device_id = $quantity = $date_purchase = $order_id = ""; 

    if(isset($_POST['submit'])) {

        $user_id = mysqli_real_escape_string($conn, $_POST['user_id']);
        $first_name = mysqli_real_escape_string($conn, $_POST['first_name']);
        $last_name = mysqli_real_escape_string($conn, $_POST['last_name']);
        $address = mysqli_real_escape_string($conn, $_POST['address']);
        $age = mysqli_real_escape_string($conn, $_POST['age']);
        $worker_id = mysqli_real_escape_string($conn, $_POST['worker_id']);
        $device_id = mysqli_real_escape_string($conn, $_POST['device_id']);
        $quantity = mysqli_real_escape_string($conn, $_POST['quantity']);
        $date_purchase = mysqli_real_escape_string($conn, $_POST['date_purchase']);
        $order_id = mysqli_real_escape_string($conn, $_POST['order_id']);

        //create sql
        $sql = "INSERT INTO user2(user_id, first_name, last_name, address, age)
                VALUES('$user_id', '$first_name', '$last_name', '$address', '$age')";
        
        if(mysqli_query($conn, $sql)) {
            //success
            $sql = "INSERT INTO order2(order_id, user_id, device_id, worker_id, quantity, date_purchase)
            VALUES('$order_id', '$user_id', '$device_id', '$worker_id', '$quantity', '$date_purchase')";
            //save to db and check
            if(mysqli_query($conn, $sql)) {
                //success
                header('Location: index.php');
            }

            else {
                echo 'query error: '.mysqli_error($conn);
            } 
        }

        else {
            echo 'query error: '.mysqli_error($conn);
        } 
    }

    // if(isset($_POST['additem'])) {
    //     session_start();
    //     $_SESSION['id'] = mysqli_real_escape_string($conn, $_POST['user_id']);
    //     $id = $_SESSION['id'];
    //     echo $_SESSION['id'];
    //     $user_id = mysqli_real_escape_string($conn, $_POST['user_id']);
    //     $first_name = mysqli_real_escape_string($conn, $_POST['first_name']);
    //     $last_name = mysqli_real_escape_string($conn, $_POST['last_name']);
    //     $address = mysqli_real_escape_string($conn, $_POST['address']);
    //     $age = mysqli_real_escape_string($conn, $_POST['age']);
    //     $worker_id = mysqli_real_escape_string($conn, $_POST['worker_id']);
    //     $device_id = mysqli_real_escape_string($conn, $_POST['device_id']);
    //     $quantity = mysqli_real_escape_string($conn, $_POST['quantity']);
    //     $date_purchase = mysqli_real_escape_string($conn, $_POST['date_purchase']);
    //     $order_id = mysqli_real_escape_string($conn, $_POST['order_id']);

    //     //create sql
    //     $sql = "INSERT INTO user2(user_id, first_name, last_name, address, age)
    //             VALUES('$user_id', '$first_name', '$last_name', '$address', '$age')";
        
    //     if(mysqli_query($conn, $sql)) {
    //         //success
    //         $sql = "INSERT INTO order2(order_id, user_id, device_id, worker_id, quantity, date_purchase)
    //                 VALUES('$order_id', '$user_id', '$device_id', '$worker_id', '$quantity', '$date_purchase')";
    //         //save to db and check
    //         if(mysqli_query($conn, $sql)) {
    //             //success

    //             header('Location: add_item.php?id=$id');
    //         }

    //         else {
    //             echo 'query error: '.mysqli_error($conn);
    //         } 
    //     }

    //     else {
    //         echo 'query error: '.mysqli_error($conn);
    //     } 
    // }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <style>
        
    </style>
</head>
    <?php include('templates/header.php'); ?>

    <section class="container">
        <h4 class="center">Add Customer</h4>
        <form action="add_customer.php" method="POST" class="white">
            <label for="">User ID:</label>
            <input type="text" name="user_id" value="<?php echo htmlspecialchars($user_id)?>">
            <label for="">First Name:</label>
            <input type="text" name="first_name" value="<?php echo htmlspecialchars($first_name)?>">
            <label for="">Last Name:</label>
            <input type="text" name="last_name" value="<?php echo htmlspecialchars($last_name)?>">
            <label for="">Address:</label>
            <input type="text" name="address" value="<?php echo htmlspecialchars($address)?>">
            <label for="">Age:</label>
            <input type="number" step="any" name="age" value="<?php echo htmlspecialchars($age)?>">
            <label for="">Order ID:</label>
            <input type="text" name="order_id" value="<?php echo htmlspecialchars($order_id)?>">
            <label for="">Device ID:</label>
            <input type="text" name="device_id" value="<?php echo htmlspecialchars($device_id)?>">
            <label for="">Worker ID:</label>
            <input type="text" name="worker_id" value="<?php echo htmlspecialchars($worker_id)?>">
            <label for="">Quantity:</label>
            <input type="number" step="any" name="quantity" value="<?php echo htmlspecialchars($quantity)?>">
            <label for="">Date Purchase:</label>
            <input type="text" step="any" name="date_purchase" value="<?php echo htmlspecialchars($date_purchase)?>">
            <div class="#">
                        <a href="index.php" class="waves-effect waves-light btn left" style="#">Back</a>
                        <div class="right">
                            <!-- <input type="submit" name="additem" value="add item" class="btn brand z-depth-0"> -->
                            
                            <input type="submit" name="submit" value="submit" class="btn brand z-depth-0">
                        </div>
            </div>
        </form>
        <br><br><br><br><br><br><br><br><br><br><br><br>
    </section>

    <?php include('templates/footer.php'); ?>
</html>