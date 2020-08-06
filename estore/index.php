<?php

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
    <!--<body>-->
    <div class="center-align">
        <br><br><h4 style="#">Electronic Store Database</h4>
    </div>
    <div class="container device-type">
        <div class="row">
            <div class="col s12 m6">
                <div class="card-panel grey lighten-5 z-depth-1 card">
                    <img class="device-index" src="https://assets.dryicons.com/uploads/icon/svg/5098/0bf401dc-c8bf-4505-afab-08b0a2685829.svg"> 
                </div>
                <div class="card-action center-align">
                    <a class="waves-effect waves-light btn" href="laptop.php" style="padding: 0px 15%;">LAPTOP</a>
                </div>
            </div>
            <div class="col s12 m6">
                <div class="card-panel grey lighten-5 z-depth-1 card">
                    <img class="device-index" src="https://assets.dryicons.com/uploads/icon/svg/5113/85fd9c05-37dd-4e61-9345-f67be3cb3328.svg"> 
                </div>
                <div class="card-action center-align">
                    <a class="waves-effect waves-light btn" href="phone.php" style="padding: 0px 8%;">MOBILE PHONE</a>
                </div>
            </div>
        </div>
    </div>
    <!--</body>-->
    <?php include('templates/footer.php'); ?>
</html>