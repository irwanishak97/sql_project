<?php
    include('config/db_connect.php');
    $id = isset($_GET['id']) ? $_GET['id'] : '';

    $sql = "SELECT *
            FROM worker
            WHERE worker_id = '$id'";

    //result
    $result = mysqli_query($conn, $sql);

    //fetch
    $staff = mysqli_fetch_assoc($result);

    mysqli_free_result($result);

    $annual_bonnus = $salary = "";  
    $errors = array('annual_bonus'=>'', 'salary'=>'');
    
    if(isset($_POST['submit'])) {
        
        $id = mysqli_real_escape_string($conn, $_POST['worker_id']);
        $annual_bonus = mysqli_real_escape_string($conn, $_POST['annual_bonus']);
        $salary = mysqli_real_escape_string($conn, $_POST['salary']);

        //msql
        $sql = "UPDATE worker
                SET annual_bonus = '$annual_bonus', salary = '$salary'
                WHERE worker_id = '$id'";

        if(mysqli_query($conn, $sql)) {
            //success
            header('Location: index.php');
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
        <h4 class="center">Update - <span style="font-weight:bold;"><?php echo htmlspecialchars($staff['first_name'])?> <?php echo htmlspecialchars($staff['last_name'])?> (<?php echo $id?>)</span></h4>
        <form action="update_staff.php" method="POST" class="white">
            <input type="hidden" name="worker_id" value="<?php echo htmlspecialchars($id)?>">
            <label for="">Annual Bonus:</label>
            <input type="number" step="any" name="annual_bonus" value="<?php echo htmlspecialchars($annual_bonus)?>">
            <label for="">Salary:</label>
            <input type="number" step="any" name="salary" value="<?php echo htmlspecialchars($salary)?>">
            <br><br><br>
            <div class="center">
                <input type="submit" name="submit" value="submit" class="btn brand z-depth-0 right">
            </div>
        </form>
        <br><br><br><br><br><br><br><br><br><br><br><br>
    </section>

    <?php include('templates/footer.php'); ?>
</html>