<?php
    include('config/db_connect.php');

    if(isset($_POST['delete'])){
        $id_to_delete = mysqli_real_escape_string($conn, $_POST['id_to_delete']);

        $sql = "DELETE FROM user2
                WHERE user_id = '$id_to_delete'";

        if(mysqli_query($conn, $sql)) {
            //success

            $sql = "DELETE FROM order2
                    WHERE user_id = '$id_to_delete'";

            if(mysqli_query($conn, $sql)) {
                //success

                header('Location: index.php');
            }

            else {
                //failure
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
        $sql = "SELECT *
                FROM user2
                WHERE user_id = '$id'";

        //result
        $result = mysqli_query($conn, $sql);

        //fetch
        $customer = mysqli_fetch_assoc($result);
        mysqli_free_result($result);

        //msql
        $sql = "SELECT order2.user_id AS u_id, worker.first_name AS f_name, worker.last_name AS l_name, device.model_name AS m_name, order2.quantity AS qty, order2.date_purchase AS d_order
                FROM order2
                JOIN worker ON worker.worker_id = order2.worker_id
                JOIN device ON device.device_id = order2.device_id
                WHERE user_id = '$id'";

        //result
        $result = mysqli_query($conn, $sql);

        //fetch
        $staffs = mysqli_fetch_all($result, MYSQLI_ASSOC);
        mysqli_free_result($result);

        mysqli_close($conn);
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <style>
        input[type=submit] {
            color: white;
        }
    </style>
</head>
    <?php include('templates/header.php'); ?>

    <div class="container center">
        <?php if($customer): ?>
            <br>
            <h4><?php echo htmlspecialchars($customer['first_name']);?> <?php echo htmlspecialchars($customer['last_name']);?> (<?php echo htmlspecialchars($customer['user_id']);?>)</h4>
            <br>
            <div class="container">
                <h5 class="left bluw-text text-darken-1" style="font-style: italic;">Customer Details</h5>
                <br><br><br>
                <table class="centered striped" style="border: 1px solid #D5D8DC;">
                    <tr>
                        <th class="center">Address</th>
                        <td><?php echo htmlspecialchars($customer['address']); ?></td>
                    </tr>
                    <tr>
                        <th class="center">Age</th>
                        <td><?php echo htmlspecialchars($customer['age']); ?></td>
                    </tr>
                </table>
                <br><br><br><br>
                <h5 class="left bluw-text text-darken-1" style="font-style: italic;">Purchase Record</h5>
                <br><br><br>
                <table class="striped" style="border: 1px solid #D5D8DC;">
                    <thead>
                        <tr >
                            <th>Staff Name</th>
                            <th >Model Name</th>
                            <th class="center">Quantity</th>
                            <th class="center">Date Purchase</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($staffs as $staff) : ?>
                        <tr>
                            <td><?php echo htmlspecialchars($staff['f_name'])?> <?php echo htmlspecialchars($staff['l_name'])?></td>
                            <td><?php echo htmlspecialchars($staff['m_name'])?></td>
                            <td class="center"><?php echo htmlspecialchars($staff['qty'])?></td>
                            <td class="center"><?php echo date(htmlspecialchars($staff['d_order']))?></td>
                        </tr>
                        <?php endforeach;?>
                    </tbody>
                </table>
                <!-- DELETE FORM -->
                <form action="cust_detail.php" method="POST">
                    <input type="hidden" name="id_to_delete" value="<?php echo $customer['user_id'] ?>">
                    <br><br>
                    <div class="#">
                        <a href="index.php" class="waves-effect waves-light btn left" style="#">Back</a>
                        <div class="right">
                            <a href="#" class="waves-effect waves-light btn" style="#">Update</a>
                            <input type="submit" name="delete" value="Delete" class="waves-effect waves-light red btn darken-4">
                        </div>
                    </div>
                </form> 
            </div>
            <br><br><br><br><br><br><br><br><br><br><br><br>
        <?php else: ?>
            <h5>No such customer exist!</h5>
        <?php endif; ?>
    </div>
    <?php include('templates/footer.php'); ?>

</html>