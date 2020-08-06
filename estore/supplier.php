<?php
    include('config/db_connect.php');

    if(isset($_POST['delete'])){
        $id_to_delete = mysqli_real_escape_string($conn, $_POST['id_to_delete']);

        $sql = "DELETE FROM supplier
                WHERE supplier_id = $id_to_delete";

        if(mysqli_query($conn, $sql)) {
            //success
            header('Location: index.php');
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
                FROM supplier
                WHERE supplier_id = '$id'";

        //result
        $result = mysqli_query($conn, $sql);

        //fetch
        $supplier = mysqli_fetch_assoc($result);

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
        <?php if($supplier): ?>
            <br>
            <h4><?php echo htmlspecialchars($supplier['s_name']);?> (<?php echo htmlspecialchars($supplier['supplier_id']);?>)</h4>
            <br><br><br>
            <div class="container">
            <h5 class="left bluw-text text-darken-1" style="font-style: italic;">Supplier Details</h5>
            <br><br><br>
                <table class="centered striped" style="border: 1px solid #D5D8DC;">
                    <tr>
                        <th class="center">Phone Number</th>
                        <td><?php echo htmlspecialchars($supplier['s_nophone']); ?></td>
                    </tr>
                    <tr>
                        <th class="center">Address</th>
                        <td><?php echo htmlspecialchars($supplier['s_address']); ?></td>
                    </tr>
                </table> 
                <!-- DELETE FORM -->
                <form action="details.php" method="POST">
                    <input type="hidden" name="id_to_delete" value="<?php echo $supplier['supplier_id'] ?>">
                        <br><br>
                        <div class="#">
                            <a href="index.php" class="waves-effect waves-light btn right" style="margin: 5px;">Back</a>
                            <div class="right">
                                <a href="#" class="waves-effect waves-light btn" style="margin: 5px;">Update</a>
                            </div>
                            
                        </div>
                        
                </form> 
            </div>
            
        <?php else: ?>
            <h5>No such device exist!</h5>
        <?php endif; ?>
    </div>
    <?php include('templates/footer.php'); ?>

</html>