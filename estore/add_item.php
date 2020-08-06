<?php
    include('config/db_connect.php');
    $user_id = mysqli_real_escape_string($conn, $_GET['id']);
    $first_name = $last_name = $address = $age = $worker_id = $device_id = $quantity = $date_purchase = $order_id = ""; 

    

    if(isset($_POST['submit'])) {

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
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <style>
        footer {
            position: fixed;
            left: 0;
            bottom: 0;
            width: 100%;
            text-align: center;
        }
    </style>
</head>
    <?php include('templates/header.php'); ?>

    <section class="container">
        <h4 class="center">Add Item</h4>
        <form action="add_customer.php" method="POST" class="white">
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
                    <a href="add_item.php" class="waves-effect waves-light btn" style="#">Add Item</a>
                    <input type="submit" name="submit" value="confirm" class="btn brand z-depth-0">
                </div>
            </div>
        </form>
        <br><br><br><br><br><br><br><br><br><br><br><br>
    </section>

    <?php include('templates/footer.php'); ?>
</html>