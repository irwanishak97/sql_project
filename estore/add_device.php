<?php
    include('config/db_connect.php');

    $device_id = $supplier_id = $model_name = $operating_system = $stock = $price = $tax = $discount = "";   

    $errors = array('device_id'=>'', 'supplier_id'=>'', 'model_name'=>'', 'operating_system'=>'', 'stock'=>'');

    if(isset($_POST['submit'])) {

        //check email
        if(empty($_POST['device_id'])) {
            $errors['device_id'] = 'A device id is required <br/>';
        }
        else {
            //echo htmlspecialchars($_POST['email']);
            $device_id = $_POST['device_id'];
            if(!preg_match('/^[A-Za-z0-9]+$/', $device_id)) {
                $errors['device_id'] = 'Device must be letters and spaces only <br/>';
            }
        }

        //check title
        // if(empty($_POST['title'])) {
        //     $errors['title'] = 'An title is required <br/>';
        // }
        // else {
        //     //echo htmlspecialchars($_POST['title']);
        //     $title = $_POST['title'];
        //     if(!preg_match('/^[a-zA-Z\s]+$/', $title)) {
        //         $errors['title'] = 'Title must be letters and spaces only <br/>';
        //     }

        // }

        //check ingredients
        // if(empty($_POST['ingredients'])) {
        //     $errors['ingredients'] = 'At least 1 ingredient is required <br/>';
        // }
        // else {
        //     //echo htmlspecialchars($_POST['ingredients']);
        //     $ingredients = $_POST['ingredients'];
        //     if(!preg_match('/^([a-zA-Z\s]+)(,\s*[a-zA-Z\s]*)*$/', $ingredients)) {
        //         $errors['ingredients'] = 'Ingredients must be a coma separated list <br/>';
        //     }
        // }
        if(array_filter($errors)) {
            //echo 'errors in the form';
        }
        else {
            $device_id = mysqli_real_escape_string($conn, $_POST['device_id']);
            $supplier_id = mysqli_real_escape_string($conn, $_POST['supplier_id']);
            $model_name = mysqli_real_escape_string($conn, $_POST['model_name']);
            $operating_system = mysqli_real_escape_string($conn, $_POST['operating_system']);
            $stock = mysqli_real_escape_string($conn, $_POST['stock']);
            $price = mysqli_real_escape_string($conn, $_POST['price']);
            $tax = mysqli_real_escape_string($conn, $_POST['tax']);
            $discount = mysqli_real_escape_string($conn, $_POST['discount']);

            //create sql
            $sql = "INSERT INTO device(device_id, supplier_id, model_name, operating_system, stock)
                    VALUES('$device_id', '$supplier_id', '$model_name', '$operating_system', '$stock')";
            
            if(mysqli_query($conn, $sql)) {
                //success
                $sql = "INSERT INTO price_list2(device_id, price, tax, discount)
                VALUES('$device_id', '$price', '$tax', '$discount')";
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
        <h4 class="center">Add a Device</h4>
        <form action="add_device.php" method="POST" class="white">
            <label for="">Device ID:</label>
            <input type="text" name="device_id" value="<?php echo htmlspecialchars($device_id)?>">
            <!-- <div class="red-text"><?php echo $errors['email']?></div> -->
            <label for="">Supplier ID:</label>
            <input type="text" name="supplier_id" value="<?php echo htmlspecialchars($supplier_id)?>">
            <!-- <div class="red-text"><?php echo $errors['title']?></div>-->
            <label for="">Model Name:</label>
            <input type="text" name="model_name" value="<?php echo htmlspecialchars($model_name)?>">
            <!-- <div class="red-text"><?php echo $errors['ingredients']?></div> -->
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
            <div class="center">
                <input type="submit" name="submit" value="submit" class="btn brand z-depth-0 right">
            </div>
        </form>
        <br><br><br><br><br><br><br><br><br><br><br><br>
    </section>

    <?php include('templates/footer.php'); ?>
</html>