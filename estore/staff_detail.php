<?php
    include('config/db_connect.php');

    if(isset($_POST['delete'])){
        $id_to_delete = mysqli_real_escape_string($conn, $_POST['id_to_delete']);

        $sql = "DELETE FROM worker
                WHERE worker_id = '$id_to_delete'";

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
                FROM worker
                WHERE worker_id = '$id'";

        //result
        $result = mysqli_query($conn, $sql);

        //fetch
        $staff = mysqli_fetch_assoc($result);

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
        <?php if($staff): ?>
            <br>
            <h4><?php echo htmlspecialchars($staff['first_name']);?> <?php echo htmlspecialchars($staff['last_name']);?> (<?php echo htmlspecialchars($staff['worker_id']);?>)</h4>
            <br>
            <div class="container">
                <h5 class="left bluw-text text-darken-1" style="font-style: italic;">Staff Details</h5>
                <br><br><br>
                <table class="centered striped" style="border: 1px solid #D5D8DC;">
                    <tr>
                        <th class="center">Date Hired</th>
                        <td><?php echo date(htmlspecialchars($staff['date_hired'])); ?></td>
                    </tr>
                    <tr>
                        <th class="center">Annual Bonus</th>
                        <td><?php echo htmlspecialchars($staff['annual_bonus']); ?></td>
                    </tr>
                    <tr>
                        <th class="center">Salary</th>
                        <td><?php echo htmlspecialchars($staff['salary']); ?></td>
                    </tr>
                </table>
                <!-- DELETE FORM -->
                <form action="staff_detail.php" method="POST">
                    <input type="hidden" name="id_to_delete" value="<?php echo $staff['worker_id'] ?>">
                    <br><br>
                    <div class="#">
                        <a href="index.php" class="waves-effect waves-light btn left" style="#">Back</a>
                        <div class="right">
                            <a href="update_staff.php?id=<?php echo $staff['worker_id']?>" class="waves-effect waves-light btn" style="#">Update</a>
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