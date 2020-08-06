<?php
    include('config/db_connect.php');

    $sql = "SELECT *
            FROM user2
            ORDER BY user_id";

    $result = mysqli_query($conn, $sql);

    $customers = mysqli_fetch_all($result, MYSQLI_ASSOC);

    mysqli_free_result($result);

    mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
    <?php include('templates/header.php'); ?>
    <!--<body>-->
        <div class="container">
            <br><h4 style="font-style: italic;">Customers</h4><br><br>
                <?php foreach($customers as $customer): ?>
                    <ul class="collection">
                        <li class="collection-item avatar">
                            <i class="material-icons circle  blue-grey lighten-3">person</i>
                            <span class="title"><?php echo htmlspecialchars($customer['first_name']);?></span>
                            <span class="title"><?php echo htmlspecialchars($customer['last_name']);?></span>
                            <p class="grey-text"><?php echo htmlspecialchars($customer['user_id']);?></p>
                            <a href="cust_detail.php?id=<?php echo $customer['user_id']?>" class="secondary-content btn-floating blue waves-effect waves-light">
                                <i class="material-icons">read_more</i>
                            </a>
                        </li>
                    </ul>
                <?php endforeach; ?>
            <a href="add_customer.php" class="waves-effect waves-light btn right" style="margin:5px;">Add customer</a>
            <a href="index.php" class="waves-effect waves-light right btn" style="margin:5px;">Back</a><br><br><br><br>
        </div>
    <!--</body>-->
    <?php include('templates/footer.php'); ?>
</html>