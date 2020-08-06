<?php
    include('config/db_connect.php');

    if(isset($_POST['delete'])){
        $id_to_delete = mysqli_real_escape_string($conn, $_POST['id_to_delete']);

        $sql = "DELETE FROM device
                WHERE device_id = '$id_to_delete'";

        if(mysqli_query($conn, $sql)) {
            //success
            $sql = "DELETE FROM price_list2
                    WHERE device_id = '$id_to_delete'";

            if(mysqli_query($conn, $sql)) {
                //success
                header('Location: index.php');
            }

            else {
                echo 'query error: '.mysqli_error($conn);
            }
        } 

        else {
            //failure
            echo 'query error: '.mysqli_error($conn);
        }
    }

    //check GET req id parameter
    if(isset($_GET['id'])) {
        $id = mysqli_real_escape_string($conn, $_GET['id']);

        //msql
        $sql = "SELECT device.device_id AS d_id, device.model_name AS m_name, supplier.s_name AS su_name, device.operating_system AS os_name, device.stock AS stok, supplier.supplier_id AS su_id
                FROM device
                JOIN supplier
                ON device.supplier_id = supplier.supplier_id
                WHERE device_id = '$id'";

        //result
        $result = mysqli_query($conn, $sql);

        //fetch
        $device = mysqli_fetch_assoc($result);

        mysqli_free_result($result);

        $sql = "SELECT *
                FROM price_list2
                WHERE device_id = '$id'";

        //result
        $result = mysqli_query($conn, $sql);

        //fetch
        $price = mysqli_fetch_assoc($result);

        mysqli_free_result($result);
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

        input[type=submit] {
            color: white;
        }
    </style>
</head>
    <?php include('templates/header.php'); ?>

    <div class="container center">
        <?php if($device): ?>
            <br>
            <h4><?php echo htmlspecialchars($device['m_name']);?> (<?php echo htmlspecialchars($device['d_id']);?>)</h4>
            <br><br><br>
            <div class="container">
                <h5 class="left bluw-text text-darken-1" style="font-style: italic;">Device Details</h5>
                <br><br><br>
                <table class="centered striped" style="border: 1px solid #D5D8DC;">
                    <tr>
                        <th class="center">Supplier</th>
                        <td><a href="supplier.php?id=<?php echo $device['su_id']?>"><?php echo htmlspecialchars($device['su_name']); ?></a></td>
                    </tr>
                    <tr>
                        <th class="center">Operating System</th>
                        <td><?php echo htmlspecialchars($device['os_name']); ?></td>
                    </tr>
                    <tr>
                        <th class="center">Stock</th>
                        <td><?php echo htmlspecialchars($device['stok']); ?></td>
                    </tr>
                    <tr>
                        <th class="center">Price</th>
                        <td>RM <?php echo htmlspecialchars($price['price']); ?></td>
                    </tr>
                    <tr>
                        <th class="center">Tax</th>
                        <td><?php echo htmlspecialchars($price['tax']); ?></td>
                    </tr>
                    <tr>
                        <th class="center">Discount</th>
                        <td><?php echo htmlspecialchars($price['discount']); ?></td>
                    </tr>
                </table> 
                <!-- DELETE FORM -->
                <form action="device_detail.php" method="POST">
                        <input type="hidden" name="id_to_delete" value="<?php echo $device['d_id'] ?>">
                        <br><br>
                    <div class="#">
                        <a href="index.php" class="waves-effect waves-light btn left" style="#">Back</a>
                        <div class="right">
                            <a href="update_device.php?id=<?php echo $device['d_id']?>" class="waves-effect waves-light btn" style="#">Update</a>
                            <input type="submit" name="delete" value="Delete" class="waves-effect waves-light red btn darken-4">
                        </div>
                    </div>        
                </form> 
            </div>
            <br><br><br><br><br><br><br><br><br><br><br><br>
        <?php else: ?>
            <h5>No such device exist!</h5>
        <?php endif; ?>

    </div>
    <?php include('templates/footer.php'); ?>

</html>