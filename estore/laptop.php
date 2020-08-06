<?php
    include('config/db_connect.php');

    $sql = "SELECT *
            FROM device
            WHERE device_id LIKE 'l%'";

    $result = mysqli_query($conn, $sql);

    $devices = mysqli_fetch_all($result, MYSQLI_ASSOC);

    mysqli_free_result($result);

    mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
    <?php include('templates/header.php'); ?>
    <!--<body>-->
        <div class="container">
            <h4 style="font-style: italic;">Laptops</h4><br><br>
            <?php foreach($devices as $device): ?>
                <ul class="collection with-header">
                    <li class="collection-header"><h5><?php echo htmlspecialchars($device['model_name']);?></h5></li>
                    <li class="collection-item avatar">
                        <i class="material-icons circle  blue-grey lighten-3">laptop</i>
                        <!--<span class="title"><?php echo htmlspecialchars($device['device_id']);?></span>
                        <br>-->
                        <span class="title">ID: <?php echo htmlspecialchars($device['device_id']);?></span>
                        <p class="grey-text">Quantity: <?php echo htmlspecialchars($device['stock']);?></p>
                        <a href="device_detail.php?id=<?php echo $device['device_id']?>" class="secondary-content btn-floating blue waves-effect waves-light">
                            <i class="material-icons">read_more</i>
                        </a>
                    </li>
                </ul>
            <?php endforeach; ?>
            <a href="add_device.php" class="waves-effect waves-light btn right" style="margin:5px;">Add Laptop</a>
            <a href="index.php" class="waves-effect waves-light right btn" style="margin:5px;">Back</a><br><br><br><br>
        </div>
    <!--</body>-->
    <?php include('templates/footer.php'); ?>
</html>