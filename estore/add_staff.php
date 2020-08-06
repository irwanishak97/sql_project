<?php
    include('config/db_connect.php');

    $worker_id = $first_name = $last_name = $annual_bonus = $date_hired = $salary = ""; 

    if(isset($_POST['submit'])) {

        $worker_id = mysqli_real_escape_string($conn, $_POST['worker_id']);
        $first_name = mysqli_real_escape_string($conn, $_POST['first_name']);
        $last_name = mysqli_real_escape_string($conn, $_POST['last_name']);
        $annual_bonus = mysqli_real_escape_string($conn, $_POST['annual_bonus']);
        $date_hired = mysqli_real_escape_string($conn, $_POST['date_hired']);
        $salary = mysqli_real_escape_string($conn, $_POST['salary']);

        //create sql
        $sql = "INSERT INTO worker(worker_id, first_name, last_name, annual_bonus, date_hired, salary)
                VALUES('$worker_id', '$first_name', '$last_name', '$annual_bonus', '$date_hired', '$salary')";
        
        if(mysqli_query($conn, $sql)) {
            //success
            header('Location: index.php');
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
        
    </style>
</head>
    <?php include('templates/header.php'); ?>

    <section class="container">
        <h4 class="center">Add Staff</h4>
        <form action="add_staff.php" method="POST" class="white">
            <label for="">Staff ID:</label>
            <input type="text" name="worker_id" value="<?php echo htmlspecialchars($worker_id)?>">
            <label for="">First Name:</label>
            <input type="text" name="first_name" value="<?php echo htmlspecialchars($first_name)?>">
            <label for="">Last Name:</label>
            <input type="text" name="last_name" value="<?php echo htmlspecialchars($last_name)?>">
            <label for="">Annual Bonus:</label>
            <input type="number" step="any" name="annual_bonus" value="<?php echo htmlspecialchars($annual_bonus)?>">
            <label for="">Date Hired:</label>
            <input type="text" step="any" name="date_hired" value="<?php echo htmlspecialchars($date_hired)?>">
            <label for="">Salary:</label>
            <input type="number" step="any" name="salary" value="<?php echo htmlspecialchars($salary)?>">
            <div class="#">
                        <a href="index.php" class="waves-effect waves-light btn left" style="#">Back</a>
                        <div class="right">
                            
                            <input type="submit" name="submit" value="submit" class="btn brand z-depth-0">
                        </div>
            </div>
        </form>
        <br><br><br><br><br><br><br><br><br><br><br><br>
    </section>

    <?php include('templates/footer.php'); ?>
</html>