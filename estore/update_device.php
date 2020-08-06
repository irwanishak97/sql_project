<?php
    include('config/db_connect.php');
    $id = isset($_GET['id']) ? $_GET['id'] : '';

    $sql = "SELECT *
            FROM device
            WHERE device_id = '$id'";

    //result
    $result = mysqli_query($conn, $sql);

    //fetch
    $device = mysqli_fetch_assoc($result);

    mysqli_free_result($result);

    $operating_system = $stock = $price = $tax = $discount = $supplier_id = $model_name = "";   

    $errors = array('device_id'=>'', 'operating_system'=>'', 'stock'=>'');
    
    if(isset($_POST['submit'])) {
        
        $id = mysqli_real_escape_string($conn, $_POST['device_id']);
        $operating_system = mysqli_real_escape_string($conn, $_POST['operating_system']);
        $stock = mysqli_real_escape_string($conn, $_POST['stock']);
        $price = mysqli_real_escape_string($conn, $_POST['price']);
        $tax = mysqli_real_escape_string($conn, $_POST['tax']);
        $discount = mysqli_real_escape_string($conn, $_POST['discount']);

        //msql
        $sql = "UPDATE device
                SET operating_system = '$operating_system', stock = '$stock'
                WHERE device_id = '$id'";

        if(mysqli_query($conn, $sql)) {
            //success
            $sql = "UPDATE price_list2
                    SET price = '$price', tax = '$tax', discount = '$discount'
                    WHERE device_id = '$id'";
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
        mysqli_close($conn);
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
        <h4 class="center">Update - <span style="font-weight:bold;"><?php echo htmlspecialchars($device['model_name'])?> (<?php echo $id?>)</span></h4>
        <form action="update_device.php" method="POST" class="white">
            <input type="hidden" name="device_id" value="<?php echo htmlspecialchars($id)?>">
            <label for="">Operating System:</label>
            <input type="text" name="operating_system" value="<?php echo htmlspecialchars($operating_system)?>">
            <label for="">Stock:</label>
            <input type="number" step="any" name="stock" value="<?php echo htmlspecialchars($stock)?>">
            <label for="">Price:</label>
            <input type="number" name="price" value="<?php echo htmlspecialchars($price)?>">
            <label for="">Tax:</label>
            <input type="number" step="any" name="tax" value="<?php echo htmlspecialchars($tax)?>">
            <label for="">Discount:</label>
            <input type="number" step="any" name="discount" value="<?php echo htmlspecialchars($discount)?>">
            <br><br><br>
            <div class="center">
                <input type="submit" name="submit" value="submit" class="btn brand z-depth-0 right">
            </div>
        </form>
        <br><br><br><br><br><br><br><br><br><br><br><br>
    </section>

    <?php include('templates/footer.php'); ?>
</html>